<?php

if (isset($_POST['username'])) { echo $_POST['username']; }

        $fname = check_input($_POST['fname']);
        $lname = check_input($_POST['lname']);
        $id    = check_input($_POST['idNumber']);
        $email = check_input($_POST['staticEmail']);
        $user_name = $_POST['username'];
        $datee = date("yy-m-d");


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
              }

              $conn->close();

?>
