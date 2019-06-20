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
    $this->Cell(30,20,'Liste des puces','C');
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
$width_cell=array(20,45,25,25,80);


$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'Code',1,0,'C',true); // First header column 
$pdf->Cell($width_cell[1],10,'Numero',1,0,'C',true); // Second header column
$pdf->Cell($width_cell[2],10,'Type',1,0,'C',true); // Third header column 
$pdf->Cell($width_cell[3],10,'Etat',1,0,'C',true); // Fourth header column
$pdf->Cell($width_cell[4],10,'Observation',1,1,'C',true); // Third header column 

//// header ends ///////

$pdf->SetFont('Arial','',14);
$pdf->SetFillColor(235,236,236); // Background color of header 
$fill=false; // to give alternate background fill color to rows 
$con=new pdo("mysql:host=localhost;dbname=gdotation","root","");
$query='';

    $query= $con-> query("SELECT * FROM `puce`");
        
    $puce=$query->fetchAll();
 		
/// each record is one row  ///
 foreach ($puce as $row)
        	   
               {
$pdf->Cell($width_cell[0],10,$row['code'],1,0,'C',$fill);
$pdf->Cell($width_cell[1],10,$row['numero'],1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,$row['type_puce'],1,0,'C',$fill);
$pdf->Cell($width_cell[3],10,$row['etat'],1,0,'C',$fill);
$pdf->Cell($width_cell[4],10,$row['observation'],1,1,'C',$fill);
$fill = !$fill; // to give alternate background fill  color to rows
}
/// end of records /// 

$pdf->Output();


        ?>

