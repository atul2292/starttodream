<?php
session_start();
//updating database





include_once 'dbinfo.php';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO history (attemptid, qid , givenans ) VALUES (?, ?, ?)");
$stmt->bind_param("sss",$attemptid ,$qid ,$givenans);

$attemptid=$_SESSION["attemptid"];
$qid=$_POST["qid"];
$givenans=$_POST["givenans"];
$stmt->execute();

$stmt->close();
$conn->close();



$to=$_GET["to"];

if ($to=="previous") {
    $_SESSION["sn"]--;
} else {
    $_SESSION["sn"]++;
} 

if($to=="submit"){
  header("location:endquiz.php");
  
} else {
  header("location:quiz.php");
  
}





?>