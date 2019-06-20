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
                     <h2>Gestion des dotations</h2>   
                        <h5> </h5>
                    </div>
                </div>              
                 <!-- /. ROW  -->
                 
                 
                 <div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                <form method="post" action="">
                                <div class="form-group">
                                            <label>Solde</label>
                                            <input type="text" name="solde" class="form-control" placeholder="Solde en DH" value="<?php echo $solde; ?>" required=""/>
                                </div>
                                <div class="form-group">
                                            <label>Date dotation</label>
                                            <input type="date" name="date" class="form-control" value="<?php echo $date; ?>" required=""/>
                                </div>
                                <div class="form-group">
                                            <label>Observation</label>
                                            <textarea type="text" name="observation" class="form-control" rows="3"><?php echo $observation; ?></textarea>
                                </div>
                                 <div class="form-group">
                                     <label>Numéro Puce</label>
                                            <select name="numero" class="form-control " required="">
                                               <?php
                                                $db=  mysqli_connect('localhost','root','', 'gdotation');
                                                $query=mysqli_query($db, "select * from puce where numero not in(select numero_puce from dotation)");
                                                 while ($row = mysqli_fetch_array($query)) { 
                                                ?>
                                                            <option value="<?php echo $row['numero'];?>"><?php echo $row['numero'];?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            
                                </div>
                                        <?php if ($update == false): ?>
        <button class="btn btn-primary" type="submit" name="ajouter" >Ajouter</button>
                <button name="annuler" type="reset" class="btn btn-default">Annuler</button>
<?php else: ?>
	<button class="btn " type="submit" name="update" style="background: #556B2F;color: #FFF" >Sauvegarder</button>
        <button name="annuler" type="submit" class="btn btn-default">Annuler</button>
                                 <?php if(isset($_POST['annuler']))
                                     { 
                                        header('location: ./Gdotation.php');
                                     } ?>                               
<?php endif ?>
                                            
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
                <hr />
                  <div class="col-md-12">
                    <!-- Advanced Tables -->
                     <div class="panel panel-default">
                    
                        <div class="panel-heading">
                             Liste des dotations
                        </div>
                 <div class="panel-body">
                     <form method="post" action="fpdf/dotationpdf.php" style="float: left" target="_blank">
                        <input type="submit" name="x" value="Télécharger en PDF" class="btn btn-danger square-btn-adjust"/>
                            
                        </form>
                     <form method="post" action="Excel/dotationexcel.php" >
                                <input type="submit" name="export" value="Télécharger en EXCEL" class="btn btn-success square-btn-adjust" name="export"/>
     
    </form>
                            <br>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Solde</th>
                                            <th>Date Dotation</th>
                                            <th>Observation</th>
                                            <th>Numero puce</th>
                                            <th>Modifier</th>
                                            <th>Suprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <?php
                    include_once './Services/DotationService.php';
                    $dot=new DotationService();
                    foreach ($dot->findAll() as $key=>$e) 
                    {
                      ?>
                
                    <tr>
                        <td class="center"><?php echo $e->getSolde()."dh";?></td>
                        <td class="center"><?php echo $e->getDate_dotation();?></td>
                        <td class="center"><?php echo $e->getObservation();?></td>
                        <td class="center"><?php echo $e->getNumero_puce();?></td>
                        <td><a href="<?php echo "Gdotation.php?&edit=".$e->getId_dotation().""?>">Modifier</a></td>
                        <td><a href="<?php echo "./action/configDotation.php?&id=".$e->getId_dotation()."" ?>">Suprimer</a></td>
                    </tr>
                <?php
                }
                ?>
                                         
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
                </tbody>
            </table>
        </form>
                    
               
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


