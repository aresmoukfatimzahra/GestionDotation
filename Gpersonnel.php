<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Application de gestion des dotations</title>
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
      <?php include_once './action/configPersonnel.php';
  
	if (isset($_GET['edit'])) {
		$matric = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM `personnel` WHERE matricule='$matric'") or die ("Error: " . mysqli_error($db));

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$nom = $n['nom'];
                        $prenom=$n['prenom'];
                        $id_unite=$n['id_unite'];
                        $observation=$n['observation'];
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
                        <h2>Gestion des Personnels</h2>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                   
                 <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form  method="post">
                                     
                                       
                                         <div class="form-group">
                                            <label> Matricule :</label>
                                            <input name="matricule" class="form-control" value="<?php echo $matricule; ?>"/>
                                        </div>
                                         <div class="form-group">
                                            <label>Nom:</label>
                                            <input name="nom" class="form-control" value="<?php echo $nom; ?>" required=""/>
                                        </div>
                                         <div class="form-group">
                                            <label>Prénom:</label>
                                            <input name="prenom" class="form-control" value="<?php echo $prenom; ?>" required=""/>
                                        </div>
                                        <div class="form-group">
                                            <label>Observation :</label>
                                            <input name="observation" class="form-control" value="<?php echo $observation; ?>" />
                                        </div>
                                        
                                           <div class="form-group">
                                            <label>Choisir entité :</label>
                                            
                                            <select name="id_unite" class="form-control"value="<?php echo $id_unite; ?>">
                                               
                                                
                                                <?php
                                                        
                                                        $result = mysqli_query($db, "SELECT * FROM unite")or die('erreur de requet');
                                                        while($res = mysqli_fetch_array($result))
                                                        {
                                                           ?>
                                                            <option value="<?php echo $res['id_unite'];  ?>"><?php echo $res['nom_unite'];  ?></option>
                                                            <?php
                                                        }
                                                        
                                                ?>
                                            
                                            
                                            </select>
                                        
                                        </div>
                                        <?php if ($update == false): ?>
                                        <br>
                    <button class="btn btn-primary" type="submit" name="save" >Ajouter</button>
                    <button name="annuler" type="reset" class="btn btn-default">Annuler</button>
            <?php else: ?>
                    <button class="btn " type="submit" name="update" style="background: #556B2F;color: #FFF" >Sauvegarder</button>
                    <button name="annuler" type="submit" class="btn btn-default">Annuler</button>
                                 <?php if(isset($_POST['annuler']))
                                     { 
                                        header('location: ./Gpersonnel.php');
                                     } ?> 
            <?php endif ?>
                                                
                                       

                                    </form>
                                    <br />
                                   
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
                <!-- /. ROW  -->
               
                    <!--End Advanced Tables -->
                </div>
            </div>
                    </div>
                  
                  
                  
                  <div class="panel panel-default">
                    
                        <div class="panel-heading">
                             Liste des Personnels
                        </div>
                 <div class="panel-body">
                       <form method="post" action="fpdf/personnelpdf.php" style="float: left" target="_blank">
                        <input type="submit" name="x" value="Télécharger en PDF" class="btn btn-danger square-btn-adjust"/>
                            
                        </form>
                      <form method="post" action="Excel/personnelexcel.php" >
                                <input type="submit" name="export" value="Télécharger en EXCEL" class="btn btn-success square-btn-adjust" name="export"/>
     
    </form>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Matricule</th>
                                            <th>Nom</th>
                                            <th>Prenom</th>
                                            <th>Observation</th>
                                            <th>Unité</th>
                                            <th>Modifier</th>
                                            <th>Suprimer</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                 <tr class="odd gradeX">
                                        <?php
                                            $result = mysqli_query($db, "SELECT * FROM personnel")or die('erreur de requet');
                                            while($res = mysqli_fetch_array($result))
                                            {
                                        ?>
                                            <form method="post" action="">   
                                            <tr>
                                                <td class="center"><?php echo $res['matricule']  ?></td>
                                                <td class="center"><?php echo $res['nom']  ?></td>
                                                <td class="center"><?php echo $res['prenom']  ?></td>
                                                <td class="center"><?php echo $res['observation']  ?></td>
                                                <td class="center">
                                                    <?php  
                                                        $idu=$res['id_unite'];
                                                        $result2 = mysqli_query($db, "SELECT * FROM unite where id_unite= ".$idu."")or die('erreur de requet');
                                                        while($res2 = mysqli_fetch_array($result2))
                                                        {
                                                          echo $res2['nom_unite'];
                                                          
                                                        }
                                                    ?>
                                                </td>
                                                <td><a href="<?php echo "Gpersonnel.php?&edit=".$res['matricule'].""?>">Modifier</a></td>
                                                <td><a href="<?php echo "Gpersonnel.php?&matricule=".$res['matricule'].""?>">Suprimer</a></td>
                                            </tr>
                                            </form>
                                        <?php }?>
                                         </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
            
               
                  <hr />
                  
<!-- Code de gestion :-->
              
<!--  if($_POST['un']=='unite'){echo ' selected="selected"';} -->
                 
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

