<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      View::make('home.html');
    }

    public static function sandbox(){
      View::make('helloworld.html');
    }
    
    public static function hakemus(){
        $leirit = Leiri::kaikki();
        View::make('hakemukset/uusi.html', array('leirit'=> $leirit));
    }
    
    public static function leiri(){
        View::make('leiri.html');
    }
    
        public static function leirilista(){
      View::make('leirilista.html');
    }
    
        public static function leiripaikka(){
      View::make('leiripaikka.html');
    }
    
        public static function profiilisivu(){
      View::make('profiilisivu.html');
    }
    
    public static function kirjaudu(){
      View::make('kirjaudu.html');
    }
    
    public static function rekisteroidy(){
      View::make('rekisteroidy.html');
    }
   
    
  }