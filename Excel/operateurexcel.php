<html>
    <head>
        <meta charset="utf-8"/>
    </head>
<?php  $connect = mysqli_connect("localhost", "root", "", "gdotation");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM utilisateur";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>id</th>  
                         <th>nom</th>  
                         <th>mot de passe </th> 
                         <th>Profil </th> 
                         <th>Observation </th> 
       
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["id_utilisateur"].'</td>  
                         <td>'.$row["nom"].'</td>  
                         <td>'.$row["mot_passe"].'</td>  
                         <td>'.$row["profil"].'</td> 
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

