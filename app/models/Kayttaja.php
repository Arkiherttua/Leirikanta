<?php


class Kayttaja extends BaseModel {
    public $id, $tunnus, $nimi, $salasana, $email, $syntymaaika, $onkoJohtaja;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rivit = $query->fetchAll();
        $kayttajat = array();
        
        foreach ($rivit as $rivi) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $rivi['id'],
                'tunnus' => $rivi['tunnus'],
                'nimi' => $rivi['nimi'],
                'salasana' => $rivi['salasana'],
                'email' => $rivi['email'],
                'syntymaaika' => $rivi['syntymaaika'],
                //'onkoJohtaja' => $rivi['onkoJohtaja']
            ));
        }
        
        return $kayttajat;
    }
    
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query -> execute(array(('id') => $id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'tunnus' => $rivi['tunnus'],
                'nimi' => $rivi['nimi'],
                'salasana' => $rivi['salasana'],
                'email' => $rivi['email'],
                'syntymaaika' => $rivi['syntymaaika'],
                //'onkoJohtaja' => $rivi['onkoJohtaja']
            ));
            return $kayttaja;
        }
        return null;
    }
     
    
    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (tunnus, nimi, salasana, email, syntymaaika) VALUES (:tunnus, :nimi, :salasana, :email, :syntymaaika) RETURNING id');
        $query->execute(array('tunnus' => $this->tunnus, 'nimi' => $this->nimi, 'salasana' => $this->salasana, 'email'=> $this->email, 'syntymaaika' => $this->syntymaaika));
        $rivi = $query->fetch();
        $this->id = $rivi['id'];
    }
                    
    public static function authenticate($tunnus, $salasana) {
        $query = DB::connection()->prepare('SElECT * FROM Kayttaja WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1', array('tunnus'=>$tunnus, 'salasana'=> $salasana));
        $query ->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
        $rivi = $query->fetch();
        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'tunnus' => $rivi['tunnus'],
                'nimi' => $rivi['nimi'],
                'salasana' => $rivi['salasana'],
                'email' => $rivi['email'],
                'syntymaaika' => $rivi['syntymaaika'],
                //'onkoJohtaja' => $rivi['onkoJohtaja'], //korjataan joskus...
                
            ));
            return $kayttaja;
        } else {
            return null;
        }
        
    }
    
    
}
