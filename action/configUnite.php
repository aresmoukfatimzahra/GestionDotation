<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$nom_unite = '';
	$type_unite = '';
	$id = 0;
	$update = false;
        
	if (isset($_POST['Ajouter'])) 
        {
               $nom_unite=$_POST['nom_unite'];
                $type_unite=$_POST['type_unite'];
                mysqli_query($db,"INSERT INTO unite (`nom_unite`, `type_unite`) VALUES ('$nom_unite','$type_unite')" )or die('erreur de requette'); 
                $_SESSION['message'] = "Unité Enregistré"; 
		header('location: ./Gunite.php');
	}
        
if (isset($_POST['update'])) 
{       $id = $_GET['edit'];
        $nom_unite=$_POST['nom_unite'];
        $type_unite=$_POST['type_unite'];
        mysqli_query($db, "UPDATE unite SET nom_unite='$nom_unite', type_unite='$type_unite'  WHERE id_unite=$id") or die('erreur de requette update');
	$_SESSION['message'] = "Unité Modifiée!";
        header('location: ./Gunite.php');
        
}

if (isset($_GET['id'])) 
{
	$id = $_GET['id'];
	mysqli_query($db, "DELETE FROM unite WHERE id_unite=$id")or die ('erreur de requet delete');
	$_SESSION['message'] = "unité suprimé"; 
	header('location: ../Gunite.php');
}
