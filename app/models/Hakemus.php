<?php

class Hakemus extends BaseModel {

    public $id, $kayttaja_id, $kokemus, $vapaaKuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validoi_kuvaus', 'validoi_kokemus');
    }
    public function muokkaa() {
        $query = DB::connection()->prepare('UPDATE Hakemus (kayttaja_id, kokemus, vapaaKuvaus) VALUES (:kayttaja_id, :kokemus, :vapaaKuvaus) RETURNING id');
        $query->execute(array('kayttaja_id' => $this->kayttaja_id, 'kokemus' => $this->kokemus, 'vapaaKuvaus' => $this->vapaaKuvaus));
        $rivi = $query->fetch();
        $this->id = $rivi['id'];
    }

    public function tallenna() {
        $query = DB::connection()->prepare('INSERT INTO Hakemus (kayttaja_id, kokemus, vapaaKuvaus) VALUES (:kayttaja_id, :kokemus, :vapaaKuvaus) RETURNING id');
        $query->execute(array('kayttaja_id' => $this->kayttaja_id, 'kokemus' => $this->kokemus, 'vapaaKuvaus' => $this->vapaaKuvaus));
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
                    //'vapaaKuvaus' => $rivi['vapaaKuvaus'] //räjähtää jos toiminnassa...
            ));
        }

        return $hakemukset;
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
                    //'vapaaKuvaus' => $rivi['vapaaKuvaus']
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
        if (strlen($this->vapaaKuvaus) < 10 || $this->vapaaKuvaus == null) {
            $errors[] = 'Liian lyhyt teksti kuvaus-kentässä!';
        }
        return $errors;
    }

}
