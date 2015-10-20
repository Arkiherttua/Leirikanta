<?php

class leiricontroller extends BaseController {
    
    public static function leirilista() {
        $leirit = Leiri::kaikki();
        View::make('leirilista.html', array('leirit'=> $leirit));
    }

    public static function leiripaikat() {
        $paikat = Leiripaikka::kaikki();
        View::make('leiripaikat.html', array('paikat'=> $paikat));
    }
    
    public function leiripaikka($id) {
        $paikka = Leiripaikka::etsi($id);
        View::make('leiripaikka.html', array('paikka'=> $paikka));
    }
    
    public function leiri($id) {
        $leiri = Leiri::etsi($id);
        View::make('leiri.html', array('leiri'=> $leiri));
    }  

}
