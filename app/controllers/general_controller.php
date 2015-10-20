<?php

  class general_controller extends BaseController{

    public static function index(){
      View::make('home.html');
    }

    public static function sandbox(){
      View::make('helloworld.html');
    }
  
    
  }