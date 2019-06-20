<?php


	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$nom_unite = "";
	$type_unite = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) 
        {
		$nom_unite = $_POST['nom_unite'];
		$type_unite = $_POST['type_unite'];

		mysqli_query($db, "INSERT INTO unité (nom_unite, type_unite) VALUES ('$nom_unite', '$type_unite')"); 
		$_SESSION['message'] = "saved"; 
		header('location: Gunite.php');
	}
        
if (isset($_POST['update'])) 
{
	$id = $_POST['id'];
	$nom_unite = $_POST['nom_unite'];
	$type_unite = $_POST['type_unite'];

	mysqli_query($db, "UPDATE unité SET nom_unite='$nom_unite', type_unite='$type_unite' WHERE id_unite=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: Gunite.php');
}

if (isset($_GET['del'])) 
{
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM unité WHERE id_unite=$id");
	$_SESSION['message'] = " deleted!"; 
	header('location: Gunite.php');
}
