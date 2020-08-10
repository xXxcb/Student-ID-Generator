
  <div class="d-flex justify-content-end fixed-top" style="padding: 20px;">
    <div class="btn-group" role="group">
      <button id="btnGroupDrop1" type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <?php echo "Hi " . $_SESSION['username'] . "!"; ?> </button>
      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        <a class="dropdown-item" href="export.php">Export Names</a>
        <a class="dropdown-item" href="log-out.php">Logout</a>
      </div>
  </div>
</div>
