<?php

class Leiri extends BaseModel {
    public $id, $leirinnimi, $alkupv, $loppupv, $leirilaistenIka, $paikka;
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
                //'leirilaistenIka' => $rivi['leirilaistenIka'], nää räjähtävät jos ovat käytössä...
                //'paikka' => $rivi['paikka']
            ));
        }
        
        return $leirit;
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
                'leirilaistenIka' => $rivi['leirilaistenIka'],
                'paikka' => $rivi['paikka'],
            ));
            return $leiri;
        }
        return null;
        
    }
    
    
}

