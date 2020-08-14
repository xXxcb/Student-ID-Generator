<?php



if (!empty($_POST['fname']) || !empty($_POST['lname'])) {

  $fname = check_input($_POST['fname']);
  $lname = check_input($_POST['lname']);
  $id    = check_input($_POST['idNumber']);
  $email = check_input($_POST['staticEmail']);
  $prog = check_input($_POST['prog']);
  $acad_year = check_input($_POST['acad_year']);
  $user_name = $_POST['username'];
  $campus = assignProg($_POST['campus']);

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  if(!isset($_SESSION)) { session_start(); }
if(empty($_SESSION['username'])) {


  $message = "You need to be logged in to complete this operation!";
  header("Location: index.php");
} else {

          try {

            include ('connect.php');

            $query = $conn->prepare('CALL InsertStudent(:id, :fname, :lname, :prog, :email, :acad_year, :campus, :user_name)');

            $query->bindParam(':fname', $fname, PDO::PARAM_STR, 45);
            $query->bindParam(':lname', $lname, PDO::PARAM_STR, 45);
            $query->bindParam(':id', $id, PDO::PARAM_STR, 45);
            $query->bindParam(':prog', $prog, PDO::PARAM_STR, 64);
            $query->bindParam(':email', $email, PDO::PARAM_STR, 64);
            $query->bindParam(':acad_year', $acad_year, PDO::PARAM_STR, 45);
            $query->bindParam(':campus', $campus, PDO::PARAM_STR, 45);
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

function assignProg($code) {
    switch ( $code ) {
      case 10:
        return "Main Campus";
        break;
      case 80:
          return "PCC";
          break;
      case 70:
          return "Moneague";
          break;
      case 20:
          return "Mandeville";
          break;
      case 50:
          return "Masters";
          break;
      case 40:
          return "St. Lucia";
          break;
      case 60:
          return "Montego Bay";
          break;
      case 55:
          return "Special";
          break;
      case 15:
          return "Indiv. Course";
          break;
      case 105:
          return "COS";
          break;
      case 106:
          return "Miracle Tab";
          break;
      default:
          return "No Campus Selected.";
    }
}

//Increments student number
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

//Checks field inputs
function check_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

?>
