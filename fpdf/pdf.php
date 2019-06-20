<?php
$db = mysqli_connect('localhost', 'root', '', 'gdotation');
require './fpdf.php';
class PDF extends FPDF
{
 //En-tête
function Header()
{
        
     //Logo
    $this->Image('logoRadeema.gif',2,6,30);
    $this->Ln(40);
    // Police Arial gras 15
    $this->SetFont('Arial','B',15);
    // Décalage// à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,20,'Liste des dotations ','C');
    // Saut de ligne
    $this->Ln(20);
}

//// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}
}
$pdf = new PDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Helvetica','',11);
$pdf->SetTextColor(0);
$width_cell=array(20,20,30,80,40);


$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'Id',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'Solde',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'Date de dotation',1,0,'C',true); // Third header column 
$pdf->Cell($width_cell[3],10,'Observation',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[4],10,utf8_decode('Numéro de puce '),1,1,'C',true); // Third header column 

//// header ends ///////

$pdf->SetFont('Arial','',14);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 
$con=new pdo("mysql:host=localhost;dbname=gdotation","root","");
$query='';
if ($_POST['date1']=='' and $_POST['date2']=='')
{
    $query= $con-> query("SELECT * FROM `dotation`");
	 
}
else if ($_POST['date1']=='')
{
   $date2=$_POST['date2'];
   $query= $con-> query("SELECT * FROM `dotation` WHERE date_dotation <'".$date2."'");
	
}
else if($_POST['date2']=='')
{
    $date1 = $_POST['date1'];
   $query= $con-> query("SELECT * FROM `dotation` WHERE date_dotation >'".$date1."'"); 
}
else 
{
    $date1 = $_POST['date1'];
    $date2=$_POST['date2'];
    $query= $con-> query("SELECT * FROM `dotation` WHERE date_dotation BETWEEN '".$date1."' and '".$date2."'");
	 
}
                
		$utilisateur=$query->fetchAll();
 		
/// each record is one row  ///
 foreach ($utilisateur as $row)
        	   
               {
$pdf->Cell($width_cell[0],10,$row['id_dota'],1,0,'C',$fill);
$pdf->Cell($width_cell[1],10,$row['solde'],1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,$row['date_dotation'],1,0,'C',$fill);
$pdf->Cell($width_cell[3],10,utf8_decode($row['observation']),1,0,'C',$fill);
$pdf->Cell($width_cell[4],10,$row['numero_puce'],1,1,'C',$fill);
$fill = !$fill; // to give alternate background fill  color to rows
}
/// end of records /// 

$pdf->Output();


        ?>
