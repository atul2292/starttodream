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
$stmt = $conn->prepare("INSERT INTO question_table (qid,examid,sn,question, option1, option2, option3, option4, answer, explains) VALUES (?, ?,?, ?,?,?,?,?,?,?)");
$stmt->bind_param("ssisssssss",$qid,$eid ,$sn,$que, $opt1, $opt2,$opt3,$opt4,$ans,$exp);

// set parameters and execute
$qid=uniqid();
$eid=$_SESSION["eid"];
$sn=$_SESSION["sn"];
$que= $_POST["que"];
 $opt1= $_POST["opt1"];
  $opt2= $_POST["opt2"];
  $opt3= $_POST["opt3"];
  $opt4= $_POST["opt4"];
  $ans= $_POST["ans"];
  $exp= $_POST["exp"];
$stmt->execute();
//echo "created";

$stmt->close();
$conn->close();

if($_SESSION["sn"]==$_SESSION["total"]){
  header("location:index.html");
}
else{
  $_SESSION["sn"]++;
  header("location:addque.html");
}
//echo $_SESSION["sn"];
?>