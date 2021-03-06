<?php

  $routes->get('/', function() {
    general_controller::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    general_controller::sandbox();
  });
  
  
  $routes->post('/logout', function(){
      usercontroller::logout();
      
  });
  
  $routes -> get('/kirjaudu', function() {
      usercontroller::login();
  });
  
  
  $routes -> post('/kirjaudu', function() {
      usercontroller::handle_login();
  });
  
  $routes->post('/rekisteroidy', function() {
        usercontroller::luo_kayttaja();
  });
  
  
  
  
  
   $routes->get('/leiri/:id', function($id) {
       leiricontroller::leiri($id);
  });
  
   $routes->get('/leiripaikka/:id', function($id) {
       leiricontroller::leiripaikka($id);
  });
  
   $routes->get('/leiripaikat', function() {
       leiricontroller::leiripaikat();
  });
  
  
  
    $routes->post('/hakemukset/hakemus/:id/muokkaa', function($id) {
        Hakemuscontroller::paivita($id);
    });
  
    $routes->post('/hakemukset/hakemus/:id/poista', function($id) {
        Hakemuscontroller::poista($id);
    });  
    
    $routes->get('/hakemukset/muokkaa', function($id) {
        Hakemuscontroller::muokkaa($id);
    });  
   
    $routes->post('/hakemukset', function() {
        Hakemuscontroller::luo_hakemus();
    });
  
    $routes->get('/hakemukset/hakemus/:id', function($id) {
        Hakemuscontroller::nayta_hakemus($id);
    });
    
     $routes->get('/hakemukset/uusi', function() {
        Hakemuscontroller::hakemus();
  }); 
 
    $routes->get('/hakemukset/hakemuslista', function() {
        Hakemuscontroller::hakemuslista();
  });
  
  
  
  
  
    $routes->get('/leirilista', function() {
        leiricontroller::leirilista();
  });
         
  
  $routes->get('/profiilisivu', function() {
          usercontroller::profiilisivu();
  });
  
  $routes->get('/kirjaudu', function() {
          usercontroller::kirjaudu();
  });
  
  $routes->get('/rekisteroidy', function() {
          usercontroller::rekisteroidy();
  });
