<?php


class Connexion {
     private $connexion;

    public function __construct() {
        $host = 'sql104.eb2a.com';
        $dbname = 'eb2a_21313750_gdotation';
        $login = 'eb2a_21313750';
        $password = 'imadeddine2014';
        try {
            $this->connexion = new PDO("mysql:host=$host;dbname=$dbname", $login, $password);
            $this->connexion->query("SET NAMES UTF8");
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    function getConnexion() {
        return $this->connexion;
    }

}
