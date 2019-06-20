<?php
$db = mysqli_connect('localhost', 'root', '', 'gdotation');
require './fpdf.php';
class PDF extends FPDF
{

function Header()
{
    $this->Image('logoRadeema.gif',2,6,30);
    $this->Ln(40);
    $this->SetFont('Arial','B',15);
    // Décalage à droite
    $this->Cell(80);
    // Titre
    $this->Cell(30,20,'Liste des utilisateurs ','C');
    // Saut de ligne
    $this->Ln(20);
}


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
$width_cell=array(20,45,25,60,40);


$pdf->SetFillColor(193,229,252); 
$pdf->Cell($width_cell[0],10,utf8_decode('Id '),1,0,'C',true); 
$pdf->Cell($width_cell[1],10,utf8_decode('Nom utilisateur '),1,0,'C',true);
$pdf->Cell($width_cell[2],10,utf8_decode('Mot de passe'),1,0,'C',true);
$pdf->Cell($width_cell[2],10,utf8_decode('Profil'),1,0,'C',true); 
$pdf->Cell($width_cell[4],10,utf8_decode('Observation'),1,1,'C',true); 

$pdf->SetFont('Arial','',14);
$pdf->SetFillColor(235,236,236); 
$fill=false; 
$con=new pdo("mysql:host=localhost;dbname=gdotation","root","");
$query='';

    $query= $con-> query("SELECT * FROM `utilisateur`");
        
    $puce=$query->fetchAll();
    
 foreach ($puce as $row)
        	   
               {
$pdf->Cell($width_cell[0],10,$row['id_utilisateur'],1,0,'C',$fill);
$pdf->Cell($width_cell[1],10,utf8_decode($row['nom']),1,0,'L',$fill);
$pdf->Cell($width_cell[2],10,utf8_decode($row['mot_passe']),1,0,'C',$fill);
$pdf->Cell($width_cell[2],10,utf8_decode($row['profil']),1,0,'C',$fill);
$pdf->Cell($width_cell[4],10,utf8_decode($row['observation']),1,1,'C',$fill);
$fill = !$fill;
}

$pdf->Output();
?>
