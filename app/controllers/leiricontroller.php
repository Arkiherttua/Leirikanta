<?php

class leiricontroller extends BaseController {
    public static function leirilista() {
        $leirit = Leiri::kaikki();
        View::make('leirilista.html', array('leirit'=> $leirit));
    }
        //tätä modataan vielä:
        public static function leiri($id) {
        $leiri = Leiri::etsi($id);
        View::make('leiri.html', array('leiri'=> $leiri));
    }
}
