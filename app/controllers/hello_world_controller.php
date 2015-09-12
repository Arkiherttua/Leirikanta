<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //echo('Etusivu!');
          View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }
    
        public static function hakemus(){
      // Testaa koodiasi täällä
      View::make('hakemus.html');
    }
    
        public static function leiri(){
      // Testaa koodiasi täällä
      View::make('leiri.html');
    }
    
        public static function leirilista(){
      // Testaa koodiasi täällä
      View::make('leirilista.html');
    }
    
        public static function leiripaikka(){
      // Testaa koodiasi täällä
      View::make('leiripaikka.html');
    }
    
        public static function muokkaa_hakemusta(){
      // Testaa koodiasi täällä
      View::make('muokkaa_hakemusta.html');
    }
    
        public static function profiilisivu(){
      // Testaa koodiasi täällä
      View::make('profiilisivu.html');
    }
   
    
  }