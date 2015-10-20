<?php

class Hakemuscontroller extends BaseController {
    
    public static function poista($id) {
        self::check_logged_in();
        $hakemus = new Hakemus(array('id'=> $id));
        $hakemus->poista();
        Redirect::to('/', array('viesti' => 'Hakemus poistettu.'));
    }
    
    public static function muokkaa($id) {
        self::check_logged_in();
        $hakemus = Hakemus::etsi($id);
        View::make('hakemukset/muokkaa.html', array('hakemus' => $hakemus));
        #View::make('hakemukset/hakemus/' . $id . '/muokkaa.html', array('hakemus' => $hakemus));
    }
    
    public static function paivita($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = (array(
            'kayttaja_id' => $id, //toimineeko
            'nimi' => $params['nimi'],
            'kokemus' => $params['kokemus'],
            'vapaakuvaus' => $params['vapaakuvaus']
        ));
        $hakemus = new Hakemus($attributes);
        $errors = $hakemus->errors();

        if (count($errors) == 0 ) {
            $hakemus -> paivita();
            Redirect::to('/hakemukset/hakemus/' . $hakemus->id, array('viesti' => 'Hakemus päivitetty.'));
        } else {
            View::make('/hakemukset/muokkaa.html', array('errors' => $errors, 'hakemus' => hakemus));
        }
    }

    public static function hakemus(){
        self::check_logged_in();
        $leirit = Leiri::kaikki();
        View::make('hakemukset/uusi.html', array('leirit'=> $leirit));
    }
    
    public function nayta_hakemus($id) {
        self::check_logged_in();
        $hakemus = Hakemus::etsi($id);
        $leirit_joille_hakee = Hakemus::etsi_kaikki_yhden_kayttajan($id);
        View::make('hakemukset/hakemus.html', array('hakemus'=> $hakemus, 'leirit'=>$leirit_joille_hakee));
    } 
    
    public static function hakemuslista() {
        self::check_logged_in();
        //$hakemukset = Hakemus::kaikki();
        $hakemukset = Hakemus::kaikki_nimineen();
        if (self::onko_johtaja()) {
            View::make('hakemukset/hakemuslista.html', array('hakemukset'=> $hakemukset));
        }
    }
    
    public static function luo_hakemus() {
        self::check_logged_in();
        $params = $_POST;        
        $leirit_joille_hakee = $_POST['haetut_leirit'];
        $kirjautunut_kayttaja = self::get_user_logged_in();
        
        $attributes = (array(
            'kayttaja_id' => $kirjautunut_kayttaja->id,
            'kokemus' => $params['kokemus'],
            'vapaakuvaus' => $params['vapaakuvaus']
        ));
        $hakemus = new Hakemus($attributes);
        $errors = $hakemus->errors();
        
        if ($leirit_joille_hakee == null) {
            $errors = array_merge($errors, 'Hae ainakin yhdelle leirille!');
        }
        if (count($errors) == 0 ) {
            $hakemus->tallenna();
            $hakemus->luo_ohjausvalitaulu($leirit_joille_hakee); //eli tallennetaan tieto minne leireille hakee
            Redirect::to('/hakemukset/hakemus/' . $hakemus->id, array('viesti' => 'Hakemus vastaanotettu.'));
        } else {
            $leirit = Leiri::kaikki();
            View::make('/hakemukset/uusi.html', array('errors' => $errors, 'hakemus' => $hakemus, 'leirit' => $leirit));
        }
            
    }
    
}

