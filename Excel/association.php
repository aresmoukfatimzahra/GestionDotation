<html>
    <head>
        <meta charset="utf-8"/>
    </head>
<?php  $connect = mysqli_connect("localhost", "root", "", "gdotation");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM assocpersopuce";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Numéro puce</th>  
                         <th> Matricule</th>  
                         <th>Date affectation</th>  
                         <th>Date désaffectation</th>  
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["numero_puce"].'</td>  
                         <td>'.$row["matricule_pers"].'</td>  
                         <td>'.$row["date_affec"].'</td>  
                         <td>'.$row["date_desaffec"].'</td> 
                    </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}?>
</html>