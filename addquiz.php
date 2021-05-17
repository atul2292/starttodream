<?php
session_start();
include_once 'dbinfo.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO exams (examid, title , total , etime ) VALUES (?, ?, ?,?)");
$stmt->bind_param("ssii", $eid, $name,$total,$time);

// set parameters and execute

$eid= uniqid();
$name= $_POST["name"];
$total= $_POST["total"];
$time= $_POST["time"];
$stmt->execute();


$stmt->close();
$conn->close();
$_SESSION["eid"]=$eid;
$_SESSION["total"]=$total;
$_SESSION["sn"]=1;
header("location:addque.html")
?>