<?php
include_once './IDao/IDao.php';
include_once './Classes/Unité.php';
include_once './connexion/Connexion.php';

class UnitéService  implements IDao {
   private $connexion;

    function __construct() {
        $this->connexion = new connexion ();
    }
    public function create ($o)
    {
        $query = "insert into unite (id_unite,nom_unite,type_unite) values('".NULL."','".$o->getNom_unite() . "','" .$o->getType_unite() ."')";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

    public function delete($o) {
        $query = "delete from unite where id_unite = ".$o->getId_unite(); 
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }
    public function findAll() {
        $etds = array();
        $query = "select * from unite";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $etds[] = new Unité($e->id_unite,$e->nom_unite, $e->type_unite);
        }
        return $etds;
    }

     public function finById($id) {
        $query = "select * from unite where id_unite= ".$id;
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        if($e = $req->fetch(PDO::FETCH_OBJ)){
            $pers = new Unité($e->id_unite, $e->nom_unite, $e->type_unite);
        }
        return $pers;
    }

    public function update($o) {
        $query = "UPDATE unite SET nom_unite= '".$o->getNom_unite()."', type_unite = '".$o->getType_unite()."' WHERE id_unite = '" .$o->getId_unite() . "'";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute() or die('SQL');
    }

}
