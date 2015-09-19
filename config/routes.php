<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
   $routes->get('/leiri/:id', function($id) {
       leiricontroller::leiri();
  });
  
    $routes->get('/hakemus', function() {
    HelloWorldController::hakemus();
  });
  
    $routes->get('/leirilista', function() {
    leiricontroller::leirilista();
  });
  
    $routes->get('/leiripaikka', function() {
    HelloWorldController::leiripaikka();
  });
  
    $routes->get('/profiilisivu', function() {
    HelloWorldController::profiilisivu();
  });
  
      $routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
  });
  
      $routes->get('/rekisteroidy', function() {
    HelloWorldController::rekisteroidy();
  });
