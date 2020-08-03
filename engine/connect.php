<?php


    $server = "localhost";
    $user = "xander";
    $passwd = "xander";

        try {
            $conn = new PDO("mysql:host=$server;dbname=student_gen", $user, $passwd);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connected";
          } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }

?>
