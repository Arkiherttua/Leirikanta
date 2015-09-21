<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
   $routes->get('/leiri/:id', function($id) {
       leiricontroller::leiri($id);
  });
  
    $routes->post('/hakemukset', function() {
        leiricontroller::luo_hakemus();
  });
  
    $routes->get('/hakemukset/hakemus/:id', function($id) {
        leiricontroller::nayta_hakemus($id);
    });
    
    //tää lienee turha
     $routes->get('/hakemukset/hakemus', function() {
        HelloWorldController::hakemus();
  }); 
    $routes->get('/leirilista', function() {
    leiricontroller::leirilista();
  });
  
        
    $routes->get('/hakemukset/hakemuslista', function() {
    leiricontroller::hakemuslista();
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
