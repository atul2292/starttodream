<?php
session_start();
include_once 'dbinfo.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$attemptid=$_SESSION["attemptid"];
//$attemptid="5eec6e214bd88";
$eid=$_SESSION["eid"];
$total=0;

$sql = "SELECT * FROM history WHERE attemptid='$attemptid' ";
$result = $conn->query($sql);

if ($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $qid=$row["qid"];
        $givenans=$row["givenans"];
        echo $qid,"<br>";
        echo $givenans,"<br>";

        $sql="SELECT * FROM question_table WHERE qid='$qid' ";
        $result2= $conn->query($sql);

        if ($result2->num_rows > 0){
            while($row2 = $result2->fetch_assoc()){
                $ans=$row2["answer"];
                echo $ans,"<br>";
            }
        }

        if($givenans==$ans){
            $total+=4;
        } else{
            $total-=1;
        }

        echo $total,"<br>";
    }
}


// prepare and bind
$stmt = $conn->prepare("INSERT INTO result (attemptid, examid , marks ) VALUES (?, ?, ?)");
$stmt->bind_param("ssi",$attemptid ,$eid ,$total);

$stmt->execute();

$stmt->close();

header("location:result.php")

?>