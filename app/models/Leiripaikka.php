<?php

class Leiripaikka extends BaseModel{
    public $id, $paikannimi, $sijainti, $nettisivu, $kokki, $kuvaus;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
        public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Leiripaikka');
        $query->execute();
        $rivit = $query->fetchAll();
        $paikat = array();
        
        foreach ($rivit as $rivi) {
            $paikat[] = new Leiripaikka(array(
                'id' => $rivi['id'],
                'paikannnimi' => $rivi['paikannimi'],
                'sijainti' => $rivi['sijainti'],
                'nettisivu' => $rivi['nettisivu'],
                'kokki' => $rivi['kokki'],
                'kuvaus' => $rivi['kuvaus']
            ));
        }
        
        return $paikat;
    }
    
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Leiripaikka WHERE id = :id LIMIT 1');
        $query -> execute(array(('id') => $id));
        $rivi = $query->fetch();
        
        if ($rivi) {
            $paikka = new Leiripaikka(array(
                'id' => $rivi['id'],
                'paikannnimi' => $rivi['paikannimi'],
                'sijainti' => $rivi['sijainti'],
                'nettisivu' => $rivi['nettisivu'],
                'kokki' => $rivi['kokki'],
                'kuvaus' => $rivi['kuvaus']
            ));
            return $paikka;
        }
        return null;
        
    }
}
