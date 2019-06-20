<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion Dotation</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <?php include_once './action/configDotation.php';?>
   <?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM  dotation WHERE id_dota=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$solde = $n['solde'];
                        $date = $n['date_dotation'];
                        $observation=$n['observation'];
                        $numero=$n['numero_puce'];
		}
	}
?>
   <?php 
   $mysqli = mysqli_connect('localhost','root','','gdotation');
   $result = mysqli_query($mysqli, "SELECT * FROM  `puce` where numero not in (select numero_puce from assocpersopuce)");
   $nbrpuce=0;
   while ($res = mysqli_fetch_array($result))
   {
       $nbrpuce+=1;
   }
   
   $result2 = mysqli_query($mysqli, "SELECT * FROM  `personnel`");
   $nbrpersonnel=0;
   while ($res2 = mysqli_fetch_array($result2))
   {
       $nbrpersonnel+=1;
   }
   
   $result3 = mysqli_query($mysqli, "SELECT * FROM  `dotation`");
   $nbrdotation=0;
   while ($res3 = mysqli_fetch_array($result3))
   {
       $nbrdotation+=1;
   }

   $result4 = mysqli_query($mysqli, "SELECT nom FROM  `personnel`  WHERE matricule  IN (SELECT matricule_pers FROM assocpersopuce)");
   $nbrperdot=0;
   while ($res4 = mysqli_fetch_array($result4))
   {
       $nbrperdot+=1;
   }
?>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  class="fa fa-user navbar-brand"   style=""><?php
                if($_SESSION['username']=='')
                        {
                        header('location: ./Authentification.php');
                        }
                        echo '      '.$_SESSION['username']; ?></a>
                
            </div>
</a>
            <div style="color: white;
padding: 10px 10px 10px 5px;
float: right;
font-size: 16px;">
                
<!--<script> document.write(new Date().toLocaleDateString()); </script>-->
      <form method="post">
          <script> document.write(new Date().toLocaleDateString()); </script>
          <input type="submit" name="x" value="Se deconnecter" class="btn btn-warning">
<?php 
if (isset($_POST['x']))
{
    unset($_SESSION['username']);
    header('location: ./Authentification.php');
}?>
      </form>
        </nav>   
           <!-- /. NAV TOP  -->
                                   <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <a href="index.php"  > <img src="assets/img/radeema.png" class=""/></a>
					</li>
                    <li>
                        <a href="index.php"><i class="fa fa-dashboard fa-3x"></i>Tableau de bord</a>
                    </li>
                     <?php
                    if ($_SESSION['profil']=='admin')
                    {?>
                     <li>
                         <a  href="Goperateur.php"><i class="fa fa-desktop fa-3x"></i> Gestion des opérateurs</a>
                    </li> <?php
                     }
                     ?>
                    <li>
                        <a  href="Gdotation.php"><i class="fa fa-cloud" style="font-size:36px"></i> Gestion des dotations</a>
                    </li>
                     <li  >
                    <a   href="Gpuce.php"><i style="font-size:36px" class="fa">&#xf114;</i> Gestion des puces</a>
                    </li>	
                      <li  >
                          <a  href="Gunite.php"><i class="fa fa-table fa-3x"></i> Gestion des entités</a>
                    </li>
                    <li  >
                        <a  href="Gpersonnel.php"><i class="fa fa-male" style="font-size:36px"></i> Gestion des personnels </a>
                    </li>
                    <li  >
                        <a  href="AssPersPuce.php"><i class="fa fa-retweet" style="font-size:36px"></i> Association personnels-puces </a>
                    </li>
		</ul>
            </div>
            
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">  
                        <h5> </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                 
                <div class="row">
                    
                <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-brown set-icon">
                                <i class=""><?php echo $nbrperdot; ?></i>
                            </span> 
                            <div class="text-box" >
                                <p class="main-text ">Personnes bénéficiées</p>
                            </div>
                        </div>
		</div>
                    
               <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                            <i class=""><?php echo $nbrpuce ?></i>
                            </span>
                            <div class="text-box" >
                                <p class="main-text"> Puces en stock </p>
                            </div>
                        </div>
		</div>
                    
                 <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class=""><?php echo $nbrdotation; ?></i>
                            </span> 
                            <div class="text-box" >
                                <p class="main-text ">Dotations</p>
                            </div>
                        </div>
		</div>
                    
                    
                <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class=""><?php echo $nbrpersonnel; ?></i>
                            </span> 
                            <div class="text-box" >
                                <p class="main-text ">Personnels</p>
                            </div>
                        </div>
		</div>
            </div>
                 
                 <hr>    
        <div class="row">         
                     <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Liste des dotations
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="post" action="fpdf/pdf.php" role="form" target ="_blank"  >
                                    <div>
                                    <label>De :</label>
                                    <input type="date" name="date1" class="form-control" />
                                    <label>A :</label>
                                    <input type="date" name="date2" class="form-control"/>
                                    <br>
                                        <input type="submit" name="btn" value="afficher la liste en PDF  " class="btn btn-danger square-btn-adjust" style="width: 300px">
                                    </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
                
        </div> 
        </div>
                  
      </div>
    </div>
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
