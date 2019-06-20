<?php
include_once './IDao/IDao.php';
include_once './Classes/DOTATION.php';
include_once './connexion/CONNEXION.php';

include_once './Services/PersonnelService.php';


class DotationService implements IDao {
  
    private $connexion;
    
    function __construct() {
        $this->connexion = new Connexion ();
       
    }
    
    public function create($o) {
        $query = "insert into dotation (id_dota,solde,date_dotation,observation,numero_puce) values ('" .NULL. "','" .$o->getSolde() . "','" .$o->getDate_dotation() . "','" .$o->getObservation() . "','" .$o->getNumero_puce(). "')";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
        $_SESSION['message'] = "Dotation Enregistre";
    }

    public function delete($o) {
        $query = "delete from dotation where id_dota = ".$o->getId_dotation(); 
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function finById($id) {
        $PuceService = new PuceService();
        $query = "select * from dotation where id_dota= ".$id;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e = $req->fetch(PDO::FETCH_OBJ)){
            
            $dota = new DOTATION( $e->solde, $e->date_dotation,$e->observation,$PuceService->finById($e->numero_puce));
        }
        return $dota;
    }

    public function findAll() {
        
        $dota = array();
        $query = "select *from dotation";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $dota[] = new DOTATION($e->id_dota, $e->solde, $e->date_dotation,$e->observation,$e->numero_puce);
        }
        return $dota;
    }

    public function update($o) {
        $query = "UPDATE dotation SET solde = '".$o->getSolde()."',date_dotation = '".$o->getDate_dotation()."', observation = '".$o->getObservation()."', numero_puce = '".$o->getNumero_puce()."'  WHERE id_dotation = '" .$o->getId_dotation() . "'";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

}
