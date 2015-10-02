<?php

class usercontroller extends BaseController{
    public static function logout(){
        $_SESSION['user'] = null;
        Redirect::to('/kirjaudu', array('viesti' => 'Olet kirjautunut ulos.'));
    }
    
    public static function luo_kayttaja() {
        $params = $_POST;
        $kayttaja = new Kayttaja(array(
            'tunnus' => $params['tunnus'],
            'nimi' => $params['nimi'],
            'salasana' => $params['salasana'],
            'email' => $params['email'],
            'syntymaaika' => $params['syntymaaika'],
            'onkoJohtaja' => 'false' //toiminee näin...
        ));
        
        $errors = $kayttaja->errors();
        if (count($errors) == 0 ) {
            $kayttaja->tallenna();
            Redirect::to('/', array('viesti' => 'Rekisteröityminen onnistui, nyt voit kirjautua sisään!'));
        } else {
            View::make('/rekisteroidy.html', array('errors' => $errors, 'kayttaja' => $kayttaja));
        }
        
        
        
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

      Redirect::to('/', array('viesti' => 'Tervetuloa ' . $kayttaja->tunnus . '!'));
    }
  }
}
