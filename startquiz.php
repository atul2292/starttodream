<?php
session_start();

$eid = $_POST["eid"];

include_once 'dbinfo.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM exams WHERE examid='$eid' ";
$result = $conn->query($sql);

if ($result->num_rows > 0){ 
    while($row = $result->fetch_assoc()){
        $_SESSION["eid"]=$eid;
        $_SESSION["total"]=$row["total"];
        $_SESSION["sn"]=1;
    }
}
$_SESSION["attemptid"]=uniqid();
header("location:quiz.php");

?>