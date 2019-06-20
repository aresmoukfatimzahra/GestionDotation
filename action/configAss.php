<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$name = "";
	$address = "";
        $dateAffectation="";
        $dateDesaffectation="";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) 
        {
                $num = $_POST['num'];
		$nom = $_POST['matricule'];
                $a=$_POST['affectation'];
                $dateAffectation = $_POST['affectation'];
                $dateDesaffectation = $_POST['desaffectation'];
                
                       
                
                
                mysqli_query($db,"INSERT INTO  `gdotation`.`assocpersopuce` (
`date_affec` ,
`date_desaffec` ,
`numero_puce` ,
`matricule_pers`
)
VALUES (
'$dateAffectation',  '$dateDesaffectation',  '$num',  '$nom'
);" )or die('erreur d insertion'); 
                $_SESSION['message'] = "Association Enregistre"; 
		header('location: ./AssPersPuce.php');
                
	}
        
if (isset($_POST['update'])) 
{
	$num = $_POST['num'];
	$matricule = $_POST['matricule'];
        $dateAffectation=$_POST['affectation'];
        $dateDesaffectation=$_POST['desaffectation'];
        mysqli_query($db, "UPDATE assocpersopuce SET date_affec='$dateAffectation', date_desaf='$dateDesaffectation',matricule_pers='$matricule'  WHERE numero_puce=$numero");
	$_SESSION['message'] = "Puce updated!"; 
	header('location:./AssPersPuce.php ');
}

if (isset($_GET['del'])) 
{
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM assocpersopuce WHERE numero_puce=$id")or die ('non suprimer');
	$_SESSION['message'] = "Puces deleted!"; 
	header('location: ../AssPersPuce.php');
        
}