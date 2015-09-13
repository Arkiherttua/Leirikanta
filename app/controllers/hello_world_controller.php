<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  //echo('Etusivu!');
          View::make('home.html');
    }

    public static function sandbox(){
      View::make('helloworld.html');
    }
    
        public static function hakemus(){
      View::make('hakemus.html');
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