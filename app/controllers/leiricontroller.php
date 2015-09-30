<?php

class leiricontroller extends BaseController {
    
    public static function leirilista() {
        $leirit = Leiri::kaikki();
        View::make('leirilista.html', array('leirit'=> $leirit));
    }
    
    public static function hakemuslista() {
        $hakemukset = Hakemus::kaikki();
        View::make('hakemukset/hakemuslista.html', array('hakemukset'=> $hakemukset));
    }
    

    public static function leiripaikat() {
        $paikat = Leiripaikka::kaikki();
        View::make('leiripaikat.html', array('paikat'=> $paikat));
    }
    
    public function leiripaikka($id) {
        $paikka = Leiripaikka::etsi($id);
        View::make('leiripaikka.html', array('paikka'=> $paikka));
    }
    
    
    
        //tätä modataan vielä:
    public function leiri($id) {
        $leiri = Leiri::etsi($id);
        View::make('leiri.html', array('leiri'=> $leiri));
    }
    
    //samoin tätä...
    public function nayta_hakemus($id) {
        $hakemus = Hakemus::etsi($id);
        View::make('hakemukset/hakemus.html', array('hakemus'=> $hakemus));
    }
    
    public function hakemus($id) {
        $hakemus = Hakemus::etsi($id);
        View::make('hakemukset/hakemus.html', array('hakemus'=> $hakemus));
    }    
    
    public static function luo_hakemus() {
        $params = $_POST;
        $attributes = (array(
            'kayttaja_id' => '1', //kaunista purkkaa
            'nimi' => $params['nimi'],
            'kokemus' => $params['kokemus'],
            'vapaaKuvaus' => $params['vapaaKuvaus']
        ));
        $hakemus = new Hakemus($attributes);
        $errors = $hakemus->errors();

        if (count($errors) == 0 ) {
            $hakemus->tallenna();
            Redirect::to('/hakemukset/hakemus/' . $hakemus->id, array('viesti' => 'Hakemus vastaanotettu.'));
        } else {
            View::make('/hakemukset/uusi.html', array('errors' => $errors, 'hakemus' => hakemus));
        }
            
    }
    
  

}
