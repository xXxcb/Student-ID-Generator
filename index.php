<?php
session_start();
if (!empty($_SESSION['username'])) {
    header("Location: dashboard.php");
}
?>
<?php include ('header.php'); ?>

    <?php include ('login.php'); ?>
    <form class="form-signin" method="post">
      <?php
            if ($error_message != "") {
                echo '<div class="alert alert-danger"><strong>Error: </strong> ' . $error_message . '</div>';
            }
            if ($message != "") {
                echo '<div class="alert alert-warning"><strong>Warning: </strong> ' . $message . '</div>';
            }
            if ($success_message != "") {
                echo '<div class="alert alert-success"><strong>Message: </strong> ' . $success_message . '</div>';
            }

      ?>
      <div class="text-center mb-4">
        <img class="mb-4" src="./assets/logo.png" alt="" width="72" height="90">
        <h1 class="h3 mb-3 font-weight-normal">Student ID Generator</h1>
      </div>

      <div class="form-label-group">
        <input type="text" id="username" name="username" autocomplete="off" class="form-control" placeholder="Username" required autofocus>
        <label for="username">Username</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-outline-info btn-block" name="login" type="login">Sign in</button>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2020</p>
    </form>
  </body>
</html>
