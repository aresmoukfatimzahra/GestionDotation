<?php
include_once './IDao/IDao.php';
include_once './Classes/Utilisateur.php';
include_once './connexion/Connexion.php';
class UtilisateurService implements IDao {
    
   private $connexion;

    function __construct() {
        $this->connexion = new Connexion ();
    }
    
    public function create($o) {
        $query = "insert into utilisateur (id_utilisateur,nom,mot_passe,profil,observation) values('null','" .$o->getNom() . "','" .$o->getMotdepasse()  . "','" .$o->getProfil() . "','" .$o->getObservation() . "')";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL requete insert');
    }

    public function delete($o) {
        $query = "delete from utilisateur where id_utilisateur = ".$o->getId_ut(); 
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function finById($id) {
        
        $query = "select * from utilisateur where id_utilisateur = ".$id;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e === $req->fetch(PDO::FETCH_OBJ)){
            
            $dota = new UTILISATEUR($e->id_ut, $e->nom, $e->motdepasse,$e->profil,$e->observation);
        }
        return $dota;
    }

    public function findAll() {
        
         $dota = array();
        $query = "select *from utilisateur";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $dota[] = new UTILISATEUR($e->id_utilisateur, $e->nom, $e->mot_passe,$e->profil,$e->observation);
        }
        return $dota;
    }

    public function update($o) {
        $query = "UPDATE utilisateur SET nom = '".$o->getNom()."',mot_passe = '".$o->getMotdepasse()."',profil = '".$o->getProfil()."', observation = '".$o->getObservation()."'  WHERE id_utilisateur = '" .$o->getId_ut() . "'";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

   

}
