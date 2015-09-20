<?php

class Hakemus extends BaseModel{
    public $id, $kayttaja_id, $kokemus, $vapaaKuvaus;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function tallenna() {
         $query = DB::connection()->prepare('INSERT INTO Hakemus (kayttaja_id, kokemus, vapaaKuvaus) VALUES (:kayttaja_id, :kokemus, :vapaaKuvaus) RETURNING id');
         $query ->execute(array('kayttaja_id'=> $this -> kayttaja_id, 'kokemus' => $this->kokemus, 'vapaaKuvaus'=>  $this->vapaaKuvaus));
         $rivi = $query->fetch();
         $this->id = $rivi['id'];
    }
    
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Hakemus');
        $query->execute();
        $rivit = $query->fetchAll();
        $hakemukset = array();
        
        foreach ($rivit as $rivi) {
            $hakemukset[] = new Hakemus(array(
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'kokemus' => $rivi['kokemus'],
                'vapaaKuvaus' => $rivi['vapaaKuvaus']
            ));
        }
        
        return $hakemukset;
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Hakemus WHERE id = :id LIMIT 1');
        $query -> execute(array(('id') => $id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            $hakemus = new Hakemus(array(
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'kokemus' => $rivi['kokemus'],
                'vapaaKuvaus' => $rivi['vapaaKuvaus']
            ));
            return $hakemus;
        }
        return null;
        
    }
}
