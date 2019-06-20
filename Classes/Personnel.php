<?php


class Personnel {
    private $matricule ;
    private $nom;
    private $prenom;
    private $observation;
    private $id_unite;
    
  
    
    function __construct($matricule, $nom, $prenom, $observation , $id_unite) {
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->observation = $observation;
        $this->id_unite = $id_unite;
    }
    
    function getId_unite() {
        return $this->id_unite;
    }
    function getMatricule() {
        return $this->matricule;
    }

    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getObservation() {
        return $this->observation;
    }

    function setMatricule($matricule) {
        $this->matricule = $matricule;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setObservation($observation) {
        $this->observation = $observation;
    }

    public function __toString() {
        "matricule:".$this->matricule.
        "nom".$this->nom .
                "prenom".$this->prenom.
                "observation".$this->observation.
                "id unité".$this->id_unite;
           
    }

    
}
