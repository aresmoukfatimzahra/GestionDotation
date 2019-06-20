<html>
    <head>
        <meta charset="utf-8"/>
    </head>
<?php  $connect = mysqli_connect("localhost", "root", "", "gdotation");
$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT * FROM personnel";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Matricule</th>  
                         <th> Nom</th>  
                         <th>Prenom</th>
                         <th>Observation</th>  
                         <th>Unite</th> 
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
      
            $query2 = "SELECT * FROM unite";
            $result2 = mysqli_query($connect, $query2);
            while ($row2= mysqli_fetch_array($result2))
            {
                if ($row['id_unite']==$row2['id_unite'])
                {
                    $output .= '
                    <tr>  
                         <td>'.$row["matricule"].'</td>  
                         <td>'.$row["nom"].'</td>  
                         <td>'.$row["prenom"].'</td>  
                         <td>'.$row["observation"].'</td>
                         <td>'.$row2["nom_unite"].'</td> 
                    </tr>  ';
                }
 
            }
   }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}?>
</html>