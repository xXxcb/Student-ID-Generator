<?php



if (!empty($_POST['username'])) {

  echo $_POST['username'];

  $fname = check_input($_POST['fname']);
  $lname = check_input($_POST['lname']);
  $id    = check_input($_POST['idNumber']);
  $email = check_input($_POST['staticEmail']);
  $user_name = $_POST['username'];
  $datee = date("yy-m-d");

  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);


      try {

        include ('connect.php');

        $query = $conn->prepare("INSERT INTO s_data (student_id, firstname, lastname, email, created_by, date_created) VALUES (:id, :fname, :lname, :email, :user_name, :datee)");

        $query->bindParam(':fname', $fname);
        $query->bindParam(':lname', $lname);
        $query->bindParam(':id', $id);
        $query->bindParam(':email', $email);
        $query->bindParam(':user_name', $user_name);
        $query->bindParam(':datee', $datee);

        $query->execute();


      } catch(PDOException $error) {
          $message = $error->getMessage();
          echo $message;
          die;
        }

}


if ($_GET['heart'] = "getID") {

    include_once ('connect.php');

    try {

        // $query = $conn->prepare("SELECT 'LPAD(nextAvailableiD, 4, 0)' FROM idNum");
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


// function incremID() {
//   include_once ('connect.php');
//
//   try {
//     // $conn->begingTransaction();
//
//     $query = $conn->prepare("UPDATE idNum SET nextAvailableiD = nextAvailableiD +1, time_modified = CURRENT_TIMESTAMP");
//     $query->execute();
//
//     // $result = $query->fetch(PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//     // $conn->rollback();
//   } catch(PDOException $error) {
//       $message = $error->getMessage();
//       echo $message;
//         die;
//   }
//
// }

function check_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

?>
