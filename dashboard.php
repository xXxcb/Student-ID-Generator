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

    <div class="container-fluid">
      <div class="row justify-content-center align-items-center">
        <div class="col-5">
          <form action="" method="post" name="genId" id="genId">
            <div class="form-row">
              <div class="col">
                <input type="text" id="fname" name="fname" autocomplete="off" class="form-control" placeholder="Firstname">
                <small id="emailHelp" class="form-text text-muted">Enter Student's Firstname</small>
              </div>
              <div class="col">
                <input type="text" id="lname" autocomplete="off" name="lname" class="form-control" placeholder="Lastname">
                <small id="emailHelp" class="form-text text-muted">Enter Student's Lastname</small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <select class="custom-select" name="campus" id="campus">
                  <option selected>-- Campus --</option>
                  <option value="10">Main</option>
                  <option value="80">PCC</option>
                  <option value="70">Moneague</option>
                  <option value="20">Mandeville</option>
                  <option value="50">Masters</option>
                  <option value="40">St. Lucia</option>
                  <option value="60">Montego Bay</option>
                  <option value="55">Special</option>
                  <option value="15">Indiv. Course</option>
                  <option value="105">COS</option>
                  <option value="106">Miracle Tab</option>
                </select>
                <small id="campusHelp" class="form-text text-muted">Select Campus</small>
              </div>
              <div class="col-md-6">
                <select class="custom-select" name="acad_year" id="acad_year">
                  <option selected>Academic Year</option>
                  <option value="2020">20/2021</option>
                  <option value="2021">21/2022</option>
                  <option value="2022">22/2023</option>
                </select>
                <small id="yearHelp" class="form-text text-muted">Select Academic Year</small>
              </div>
              <div class="col-md-6">
                <select class="custom-select" name="prog" id="prog">
                  <option selected>Programme</option>
                  <option value="Bachelor of Social Work">BSW</option>
                  <option value="Bachelor of Arts in Guidance Counsel">BAG&C</option>
                  <option value="Bachelor of Arts Social Profesional Transformation">BASPT</option>
                  <option value="Bachelor of Arts in General Studies">BAGS</option>
                  <option value="Bachelor Music and Media">BAMM</option>
                  <option value="Bachelor of Art in Theology">BATH</option>
                  <option value="Bachelor of Arts in Biblical Studies">BABS</option>
                  <option value="Master of Arts in Forensic Psychology">MA. Forensic Psychology</option>
                  <option value="Master of Social Work">MSW</option>
                  <option value="Master of Arts in Public Theology">MA. Public Theology</option>
                  <option value="Master of Arts in Bible">MA. Bible</option>
                  <option value="Certificate in Leadership and Ministry">Cert. Leadership</option>
                  <option value="Certificate in Grief Management">Cert. Grief</option>
                  <option value="Associate Degree in Leadership and Ministry">Asc. Leadership</option>
                  <option value="Evangelical Training Association Certificate">Evangelical Training</option>
                </select>
                <small id="programmeHelp" class="form-text text-muted">Select Programme</small>
              </div>
            </div>
            <br/>
            <br/>
            <h4> Data output </h4>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Email:</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" name="staticEmail" id="staticEmail" value="@jts.edu.jm">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">ID #: </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="idNumber" id="idNumber" placeholder="Student's ID # will be generated here" readonly>
              </div>
            </div>
            <!-- <input type="hidden" name="form_data" value="1" /> -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <button class="btn btn-outline-info btn-block" type="submit" value="submit" name="submit">Save Student Data  </button>
          </form>
        </div>

      <div class="col" style="overflow-y: auto">
        <div style="height: 500px;">
          <table class="table table-striped" id="s_data">
              <thead>
                <tr>
                  <th scope="col">FirstName</th>
                  <th scope="col">LastName</th>
                  <th scope="col">ID #</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
                <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

                    try {
                      require_once('./engine/connect.php');
                      $sth = $conn->prepare("SELECT * FROM s_data ");
                      $sth->execute();
                      $result = $sth->fetchAll();

                    } catch (\Exception $e) {  }
                    if($sth->rowCount()):
                      foreach($result as $row) {
                ?>
                <tr>
                  <td><?php echo $row['firstname']; ?></td>
                  <td><?php echo $row['lastname']; ?></td>
                  <td><?php echo $row['student_id']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                </tr>
              <?php }  ?>
                 <?php endif; ?>
              </tbody>

            </table>
        </div>
      </div>
    </div>
  </div>
  <script>
  $(document).ready(function() {
      $('#s_data').DataTable();
  } );

    $(document).on('keyup', '#lname', function() {
        var lname = this.value;
        var fname = document.getElementById("fname").value+".";
        var domain = "@jts.edu.jm";
        $('#staticEmail').val(fname.concat(lname).toLowerCase().concat(domain));
    });

    // Get Campus value from selected
    $("#campus").bind('change keyup', '#campus', function() {
      var e = document.getElementById("campus");
      var strUser = e.options[e.selectedIndex].value;
    });


    $("#acad_year").bind('change keyup', '#acad_year', function() {
      var e = document.getElementById("acad_year");
      var year = e.options[e.selectedIndex].value;

      var c = document.getElementById("campus");
      var campus = c.options[c.selectedIndex].value;
      $('#idNumber').val(campus.concat(year));
      getOutput();
    });

    function addID(idFrDb) {
      var id = document.getElementById("idNumber").value;
      var compId = id.concat(00);
      $('#idNumber').val(compId.concat(typeof idFrDb));
    }

    function getOutput() {
      getRequest(
          './engine/heart.php', // URL for the PHP file
           drawOutput,  // handle successful request
           drawError    // handle error
      );
      return false;
    }
    // handles drawing an error message
    function drawError() {
      Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Could not load current ID from DB!'
            })
    }
    // handles the response, adds the html
    function drawOutput(responseText) {

        var id = document.getElementById("idNumber").value;
        $('#idNumber').val(id.concat(responseText));
    }
    // helper function for cross-browser request object
    function getRequest(url, success, error) {
        var req = false;
        try{
            // most browsers
            req = new XMLHttpRequest();
        } catch (e){  }

        if (!req) return false;
        if (typeof success != 'function') success = function () {};
        if (typeof error != 'function') error = function () {};
        req.onreadystatechange = function() {
            if(req.readyState == 4) {
                return req.status === 200 ?
                    success(req.responseText) : error(req.status);
            }
        }
        req.open("GET", url, true);
        req.send(null);
        return req;
    }

    $(document).ready(function($){
    // on submit...
        $("#genId").submit(function(e){

            e.preventDefault();
            var sendData = $(this).serialize();
            $.ajax({
                type:"POST",
                url: "./engine/heart.php",
                data: sendData,
                success: function() {
                      Swal.fire ({
                              icon: 'success',
                              title: 'Student Data Saved Successfully!',
                              showConfirmButton: false,
                              timer: 3000
                      })
                      setTimeout(function () {
                            location.reload();
                        }, 1000);


                      // $('#genId')[0].reset();

                },
                error: function() {
                      Swal.fire ({
                              icon: 'error',
                              title: 'Ooops!',
                              text: 'Student Data not saved Successfully!'
                      })
                }
            });
        });
    return false;
    });


  </script>
  </body>
</html>
