<?php

class Hakemus extends BaseModel {

    public $id, $kayttaja_id, $kokemus, $vapaakuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_kuvaus', 'validoi_kokemus');
    }
    
    public function luo_ohjausvalitaulu($leirit) {
        foreach ($leirit as $leiri) {
            if (!is_int($leiri)) { //purkkaa, mutta nyt softa ei kaadu jos ei hae yhdellekään leirille
                echo 'et hakenut yhdellekään leirille...';
                continue;
            }
            $query = DB::connection()->prepare('INSERT INTO Leiriohjaajuus (hakemus_id, leiri_id, onkovalittu, onkojohtaja) VALUES (:id, :leiri, FALSE, FALSE) RETURNING id');
            //$query->execute();
            //$query->execute(array('hakemus_id' => $this->hakemus_id, 'leiri_id' => $this->leiri, 'onkovalittu' => FALSE, 'onkojohtaja' => FALSE));
            $query->execute(array('id' => $this->id, 'leiri' => $leiri));
            $rivi = $query->fetch();
        }
    }

    public function poista() {
        $query = DB::connection()->prepare('DELETE FROM Hakemus WHERE id = :id');
        $query->execute(array('id' => $this->id));
        $rivi = $query->fetch();
    }

    public function muokkaa() {
        $query = DB::connection()->prepare('UPDATE Hakemus (kayttaja_id, kokemus, vapaakuvaus) VALUES (:kayttaja_id, :kokemus, :vapaakuvaus) RETURNING id');
        $query->execute(array('kayttaja_id' => $this->kayttaja_id, 'kokemus' => $this->kokemus, 'vapaakuvaus' => $this->vapaakuvaus));
        $rivi = $query->fetch();
        $this->id = $rivi['id'];
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Hakemus (kayttaja_id, kokemus, vapaakuvaus) VALUES (:kayttaja_id, :kokemus, :vapaakuvaus) RETURNING id');
        $query->execute(array('kayttaja_id' => $this->kayttaja_id, 'kokemus' => $this->kokemus, 'vapaakuvaus' => $this->vapaakuvaus));
        $rivi = $query->fetch();
        $this->id = $rivi['id'];
    }

    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Hakemus');
        $query->execute();
        $rivit = $query->fetchAll();
        $hakemukset = array();

        //käyttäjän tiedot mukaan!
        $query2 = DB::connection()->prepare('SELECT nimi, Kayttaja.id, kayttaja_id FROM Kayttaja, Hakemus WHERE Kayttaja.id = kayttaja_id');
        $query2->execute();
        $rivit2 = $query2->fetchAll();
        $idt = array();
        //nämä Hakemus-olion muuttujaan talteen, tai vielä mieluummin tietty käyttäjän oikea nimi

        foreach ($rivit as $rivi) {
            $hakemukset[] = new Hakemus(array(
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'kokemus' => $rivi['kokemus'],
                'vapaakuvaus' => $rivi['vapaakuvaus'] 
            ));
        }

        return $hakemukset;
    }
    
    public static function kaikki_nimineen()  {
        $hakemukset = Hakemus::kaikki();
        $hakemukset_nimineen = array();
        foreach ($hakemukset as $hakemus) {
            $nimi = Hakemus::etsi_nimi($hakemus->id);
            $hakemukset_nimineen[$nimi] = $hakemus;   
            echo $nimi;
        }
        return $hakemukset_nimineen;
    }


    public static function etsi_nimi($id) {
        $query = DB::connection()->prepare('SELECT nimi FROM Kayttaja WHERE Kayttaja.id = (SELECT Hakemus.kayttaja_id FROM Hakemus WHERE id = :id) LIMIT 1');
        $query->execute(array(('id') => $id));
        $rivi = $query->fetch();
        if ($rivi) {
            return $rivi['nimi'];
        }
        return null;
    }
    
    public static function etsi_kaikki_yhden_kayttajan($hakemus_id) {
            $query = DB::connection()->prepare('SELECT leiri_id FROM Leiriohjaajuus WHERE hakemus_id = :hakemus_id');
            $query->execute(array(('hakemus_id') => $hakemus_id));
            $rivit = $query->fetchAll();
            $leirit_joille_hakee = array();
            if ($rivit) {
                foreach ($rivit as $rivi) {
                    $leiri_id = $rivi['leiri_id'];
                    $query = DB::connection()->prepare('SELECT leirinnimi FROM Leiri WHERE id = :leiri_id LIMIT 1');
                    $query->execute(array(('leiri_id') => $leiri_id));
                    $rivi2 = $query->fetch();
                    
                    $leirit_joille_hakee[] = $rivi2['leirinnimi'];
                }   
            }
            return $leirit_joille_hakee;
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Hakemus WHERE id = :id LIMIT 1');
        $query->execute(array(('id') => $id));
        $rivi = $query->fetch();

        if ($rivi) {
            $hakemus = new Hakemus(array(
                'id' => $rivi['id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'kokemus' => $rivi['kokemus'],
                'vapaakuvaus' => $rivi['vapaakuvaus']
            ));
            return $hakemus;
        }
        return null;
    }

    public function validoi_kokemus() {
        $errors = array();
        if (strlen($this->kokemus) < 2 || $this->kokemus == null) {
            $errors[] = 'Liian lyhyt teksti kokemus-kentässä!';
        }
//        if ($this->validoi_merkkijonon_pituus($this->kokemus, 2, 10000)) {
//            $errors[] = $this->validoi_merkkijonon_pituus($this->kokemus, 2, 10000);
//        }
        return $errors;
    }

    public function validoi_kuvaus() {
        $errors = array();
        if (strlen($this->vapaakuvaus) < 10 || $this->vapaakuvaus == null) {
            $errors[] = 'Liian lyhyt teksti kuvaus-kentässä!';
        }
        return $errors;
    }

}
