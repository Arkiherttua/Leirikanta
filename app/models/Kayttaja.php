<?php


class Kayttaja {
    public $id, $tunnus, $nimi, $salasana, $email, $syntymaaika, $onkoJohtaja;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function authenticate($params) {
        $tunnus = $params[0];
        $salasana = $params[1];
        $query = DB::connection()->prepare('SElECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1', array('tunnus'=>$tunnus, 'salasana'=> $salasana));
        $query ->execute();
        $rivi = $query->fetch();
        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'tunnus' => $rivi['tunnus'],
                'nimi' => $rivi['nimi'],
                'salasana' => $rivi['salasana'],
                'email' => $rivi['email'],
                'syntymaaika' => $rivi['syntymaaika'],
                'onkoJohtaja' => $rivi['onkoJohtaja'],
                
            ));
            return $kayttaja;
        } else {
            return null;
        }
        
    }
    
    
}
