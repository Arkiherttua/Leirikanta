<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
   $routes->get('/leiri', function() {
    HelloWorldController::leiri();
  });
  
    $routes->get('/hakemus', function() {
    HelloWorldController::hakemus();
  });
  
    $routes->get('/leirilista', function() {
    HelloWorldController::leirilista();
  });
  
    $routes->get('/leiripaikka', function() {
    HelloWorldController::leiripaikka();
  });
  
    $routes->get('/muokkaa_hakemusta', function() {
    HelloWorldController::muokkaa_hakemusta();
  });
  
    $routes->get('/profiilisivu', function() {
    HelloWorldController::profiilisivu();
  });
