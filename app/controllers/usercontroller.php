<?php

class usercontroller extends BaseController{
    
    
    public static function luo_kayttaja() {
        $params = $_POST;
        $kayttaja = new Kayttaja(array(
            'tunnus' => 'tunnus',
            'nimi' => $params['nimi'],
            'salasana' => $params['salasana'],
            'email' => $params['email'],
            'syntymaaika' => $params['syntymaaika']
        ));
        //Kint::dump($params);
        $kayttaja->tallenna();
        Redirect::to('/', array('viesti' => 'Rekisteröityminen onnistui, nyt voit kirjautua sisään!'));
    }
    
    public static function login() { 
        View::make('kirjaudu.html');
    }
    
    public static function handle_login(){
    $params = $_POST;

    $kayttaja = Kayttaja::authenticate($params['tunnus'], $params['salasana']);

    if(!$kayttaja){
      View::make('kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana.', 'tunnus' => $params['tunnus']));
    }else{
      $_SESSION['kayttaja'] = $kayttaja->id;

      Redirect::to('/', array('message' => 'Tervetuloa ' . $kayttaja->tunnus . '!'));
    }
  }
}
