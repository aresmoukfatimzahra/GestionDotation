<?php
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'gdotation');

	// initialize variables
	$code = '';
	$numero ='';
        $type='';
        $observation='';
	$etat = '';
	$update = false;
        
	if (isset($_POST['save'])) 
        {
                $code = $_POST['code'];
                $numero=$_POST['numero'];
                $type=$_POST['type'];
                $etat=$_POST['etat'];
                $observation=$_POST['observation'];
            $query = mysqli_query($db, "SELECT * FROM puce ")or die('erreur de requet');
            $z=0;
            while($re = mysqli_fetch_array($query))
            {
                
                if($code==$re['code']|| $numero==$re['numero']||($code==$re['code']&& $numero==$re['numero']))
                    {
                    $z+=1;
                    }
                else 
                    {
                    $z+=0;
                    }
                    
                if($z==0)
                    {
                        //echo "Z =".$z;
                        mysqli_query($db,"INSERT INTO puce VALUES ('$numero',  '$code', '$type',  '$etat','$observation')" )or die('erreur de requet'); 
                        $_SESSION['message'] = "puce Enregistré"; 
                        header('location: ./Gpuce.php');
                        break;
                     }
             else 
                    {
                       
                        //echo $code."_".$re['code']."|bad|".$z;
                    $_SESSION['message'] = "numero ou bien code existe deja "; 
                    $code = '';
                    $numero='';
                    $type='';
                    $etat='';
                    $observation='';
                    }
            }
            
                
                
	}
   
        
if (isset($_POST['update'])) 
{             $numero = $_GET['edit'];
	       $code = $_POST['code'];
                $type=$_POST['type'];
                $etat=$_POST['etat'];
                $observation=$_POST['observation'];
                
        mysqli_query($db, "UPDATE puce SET code='$code',type_puce='$type',etat='$etat' ,observation='$observation'  WHERE numero=$numero") or die('erreur de requet update');
	$_SESSION['message'] = "Utilisateur Modifier!";
        header('location: ./Gpuce.php');
        
}

if (isset($_GET['numero'])) 
{
	$numero = $_GET['numero'];
        //echo $numero;
	mysqli_query($db, "DELETE FROM puce WHERE numero='".$numero."'")or die ('erreur de requet delete');
	$_SESSION['message'] = "Puce supprimée "; 
	header('location: ../Gpuce.php');
}

