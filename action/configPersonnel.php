<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$nom = '';
	$prenom = '';
        $observation='';
        $id_unite=0;
	$matricule = '';
	$update = false;
        
	if (isset($_POST['save'])) 
        {
                $nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
                $matricule=$_POST ['matricule'];
                $observation = $_POST['observation'];
                $id_unite=$_POST['id_unite'];
                $query = mysqli_query($db, "SELECT * FROM personnel ")or die('erreur de requet');
                $z=0;
                while($re = mysqli_fetch_array($query))
                {   
                        if($matricule==$re['matricule'])
                        {
                        $z+=1;
                        }
                        else 
                        {
                        $z+=0;
                        }
                        
                    if($z==0)
                    {
                        mysqli_query($db,"INSERT INTO personnel (`matricule`, `nom`, `prenom`, `observation`, `id_unite`) VALUES ('$matricule','$nom',  '$prenom', '$observation',  '$id_unite')" )or die('erreur de requette'); 
                        $_SESSION['message'] = "personnel Enregistré";
                        $nom = '';
                    $prenom = '';
                    $observation='';
                    $id_unite=0;
                    $matricule = '';
                        break;
                     }
                    else if($z!=0)
                    {
                    
                    $_SESSION['message'] = "Matricule existe deja "; 
                    $nom = '';
                    $prenom = '';
                    $observation='';
                    $id_unite=0;
                    $matricule = '';
                    }
                }
        }
        
if (isset($_POST['update'])) 
{       $matricule = $_GET['edit'];
	$nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $observation = $_POST['observation'];
        $unite=$_POST['id_unite'];
        mysqli_query($db, "UPDATE personnel SET nom='$nom', prenom='$prenom',observation='$observation',id_unite=$unite WHERE matricule='$matricule'") or die('erreur de requet updateeeeeeee');
	$_SESSION['message'] = "Utilisateur Modifier!";
        $nom = '';
        $prenom = '';
        $observation='';
        $id_unite=0;
        $matricule = '';
    
}

if (isset($_GET['matricule'])) 
{
	$matrice = $_GET['matricule'];
	mysqli_query($db, "DELETE FROM personnel WHERE matricule='$matrice'")or die ('erreur de requet delete');
	$_SESSION['message'] = "Utilisateur suprimer"; 
}