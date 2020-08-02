<?php

if ($_GET['heart'] = "incremID") {
  incremID();
}

function incremID() {
  include ('connect.php');

  try {

      // $query = $conn->prepare("SELECT 'LPAD(nextAvailableiD, 4, 0)' FROM idNum");
      $query = $conn->prepare("SELECT * FROM getid");
      $query->execute();

      $result = $query->fetch(PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo $result['nextAvailableiD'];
      return $result['nextAvailableiD'];


    } catch(PDOException $error) {
        $message = $error->getMessage();
        echo $message;
    }
}

?>
