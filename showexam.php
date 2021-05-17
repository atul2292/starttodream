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

$sql = "SELECT * FROM exams ";
$result = $conn->query($sql);

if ($result->num_rows > 0){ 
    echo '<table style="width:100%">';
    echo '  <tr> <th>exam name</th> <th>total question</th> <th>duration</th> <th>action</th> </tr>';
    while($row = $result->fetch_assoc()){
        echo '';
        echo '  <tr> <td>'.$row["title"].'</td> <td>'.$row["total"].'</td> <td>'.$row["etime"].'</td> 
        <td>
        <form  action="startquiz.php" method="POST" >
         <input type="hidden" name="eid" value="'.$row["examid"].'"> 
        <button type="submit" >go</button>
        </form>
         </td> </tr> ';

    }
    echo '<table>';
}    
?>
