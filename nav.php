
  <div class="d-flex justify-content-end fixed-top" style="padding: 20px;">
    <div class="btn-group" role="group">

      <button id="btnGroupDrop1" type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <?php echo "Hi " . $_SESSION['username'] . "!"; ?> </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

          <?php
              $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
                if (strpos($url,'export') !== false) {
                    echo '<a class="dropdown-item" href="dashboard.php">Dashboard</a>';
                }
                if (strpos($url,'dash') !== false) {
                    echo '<a class="dropdown-item" href="export.php">Export Names</a>';
                }
          ?>
        <a class="dropdown-item" href="log-out.php">Logout</a>
      </div>
  </div>
</div>
