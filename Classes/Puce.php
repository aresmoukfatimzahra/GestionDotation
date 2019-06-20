<?php


class Puce {
    private $numero ;
    private $code;
    private $type ;
    private $etat ;
    private $observation ;
    
    function __construct( $numero, $code,$type, $etat, $observation) {
        $this->numero = $numero;
        $this->code = $code;
        $this->type = $type;
        $this->etat = $etat;
        $this->observation = $observation;
    }

    function getNumero() {
        return $this->numero;
    }

    function getCode() {
        return $this->code;
    }

    function getType() {
        return $this->type;
    }

    function getEtat() {
        return $this->etat;
    }

    function getObservation() {
        return $this->observation;
    }
    
    function setCode($code) {
        $this->code = $code;
    }

    function setType($type) {
        $this->type = $type;
    }

    function setEtat($etat) {
        $this->etat = $etat;
    }

    function setObservation($observation) {
        $this->observation = $observation;
    }

    public function __toString() {
        return "Numero :".$this->numero.
                "Code :".$this->code.
                "type:".$this->type.
                "Etat:".$this->etat.
                "Observation :".$this->observation;
    }

   }
