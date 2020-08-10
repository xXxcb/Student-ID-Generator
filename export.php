<?php
    session_cache_limiter('private');
    $cache_limiter = session_cache_limiter();

    /* set the cache expire to 30 minutes */
    session_cache_expire(1);
    $cache_expire = session_cache_expire();
    session_start();

    if(empty($_SESSION['username'])) {
        // $message = "Please log in before you can continue.";
        header("Location: index.php");
    }
?>
<?php include ('header.php'); ?>
<?php include ('nav.php'); ?>

<div class="container">
  <div class="row">
    <form class="" action="" method="">
      <input type="text" name="" value="">
    </form>
  </div>
</div>

<div class="container">
  <div class="row">
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
  </div>
</div>
