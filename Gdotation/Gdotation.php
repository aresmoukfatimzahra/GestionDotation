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
                 <a class="navbar-brand" href="index.php"></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;">

<script> document.write(new Date().toLocaleDateString()); </script>
<a href="#" class="btn btn-danger square-btn-adjust">Se deconnecter</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/radeema.png" class=""/>
					</li>
							
                    <li>
                        <a class=""  href="index.php"><i class="fa fa-dashboard fa-3x"></i> Tableau de bord</a>
                    </li>
                     <li>
                         <a  href="Goperateur.php"><i class="fa fa-desktop fa-3x"></i> Gestion des Operateurs</a>
                    </li>
                    <li>
                        <a  href="Gdotation.php"><i class="fa fa-cloud" style="font-size:36px"></i> Gestion de Dotation</a>
                    </li>
						   <li  >
                       <a   href="Gpuce.php"><i style="font-size:36px" class="fa">&#xf114;</i> Gestion des Puces</a>
                    </li>	
                      <li  >
                          <a  href="Gunite.php"><i class="fa fa-table fa-3x"></i> Gestion Des Entites</a>
                    </li>
                    <li  >
                        <a  href="Gpersonnel.php"><i class="fa fa-male" style="font-size:36px"></i> Gestion de Personnels </a>
                    </li>				
				
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                       
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
                            Gestion des dotations
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form  method="post" action="Gdotation.php" onSubmit="return: validation();" >
                                     
                                       
                                         <div class="form-group">
                                            <label> Solde :</label>
                                            <input name="solde" class="form-control"  />
                                        </div>
                                         <div class="form-group">
                                            <label>Date de dotation :</label>
                                            <input name="date" class="form-control"  />
                                        </div>
                                        <div class="form-group">
                                            <label>Observation :</label>
                                            <input name="observation" class="form-control"  />
                                        </div>
                                      <div class="form-group">
                                            <label>Numero de puce :</label>
                                          
                                            <select name="numero" class="form-control">
                                                   <?php 
                                                 include_once './Services/PuceService.php';                                      
                                                 $es = new PuceService();
                                                 foreach ($es->findAll() as $key => $e) {
                                                ?>
                                                <option name = "numero_puce" ><?php echo $e->getNumero();?></option>
                                                <?php
                                         }
                                         ?>
                                            </select>
                                        
                                        </div>
                                      
                                        <button type="reset" class="btn btn-primary">Annuler</button>
                                        <button type="submit" name="Valider" class="btn btn-default" value="Valider">Valider </button>

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
                        <div class="panel-heading">
                             Tableau des dotations :
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th> dotation num° </th>
                                            <th>solde</th>
                                            <th>date</th>
                                            <th>Observation</th>
                                            <th>Numero de puce</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                include_once './Services/DotationService.php';
                $cs = new DotationService();
                foreach ($cs->findAll() as $c) {
                    ?>
                                        <tr class="odd gradeX">
                                            <td name="id" id="id"><?php echo $c->getId_dotation(); ?></td>
                                            <td><?php echo $c->getSolde(); ?></td>
                                            <td><?php echo $c->getDate_dotation(); ?></td>
                                            <td><?php echo $c->getObservation(); ?></td>
                                            <td><?php echo $c->getNumero_puce(); ?></td>
                                            <td><input type="submit" name="Modifier" value="Modifier" class="btn btn-success"></td>
                                             <td><input type="submit" name="supprimer" value="Supprimer"  class="btn btn-success"></td>
                                         
                                        </tr>
                                      <?php } ?> 
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
        
        
           
                    </div>
                  <hr />
                  
                  <?php 
include_once './Services/UnitéService.php';

if(isset($_POST['Valider']))
{
        $solde =$_POST['solde'];
        $date =$_POST['date'];
        $numero =$_POST['numero'];
	$observation =$_POST['observation'];
        $id_dotation =NULL;
        if(empty($solde)  OR empty($date) OR empty($numero) )  
    {  
    echo '<font color="red" >Attention, tous les champs ne sont pas renseignés !</font>';  
    } 
 else {
        $es = new DotationService();
        $es->create(new Dotation($id_dotation, $solde, $date,$observation,$numero));
        echo '<meta http-equiv="refresh" content="0">';
    }   
}

if(isset($_POST['supprimer']))
{
        $conn = mysqli_connect('localhost','root','','gdotation') or die("erreur de connexion");
        $id =$_POST['id'];
//	$cs = new DotationService();
//        $cs->delete($cs->finById($id)); 
	$req="delete from `dotation` where id_dota='".$id."'";
	mysqli_query($conn,$req) or die('erreur de selection de donnee');
         echo '<font color="red" >Attention, tous les champs ne sont pas renseignés !</font>'; 
}
?>

                  

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

