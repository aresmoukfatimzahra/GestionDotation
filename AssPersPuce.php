<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion d'association</title>
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
   
 
<?php  include('./action/configAss.php'); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
                $record = mysqli_query($db, "SELECT * FROM assocpersopuce WHERE numero_puce=$id")or die('erreur de requet');

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$num = $n['numero_puce'];
			$matricule = $n['matricule_pers'];
                        $dateAffectation=$n['date_affec'];
                        $dateDesaffectation=$n['date_desaffec'];
		}
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
                        <h2>Gestion des associations personnels puces </h2> 
                        <h5> </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
        
<div class="panel panel-default">
       
   
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    
                  
                                    <form method="post" action="" >
        <input type="hidden" name="id" value="<?php echo $id; ?>" >
		<div class="input-group">
			<label>Numero Puce</label>
                        <select name="num" class="form-control">
                                <?php
                    $db=  mysqli_connect('localhost','root','', 'gdotation');
                    $query=mysqli_query($db, "select * from puce where numero not in(select numero_puce from assocpersopuce)");
                     while ($row = mysqli_fetch_array($query)) { 
                            
                     
                  ?>
                                <option value="<?php echo $row['numero'];?>"><?php echo $row['numero'];?></option>
                    <?php
                    }
                    ?>
                                
                            </select>
                </div>
		<div class="input-group">
			<label>Matricule  </label>
			<select name="matricule" class="form-control">
                                <?php
                    $db=  mysqli_connect('localhost','root','', 'gdotation');
                    $query=mysqli_query($db, "select * from personnel where matricule not in (select matricule_pers from assocpersopuce)");
                     while ($row = mysqli_fetch_array($query)) { 
                    ?>
                     <option value="<?php echo $row['matricule'];?>"><?php echo $row['matricule'];?></option>
                    <?php
                    }
                    ?>
                    </select>
		</div>
                    
                <div class="input-group">
			<label>Date d'affectation </label>
                        <input type="date" name="affectation" value="<?php echo $dateAffectation; ?>" class="form-control">
		</div> 
                <div class="input-group">
			<label>Date désaffectation </label>
                        <input type="date" name="desaffectation" value="<?php echo $dateDesaffectation; ?>" class="form-control">
		</div>
            <br>
		<div class="input-group">
                    <?php if ($update == false): ?>
                                 <button class="btn btn-primary" type="submit" name="save" >Ajouter</button>
                            <?php else: ?>
                                 <button class="btn " type="submit" name="update" style="background: #556B2F;color: #FFF" >Sauvegarder</button>
                            <?php endif ?>
                                 <button name="annuler" type="submit" class="btn btn-default">Annuler</button>
                                 <?php if(isset($_POST['annuler']))
                                     { 
                                        header('location: ./AssPersPuce.php');
                                     } ?>
		</div>
    </form>
                                    
                                </div>
                            </div>
                        </div>
</div>
           
    <?php $results = mysqli_query($db, "SELECT * FROM assocpersopuce"); ?>
<div class="panel panel-default">
    <br>
                        <div class="panel-heading">
                            Liste des associations personnels puces 
                        </div>
                        <div class="panel-body">
                            <form method="post" action="fpdf/associationpdf.php" style="float: left" target="_blank">
                        <input type="submit" name="x" value="Télécharger en PDF" class="btn btn-danger square-btn-adjust"/>
                            
                        </form>
        <form method="post" action="Excel/association.php" >
                                <input type="submit" name="export" value="Télécharger en EXCEL" class="btn btn-success square-btn-adjust" name="export"/>
     
    </form
                            <br>
                            <div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th>Date d'affectation</th>
                        <th>Date désaffectation</th>
                        <th>Numéro</th>
			<th>Matricule</th>
                        <th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php 
        while ($row = mysqli_fetch_array($results)) { 
            
            ?>
		<tr>
                    <td><?php echo $row['date_affec']; ?></td>
                    <td><?php echo $row['date_desaffec']; ?></td>
                    <td><?php echo $row['numero_puce']; ?></td>
                    <td><?php echo $row['matricule_pers']; ?></td>
                    <td>
                            <a href="AssPersPuce.php?edit=<?php echo $row['numero_puce']; ?>" class="edit_btn" >Modifier</a>
                    </td>
                    <td>
                        <a href="action/configAss.php?del=<?php echo $row['numero_puce']; ?>" class="del_btn">Supprimer</a>
                    </td>
		</tr>
	<?php } ?>
</table>
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


