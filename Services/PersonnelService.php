<?php
include_once './IDao/IDao.php';
include_once './Classes/Personnel.php';
include_once './connexion/Connexion.php';


class PersonnelService implements IDao {
 private $connexion;

    function __construct() {
        $this->connexion = new connexion ();
    }
    public function create ($o)
    {
        $query = "insert into personnel(matricule,nom,prenom,observation,id_unite) values('" .$o->getMatricule() . "','" .$o->getNom() . "','" .$o->getPrenom() . "','" .$o->getObservation() . "','" .$o->getId_unite(). "')";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('ERREUR CREATE');
    }

    public function delete($o) {
        $query = "delete from personnel where matricule = ".$o->getMatricule(); 
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function findAll() {
        $etds = array();
        $UnitéService = new UnitéService();
        $query = "select * from personnel";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $etds[] = new PERSONNEL($e->matricule, $e->nom, $e->prenom, $e->observation,$e->id_unite);
        }
        return $etds;
    }
      public function findByMatricule($matricule) {
        $UnitéService = new UnitéService();
        $query = "select * from personnel where matricule= ".$matricule;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e === $req->fetch(PDO::FETCH_OBJ)){
            $pers = new PERSONNEL($e->matricule, $e->nom, $e->prenom,$e->observation,$UnitéService->finById($e->id_unite));
        }
        return $pers;
    }
    public function finById($id) {
        $UnitéService = new UnitéService();
        $query = "select * from personnel where matricule= ".$id;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e = $req->fetch(PDO::FETCH_OBJ)){
            $pers = new PERSONNEL($e->matricule, $e->nom, $e->prenom,$e->observation,$UnitéService->finById($e->id_unite));
        }
        return $pers;
    }

    public function update($o) {
        $query = "UPDATE personnel SET nom = '".$o->getNom()."',prenom = '".$o->getPrenom()."', observation = '".$o->getObservation()."',id_unite='" .$o->getId_unite(). "' WHERE matricule = '" .$o->getMatricule() . "'";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

}
