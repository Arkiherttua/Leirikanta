<?php

class Leiri extends BaseModel {
    public $id, $leirinnimi, $alkupv, $loppupv, $leirilaistenika, $paikka;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Leiri');
        $query->execute();
        $rivit = $query->fetchAll();
        $leirit = array();
        
        foreach ($rivit as $rivi) {
            $leirit[] = new Leiri(array(
                'id' => $rivi['id'],
                'leirinnimi' => $rivi['leirinnimi'],
                'alkupv' => $rivi['alkupv'],
                'loppupv' => $rivi['loppupv'],
                'leirilaistenika' => $rivi['leirilaistenika'],
                'paikka' => self::idn_avulla_nimi($rivi['leiripaikka_id'])
            ));
        }
//        $leiripaikan_id = $leirit['paikka'];
//        $query2 = DB::connection()->prepare('SELECT * FROM Leiripaikka WHERE id = :leiripaikan_id LIMIT 1');
//        $query2 -> execute();
//        $rivi2 = $query2->fetch();
//        
//        if ($rivi2) {
//            $leirit[] = $rivi2['paikannimi'];
//        }
        
        return $leirit;
    }
    
    private static function idn_avulla_nimi($leiripaikka_id) {
        $query = DB::connection()->prepare('SELECT * FROM Leiripaikka WHERE id = :leiripaikka_id LIMIT 1');
        $query -> execute(array(('leiripaikka_id') => $leiripaikka_id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            return $rivi['paikannimi'];
        }
        return null;
    }


    public static function etsi_leiripaikan_nimi($id) {
        $leiri = self::etsi($id);
        $leiripaikan_id = $leiri->paikka;
        
        $query = DB::connection()->prepare('SELECT * FROM Leiripaikka WHERE id = :leiripaikan_id LIMIT 1');
        $query -> execute(array(('id') => $id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            return $rivi['paikannimi'];
        }
        return null;
    }


    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Leiri WHERE id = :id LIMIT 1');
        $query -> execute(array(('id') => $id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            $leiri = new Leiri(array(
                'id' => $rivi['id'],
                'leirinnimi' => $rivi['leirinnimi'],
                'alkupv' => $rivi['alkupv'],
                'loppupv' => $rivi['loppupv'],
                'leirilaistenika' => $rivi['leirilaistenika'],
                'paikka' => self::idn_avulla_nimi($rivi['leiripaikka_id']),
            ));
            return $leiri;
        }
        return null;
        
    }
    
    
}

