<?php
include_once './IDao/IDao.php';
include_once './Classes/DOTATION.php';
include_once './connexion/CONNEXION.php';
include_once './Service/PuceService.php';
include_once './Service/PersonnelService.php';
class AssocService {
    
     private $connexion; 
    function __construct() {
        $this->connexion = new Connexion ();
       
    }
    
    public function create($o) {
        $query = "insert into assocpersopuce (id_assoc,date_affec,date_desaf,numero_puce,matricule_pers) values('" .$o->getId_assoc() . "','" .$o->getDate_affec() . "','" .$o->getDate_desaf()  . "','" .$o->getNumero_puce() . "','" .$o->getMatricule_pers() . "')";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function delete($o) {
        $query = "delete from assocperopuce where id_assoc = ".$o->getId_assoc(); 
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function finById($id) {
        
        $query = "select * from assocpersopuce where id_assoc = ".$id;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e === $req->fetch(PDO::FETCH_OBJ)){
            
            $dota = new ASSOCPERSOPUCE($e->id_assoc, $e->date_affec, $e->date_desaf,$e->numero_puce,$e->matricule_pers);
        }
        return $dota;
    }

    public function findAll() {
        
         $dota = array();
        $query = "select *from assocpersopuce";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $dota[] =new ASSOCPERSOPUCE($e->id_assoc, $e->date_affec, $e->date_desaf,$e->numero_puce,$e->matricule_pers);
        }
        return $dota;
    }

    public function update($o) {
        $query = "UPDATE assocpersopuce date_affec = '".$o->getDate_affec()."',date_desaf = '".$o->getDate_desaf()."',numero_puce= '".$o->getNumero_puce()."', matricule_puce = '".$o->getMatricule_pers()."'  WHERE id_assoc = '" .$o->getId_assoc() . "'";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
        $req->execute() or die ('SQl');
    }
}
