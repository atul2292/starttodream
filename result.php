<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>


</head>


<?php
include_once 'dbinfo.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM result ORDER BY created DESC ";
$result = $conn->query($sql);


if ($result->num_rows > 0){ 
    echo '<table style="width:100%">';
    echo '  <tr> <th>exam name</th> <th>marks</th> <th>submitted on</th> <th>action</th> </tr>';
    while($row = $result->fetch_assoc()){

      $eid=$row["examid"];

      $sql = "SELECT * FROM exams WHERE examid='$eid'";
      $result2 = $conn->query($sql);

      while($row2 = $result2->fetch_assoc()){
        $examname = $row2["title"];

      }






        
        echo '  <tr> <td>'.$examname.'</td> <td>'.$row["marks"].'</td> <td>'.$row["created"].'</td> 
        <td>
        <form  action="showattempt.php" method="POST" >
         <input type="hidden" name="eid" value="'.$row["examid"].'"> 
        <button type="submit" disabled > show details</button>
        </form>
         </td> </tr> ';
      

    }
    echo '<table>';
} 

?>