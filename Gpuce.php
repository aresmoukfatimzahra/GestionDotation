    <!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Application gestion des dotations</title>
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
   <?php include './action/configPuce.php';
 
	if (isset($_GET['edit'])) {
		$numero = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM  puce WHERE numero=$numero");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$numero = $n['numero'];
                        $code = $n['code'];
                        $type_puce=$n['type_puce'];
                        $etat=$n['etat'];
                        $observation=$n['observation'];
                        //echo $n['numero']." ".$n['type_puce']." ".$n['observation'];
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
{ unset($_SESSION['username']);
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
                     <h2>Gestion des puces </h2>   
                       
                    </div>
                </div>      
<div class="row">
                <div class="col-md-12">
                    
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
                                    <form method="post"  >
                                         <div class="form-group">
                                            <label> Code puce :</label>
                                            <input name="code" class="form-control" value="<?php echo $code; ?>" required=""/>
                                        </div>
                                         <div class="form-group">
                                            <label> Numéro de puce :</label>
                                            <input name="numero" class="form-control" value="<?php echo $numero; ?>" required=""/>
                                        </div>
                                         <div class="form-group">
                                            <label>Type de puce :</label>
                                            <?php
                                            if (isset($_GET['edit']) ) {
                                             if ($n['type_puce']=='Voix')
                                             {
                                               ?>
                                                    <label class="checkbox-inline">
                                                        <input name="type" type="radio" value="Voix" checked=""/> Voix
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input name="type" type="radio" value="Data" /> Data
                                                    </label>
                                            
                                                <?php
                                                 
                                             }
                                             else if($n['type_puce']=='Data')
                                             {
                                                 ?>
                                                 <label class="checkbox-inline">
                                                        <input name="type" type="radio" value="Voix"/> Voix
                                                    </label>
                                                    <label class="checkbox-inline">
                                                        <input name="type" type="radio" value="Data"  checked=""/> Data
                                                    </label>
                                                 <?php
                                             }
                                            }
                                            else
                                            {
                                                ?>
                                                        <label class="checkbox-inline">
                                                            <input name="type" type="radio" value="Voix" checked=""/> Voix
                                                        </label>
                                                        <label class="checkbox-inline">
                                                            <input name="type" type="radio" value="Data" /> Data
                                                        </label>
                                                <?php
                                            }
                                            ?>
                                            
                                        </div>
                                         <div class="form-group">
                                             <?php
                                            if (isset($_GET['edit']) ) {
                                             if ($n['etat']=='Active')
                                             {
                                               ?>
                                                    <label>Etat :</label>
                                            <label class="checkbox-inline">
                                                <input name="etat" type="radio" value="Active"  checked=""/> Active
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="etat" type="radio" value="Inactive" /> Inactive
                                            </label>
                                            
                                                <?php
                                                 
                                             }
                                             else if($n['etat']=='Inactive')
                                             {
                                                 ?>
                                                 <label>Etat :</label>
                                            <label class="checkbox-inline">
                                                <input name="etat" type="radio" value="Active"  /> Active
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="etat" type="radio" value="Inactive"  checked=""/> Inactive
                                            </label>
                                                 <?php
                                             }
                                            }
                                            else
                                            {
                                                ?>
                                                        <label>Etat :</label>
                                            <label class="checkbox-inline">
                                                <input name="etat" type="radio" value="Active"  checked=""/> Active
                                            </label>
                                            <label class="checkbox-inline">
                                                <input name="etat" type="radio" value="Inactive" /> Inactive
                                            </label>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                         <div class="form-group">
                                                    <label>Observation</label>
                                                    <textarea type="text" name="observation" class="form-control" rows="3" ><?php echo $observation; ?></textarea>
                                        </div>

                            <?php if ($update == false): ?>
                                 <button class="btn btn-primary" type="submit" name="save" >Ajouter</button>
                                 <button name="" type="reset" class="btn btn-default">Annuler</button>
                            <?php else: ?>
                                 <button class="btn " type="submit" name="update" style="background: #556B2F;color: #FFF" >Sauvegarder</button>
                                 <button name="annuler" type="submit" class="btn btn-default">Annuler</button>
                                 <?php if(isset($_POST['annuler']))
                                     { 
                                        header('location: ./Gpuce.php');
                                     } ?>
                            
                            <?php endif ?>
                                 
                        </form>
                        <br />
                                   
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
                
                </div>
            </div>
                    </div>
                         <!-- Advanced Tables -->
                <br/>
                    <div class="panel panel-default">
                       
                        <div class="panel panel-default">
                        <div class="panel-heading">
                             Liste des puces :
                        </div>
                        <div class="panel-body">
                            <form method="post" action="fpdf/pucepdf.php" style="float: left" target="_blank">
                        <input type="submit" name="x" value="Télécharger en PDF" class="btn btn-danger square-btn-adjust"/>
                            
                        </form>
                            <form method="post" action="Excel/puceexcel.php" >
                                <input type="submit" name="export" value="Télécharger en EXCEL" class="btn btn-success square-btn-adjust" name="export"/>
     
        </form>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            
                                            <th>Code</th>
                                            <th>Numéro  </th>
                                            <th>Type </th>
                                            <th>Etat</th>
                                            <th>Observation</th>
                                            <th>Modifier</th>
                                            <th>Suprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr class="odd gradeX">
                                           
                                        <?php
                                            require_once './Services/PuceService.php';
                                            require_once './Classes/Puce.php';
                                            $dot=new PuceService();
                                            foreach ($dot->findAll() as $key=>$e) 
                                            {
                                        ?>
                                            <form method="post" action="">   
                                            <tr>
                                                <td class="center"><?php echo $e->getCode();?></td>
                                                <td class="center"><?php echo $e->getNumero();?></td>
                                                <td class="center"><?php echo $e->getType();?></td>
                                                <td class="center"><?php echo $e->getEtat();?></td>
                                                <td class="center"><?php echo $e->getObservation();?></td>
                                                
                                                <td><a href="<?php echo "Gpuce.php?&edit=".$e->getNumero().""?>">Modifier</a></td>
                                                <td><a href="<?php echo "./action/configPuce.php?&numero=".$e->getNumero()."" ?>">Supprimer</a></td>
                                            </tr>
                                               
                                        <?php
                                        }
                                        ?>
                                         </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
        
        
           
                    </div>
                  <hr />
                  
              <!--     Code de gestion -->
                                             
    

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

