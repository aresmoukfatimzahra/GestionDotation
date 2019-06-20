<html>
    <head>
        <meta charset="utf-8"/>
    </head>
<?php  $connect = mysqli_connect("localhost", "root", "", "gdotation");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM puce";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Numéro puce</th>  
                         <th>Code</th>  
                         <th>Type</th>  
                         <th>Etat</th> 
                         <th>Observation</th> 
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["numero"].'</td>  
                         <td>'.$row["code"].'</td>  
                         <td>'.$row["type_puce"].'</td>  
                         <td>'.$row["etat"].'</td> 
                         <td>'.$row["observation"].'</td> 
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