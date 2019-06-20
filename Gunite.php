<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Acceuill</title>
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
   
 <?php include_once './action/configUnite.php';
  
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM  unite WHERE id_unite=$id") or die ('erreur seleeeeeect');
               
		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$nom_unite = $n['nom_unite'];
                        $type_unite = $n['type_unite'];
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
                        <a  href="AssPersPuce.php"><i class="fa fa-retweet" style="font-size:36px"></i> Association personnels-puces </a></li>
		</ul>
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Gestion des entités </h2>   
                        <h5> </h5>
                    </div>
                </div>
                 
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                    <!-- Form Elements -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                          
                                    </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                            <form  method="post"  action="">
                                     
                                       
                                         <div class="form-group">
                                            <label> Nom entité :</label>
                                            <input name="nom_unite" class="form-control" value="<?php echo $nom_unite ?>" required="" />
                                        </div>
                                        <div class="form-group">
                                            <label>Type entité :</label>
                                            <select name="type_unite" class="form-control" >
                                                <?php if (isset($_GET['edit']))
                                            {
                                               ?>
                                                <option value="<?php echo $type_unite ?>"> <?php echo $type_unite ?></option>
                                            <?php
                                            }
                                            else { ?>
                                            <option value="Direction"> Direction</option>
                                            <option value="Département"> Departement</option>
                                            <option value="Division"> Division</option>
                                            <option value="Service"> Service</option>
                                            <?php }?>
                                            </select>
                                        </div>
                                        
                                        <?php if ($update == false): ?>
            <button class="btn btn-primary" type="submit" name="Ajouter" >Ajouter</button>
        <button name="annuler" type="reset" class="btn btn-default">Annuler</button>
<?php else: ?>
	<button class="btn " type="submit" name="update" style="background: #556B2F;color: #FFF" >Sauvegarder</button>
        <button name="annuler" type="submit" class="btn btn-default">Annuler</button>
                                    <?php if(isset($_POST['annuler']))
                                     { 
                                       header('location: ./Gunite.php');
                                     } ?>
<?php endif ?>
                                                
                                    </form>
                                </div>
                                </div>
                    <!--la fin du form-->
                    
                               <div class="panel panel-default">
                    
                        <div class="panel-heading">
                             Liste des entités
                        </div>
                 <div class="panel-body">
                     <form method="post" action="fpdf/entitepdf.php" style="float: left" target="_blank">
                        <input type="submit" name="x" value="Télécharger en PDF" class="btn btn-danger square-btn-adjust"/>
                            
                        </form>
                     <form method="post" action="Excel/uniteexcel.php" >
                                <input type="submit" name="export" value="Télécharger en EXCEL" class="btn btn-success square-btn-adjust" name="export"/>
     
    </form>
                            <br>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Code Entité</th>
                                            <th>Numéro entité </th>
                                            <th>Type entité</th>
                                            <th>Modifier</th>
                                            <th>Suprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <tr class="odd gradeX">
                                           
                                        <?php
                                            $result = mysqli_query($db, "SELECT * FROM unite")or die('erreur de requet');
                                            while($e = mysqli_fetch_array($result))
                                            {
                                            ?>
                                            <form method="post" action="">   
                                            <tr>
                                                <td class="center"><?php echo $e['id_unite'];?></td>
                                                <td class="center"><?php echo $e['nom_unite'];?></td>
                                                <td class="center"><?php echo $e['type_unite'];?></td>
                                                <td><a href="<?php echo "Gunite.php?&edit=".$e['id_unite'].""?>">Modifier</a></td>
                                                <td><a href="<?php echo "./action/configUnite.php?&id=".$e['id_unite']."" ?>">Supprimer</a></td>
                                            </tr>
                                               
                                        <?php
                                        }
                                        ?>
                                         </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div>
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
