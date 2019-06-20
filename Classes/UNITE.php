<?php

class Unité {
    
    private $id_unite;
    private $nom_unite;
    private $type_unite;
    
     function __construct($id_unite ,$nom_unite, $type_unite) {
        $this->id_unite = $id_unite;
        $this->nom_unite = $nom_unite;
        $this->type_unite = $type_unite;
    }
    
    function getId_unite() {
        return $this->id_unite;
    }

    function getNom_unite() {
        return $this->nom_unite;
    }

    function getType_unite() {
        return $this->type_unite;
    }

    function setNom_unite($nom_unite) {
        $this->nom_unite = $nom_unite;
    }

    function setType_unite($type_unite) {
        $this->type_unite = $type_unite;
    }

    
    public function __toString() {
        return "Id :".$this->id_unite."Nom:".
        $this->nom_unite." Type:".$this->type_unite;
    }

}
