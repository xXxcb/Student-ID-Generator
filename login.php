<?php
include ('./engine/connect.php');


if (isset($_POST["login"])) {
    $username = checker_input($_POST['username']);
    $password = md5(checker_input($_POST['password']));


    if(!empty($_POST['username']) && !empty($_POST['password'])) {

      try {

          $query = $conn->prepare("SELECT * FROM admin_users WHERE (user_name=:username OR email=:username) AND password=:password");
          $query->bindParam("username", $username, PDO::PARAM_STR);
          $query->bindParam("password", $password, PDO::PARAM_STR);
          $query->execute();

          $result = $query->fetch(PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


          if ($result) {
              session_start();
              $success_message = "Logging in...";
              $_SESSION['username'] = $result['user_name'];
              header("Location: dashboard.php");
          } else {
            $error_message = "Ooops! Wrong combination!";
        }

      } catch(PDOException $error) {
          $message = $error->getMessage();
          $error_message = $message;
          //echo $message;
        }
    }
}

function checker_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
}

?>
