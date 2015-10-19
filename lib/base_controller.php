<?php

  class BaseController{
      
    public static function onko_johtaja() {
        if (isset($_SESSION['kayttaja'])) {
          $kayttaja_id = $_SESSION['kayttaja'];
          return Kayttaja::onko_johtaja($kayttaja_id);
        }
        return FALSE;
    }
    
    public static function get_user_logged_in_id(){
      if (isset($_SESSION['kayttaja'])) {
          $kayttaja_id = $_SESSION['kayttaja'];
      
          return $kayttaja_id;
      }
      return null;
    }

    public static function get_user_logged_in(){
      if (isset($_SESSION['kayttaja'])) {
          $kayttaja_id = $_SESSION['kayttaja'];
          $kayttaja = Kayttaja::etsi($kayttaja_id);
      
          return $kayttaja;
      }
      return null;
    }

    public static function check_logged_in(){   
      if (!isset($_SESSION['kayttaja'])) {
             Redirect::to('/kirjaudu', array('viesti' => 'Kirjautuminen vaadittu!'));
      }
    }

  }
