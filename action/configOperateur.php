<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$nom = '';
	$motpass = '';
        $profile='';
        $observation='';
	$id = 0;
	$update = false;
        
	if (isset($_POST['ajouter'])) 
        {
                $nom = $_POST['nom'];
		$motpass = $_POST['password'];
                $profile = $_POST['profil'];
                $observation = $_POST['observation'];
                
                mysqli_query($db,"INSERT INTO utilisateur (`nom`, `mot_passe`, `profil`, `observation`) VALUES ('$nom',  '$motpass', '$profile',  '$observation')" )or die('erreur de requette'); 
                $_SESSION['message'] = "Utilisateur Enregistre"; 
		header('location: ./Goperateur.php');
	}
        
if (isset($_POST['update'])) 
{       $id = $_GET['edit'];
	$nom = $_POST['nom'];
	$motpass = $_POST['password'];
        $profile = $_POST['profil'];
        $observation = $_POST['observation'];
        //echo $id.",".$nom.",".$motpass.",".$profile.",".$observation;
        mysqli_query($db, "UPDATE utilisateur SET nom='$nom', mot_passe='$motpass',profil='$profile',observation='$observation'  WHERE id_utilisateur=$id") or die('erreur de requet update');
	$_SESSION['message'] = "Utilisateur Modifier!";
        header('location: ./Goperateur.php');
        
}

if (isset($_GET['id'])) 
{
	$id = $_GET['id'];
	mysqli_query($db, "DELETE FROM utilisateur WHERE id_utilisateur=$id")or die ('erreur de requet delete');
	$_SESSION['message'] = "Utilisateur suprimer"; 
	header('location: ../Goperateur.php');
}