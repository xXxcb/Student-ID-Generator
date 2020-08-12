<?php



if (!empty($_POST['fname']) || !empty($_POST['lname'])) {

  $fname = check_input($_POST['fname']);
  $lname = check_input($_POST['lname']);
  $id    = check_input($_POST['idNumber']);
  $email = check_input($_POST['staticEmail']);
  $prog = check_input($_POST['prog']);
  $acad_year = check_input($_POST['acad_year']);
  $user_name = $_POST['username'];
  $datee = date("yy-m-d h:i:sa");

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

session_start();
if(empty($_SESSION['username'])) {


  $message = "You need to be logged in to complete this operation!";
  header("Location: index.php");
} else {

          try {

            include ('connect.php');

            $query = $conn->prepare('CALL InsertStudent(:id, :fname, :lname, :prog, :email, :acad_year, :user_name)');

            $query->bindParam(':fname', $fname, PDO::PARAM_STR, 45);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR, 45);
            $query->bindParam(':id', $id, PDO::PARAM_STR, 45);
            $query->bindParam(':prog', $prog, PDO::PARAM_STR, 64);
            $query->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $query->bindParam(':acad_year', $acad_year, PDO::PARAM_STR, 45);
            $query->bindParam(':user_name', $user_name, PDO::PARAM_STR, 45);

            $query->execute();
            incremID();

          } catch(PDOException $error) {
              $message = $error->getMessage();
              echo $message;
              die;
            }
      }

}

if ($_GET['heart'] = "getID") {

    include_once ('connect.php');

    try {
        $query = $conn->prepare("SELECT * FROM getid");
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo $result['nextAvailableiD'];

      } catch(PDOException $error) {
          $message = $error->getMessage();
          echo $message;
          die;
      }

}


function incremID() {


  try {
    include ('connect.php');

    $query = $conn->prepare("UPDATE idNum SET nextAvailableiD = nextAvailableiD +1, time_modified = CURRENT_TIMESTAMP");
    $query->execute();

  } catch(PDOException $error) {

      $message = $error->getMessage();
      echo $message;
      die;
  }

}


function check_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

?>
