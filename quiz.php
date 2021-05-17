<!DOCTYPE html>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>

    <body>
        
        <?php
        session_start();

      //  $_SESSION["eid"]=$_POST["eid"];
        
        $eid=$_SESSION["eid"];
        include_once "dbinfo.php";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        //getting que
        $sn=$_SESSION['sn'];
        
        
        $sql = "SELECT * FROM question_table WHERE sn='$sn' AND examid='$eid'  ";
        $result = $conn->query($sql);
        

        if ($result->num_rows > 0){
          while($row = $result->fetch_assoc()){

            ?>
            <form   action="update.php?to=submit" method="POST" >

            <?php
            echo 'Question No.'.$sn.'<br>'.$row["question"].'<br>';
            echo '<input type="radio" name="givenans" value="a" >'.$row["option1"].'</input><br>';
            echo '<input type="radio" name="givenans" value="b" >'.$row["option2"].'</input><br>';
            echo '<input type="radio" name="givenans" value="c" >'.$row["option3"].'</input><br>';
            echo '<input type="radio" name="givenans" value="d" >'.$row["option4"].'</input><br>';
            echo '<input type="hidden" name="qid" value="'.$row["qid"].'" ><br>';
            echo '<hr>';
            
          }
          echo '<button type="submit" id="back" formaction="update.php?to=previous"> previous </button>';
          echo '<button type="submit" id="next" formaction="update.php?to=next" > next </button>';
          echo '<br><br>';

          ?>
          
          <button onclick='return confirm("Are you sure you want to submit for final marking? No changes will be allowed after submission.");' type="submit" > submit test <sup>*</sup> </button>';
          
          
          <?php
          echo '</form>';
        }
        else
        echo "0 result";

        
        
        echo '
        <script>
          if('.$sn.'==1){
          document.getElementById("back").disabled = true;
          }
          if('.$sn.'=='.$_SESSION["total"].'){
            document.getElementById("next").disabled = true;
          }

         
          
        </script>


        ';
        
        
        ?>
        
          
    </body>
</html>
