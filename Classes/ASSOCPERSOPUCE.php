<?php


class ASSOCPERSOPUCE {
    private $id_assoc;
    private $date_affec;
    private $datdesaf;
    private $numero_puce;
    private $matricule_pers ;
  
  
  function __construct($id_assoc, $date_affec, $datdesaf, $numero_puce, $matricule_pers) {
      $this->id_assoc = $id_assoc;
      $this->date_affec = $date_affec;
      $this->datdesaf = $datdesaf;
      $this->numero_puce = $numero_puce;
      $this->matricule_pers = $matricule_pers;
  }
  function getId_assoc() {
      return $this->id_assoc;
  }

  function getDate_affec() {
      return $this->date_affec;
  }

  function getDatdesaf() {
      return $this->datdesaf;
  }

  function getNumero_puce() {
      return $this->numero_puce;
  }

  function getMatricule_pers() {
      return $this->matricule_pers;
  }

  function setDate_affec($date_affec) {
      $this->date_affec = $date_affec;
  }

  function setDatdesaf($datdesaf) {
      $this->datdesaf = $datdesaf;
  }

  function setNumero_puce($numero_puce) {
      $this->numero_puce = $numero_puce;
  }

  function setMatricule_pers($matricule_pers) {
      $this->matricule_pers = $matricule_pers;
  }


}
