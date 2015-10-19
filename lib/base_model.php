<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;
    
    public function validoi_merkkijonon_pituus($sana, $min, $max) {
        $errors = array();
        if (strlen($sana) < min || $sana == null) {
            $errors[] = 'Liian lyhyt merkkijono!';
        }
        if (strlen($sana) > max) {
            $errors = 'Liian pitkä merkkijono!';
        }
        return $errors;
    }
    
    
    public function __construct($attributes){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      $errors = array();

      foreach($this->validators as $validator) {
          $validator_errors = $this->{$validator}();
          //$validator_errors = array($validator);
          $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

  }
