<?php

class Dotation {
   
    private $id_dotation ;
    private $solde ;
    private $date_dotation ;
    private $observation ;
    private $numero_puce ;
    
    
    function __construct( $id_dotation,$solde, $date_dotation, $observation, $numero_puce) {
        $this->id_dotation = $id_dotation;
        $this->solde = $solde;
        $this->date_dotation = $date_dotation;
        $this->observation = $observation;
        $this->numero_puce = $numero_puce;
    }
    function getNumero_puce() {
        return $this->numero_puce;
    }

    function setNumero_puce($numero_puce) {
        $this->numero_puce = $numero_puce;
    }

    function getId_dotation() {
        return $this->id_dotation;
    }

    function getSolde() {
        return $this->solde;
    }

    function getDate_dotation() {
        return $this->date_dotation;
    }

    function getObservation() {
        return $this->observation;
    }

    function setSolde($solde) {
        $this->solde = $solde;
    }

    function setDate_dotation($date_dotation) {
        $this->date_dotation = $date_dotation;
    }

    function setObservation($observation) {
        $this->observation = $observation;
    }

    public function __toString() {
        "matricule:".$this->matricule.
        "solde :".$this->nom .
                "date dotation :".$this->date_dotation.
                "observation".$this->observation.
                "Numero puce :".$this->numero_puce;
    }

    
    
    
    
    
    
    
}
