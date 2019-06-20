<html>
    <head>
        <meta charset="utf-8"/>
    </head>
<?php  $connect = mysqli_connect("localhost", "root", "", "gdotation");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM dotation";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Id</th>  
                         <th>Solde</th>  
                         <th>Date</th>  
                         <th>Observation</th>
                         <th>Numéro de puce</th>
                         
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["id_dota"].'</td>  
                         <td>'.$row["solde"].'</td>  
                         <td>'.$row["date_dotation"].'</td>  
                         <td>'.$row["observation"].'</td> 
                         <td>'.$row["numero_puce"].'</td> 
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
