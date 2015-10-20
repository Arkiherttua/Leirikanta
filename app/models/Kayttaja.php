<?php


class Kayttaja extends BaseModel {
    public $id, $tunnus, $nimi, $salasana, $email, $syntymaaika, $onkojohtaja;
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_tunnus', 'validoi_salasana', 'validoi_email', 'validoi_syntymaaika');
    }
    
    
    
    public static function onko_johtaja($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query -> execute(array(('id') => $id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            if ($rivi['onkojohtaja'] == true) {
                return true;
            }
        }
        return false;
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
                'onkojohtaja' => $rivi['onkojohtaja']
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
                'onkojohtaja' => $rivi['onkojohtaja']
            ));
            return $kayttaja;
        }
        return null;
    }
     
    
    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (tunnus, nimi, salasana, email, syntymaaika, onkojohtaja) VALUES (:tunnus, :nimi, :salasana, :email, :syntymaaika, FALSE) RETURNING id');
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
                'onkojohtaja' => $rivi['onkojohtaja']             
            ));
            return $kayttaja;
        } else {
            return null;
        }
        
    }
    
    public function validoi_tunnus() {
        $errors = array();
        if (strlen($this->tunnus) < 4 || $this->tunnus == null) {
            $errors[] = 'Liian lyhyt käyttäjätunnus!';
        }
        
        if (strlen($this->tunnus) > 50) {
            $errors[] = 'Liian pitkä käyttäjätunnus!';
        }
        return $errors;
    }
    
    public function validoi_salasana() {
        $errors = array();
        if (strlen($this->salasana) < 6 || $this->salasana == null) {
            $errors[] = 'Liian lyhyt salasana!';
        }
        if (strlen($this->salasana) > 50) {
            $errors[] = 'Liian pitkä salasana!';
        }
        return $errors;
    }
    
    public function validoi_email() {
        $errors = array();
        if (strlen($this->email) < 6 || $this->email == null) {
            $errors[] = 'Liian lyhyt email-osoite!';
        }
        if (strlen($this->email) > 50) {
            $errors[] = 'Liian pitkä email-osoite!';
        }
        return $errors;
    }
    
    public function validoi_syntymaaika() {
        $errors = array();
//        if (preg_match($this->syntymaaika, '/^\d{4}\d{2}\d{2}$/')) {
//            $errors[] = 'Syntymäaika annettu väärässä muodossa!';
//        }
        return $errors;
    }
    
    
}
