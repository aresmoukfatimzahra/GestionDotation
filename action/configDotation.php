<?php 
        session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$solde = '';
	$date = '';
        $observation='';
        $numero='';
	$id = 0;
	$update = false;

	if (isset($_POST['ajouter'])) 
        {
        
        $solde = $_POST['solde'];
	$date = $_POST['date'];
        $observation=$_POST['observation'];
        $numero=$_POST['numero'];
                //echo $solde." ".$date." ".$observation." ".$numero;
                mysqli_query($db,"INSERT INTO dotation(`solde`, `date_dotation`, `observation`, `numero_puce`) VALUES ('$solde','$date','$observation','$numero')" )or die('erreur de requette insert'); 
                $_SESSION['message'] = "Dotation Enregistré"; 
		header('location: ./Gdotation.php');
                
                
	}
         

        if (isset($_POST['update'])) 
{       $id = $_GET['edit'];
	$solde = $_POST['solde'];
	$date = $_POST['date'];
        $observation=$_POST['observation'];
        $numero=$_POST['numero'];
        mysqli_query($db, "UPDATE dotation SET solde='$solde', date_dotation='$date',observation='$observation',numero_puce='$numero'  WHERE id_dota=$id") or die('erreur de requet update');
	$_SESSION['message'] = "Dotation Modifiée";
        header('location: ./Gdotation.php');
        
}

if (isset($_GET['id'])) 
{
	$id = $_GET['id'];
	mysqli_query($db, "DELETE FROM dotation WHERE id_dota=$id")or die ('erreur de requet delete');
	$_SESSION['message'] = "Dotation supprimée"; 
	header('location: ../Gdotation.php');
}