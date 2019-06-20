<?php

class Utilisateur {
   private $id_ut;
   private $nom;
   private $motdepasse;
   private $profil;
   private $observation;
  
   
   function __construct($id_ut, $nom, $motdepasse, $profil, $observation) {
       $this->id_ut = $id_ut;
       $this->nom = $nom;
       $this->motdepasse = $motdepasse;
       $this->profil = $profil;
       $this->observation = $observation;
   }
   
   function getId_ut() {
       return $this->id_ut;
   }

   function getNom() {
       return $this->nom;
   }

   function getMotdepasse() {
       return $this->motdepasse;
   }

   function getProfil() {
       return $this->profil;
   }

   function getObservation() {
       return $this->observation;
   }

   function setNom($nom) {
       $this->nom = $nom;
   }

   function setMotdepasse($motdepasse) {
       $this->motdepasse = $motdepasse;
   }

   function setProfil($profil) {
       $this->profil = $profil;
   }

   function setObservation($observation) {
       $this->observation = $observation;
   }

   public function __toString() {
       "Nom:".$this->nom."Observation".$this->observation;
   }


}
