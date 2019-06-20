<?php
include_once './IDao/IDao.php';
include_once './Classes/Puce.php';
include_once './connexion/Connexion.php';

class PuceService implements IDao {
    
    private $connexion;

    function __construct() {
        $this->connexion = new connexion ();
    }
    public function create ($o)
    {
        $query = "insert into puce (numero ,code,type_puce,etat,observation) values('" .$o->getNumero() . "','".$o->getCode()."','" .$o->getType() . "','" .$o->getEtat() . "','" .$o->getObservation() . "')";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function delete($o) {
        $query = "delete from puce where numero = ".$o->getNumero(); 
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function findAll() {
        $etds = array();
        $query = "select * from puce";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $etds[] = new PUCE( $e->numero,$e->code, $e->type_puce,$e->etat, $e->observation);
        }
        return $etds;
    }

    public function finById($id) {
        $query = "select * from puce where numero= ".$numero;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e = $req->fetch(PDO::FETCH_OBJ)){
            $pers = new PUCE( $e->numero,$e->code, $e->type_puce,$e->etat, $e->observation);
        }
        return $pers;
    }

    public function update($o) {
        $query = "UPDATE puce SET code = '" .$o->getCode() . "',type_puce = '".$o->getType_puce()."', etat = '".$o->getEtat()."',observation = '".$o->getObservation()."' WHERE  numero= '".$o->getNumero()."' ";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

}
