<?php
session_start();
if(empty($_SESSION['username'])) {
    // $message = "Please log in before you can continue.";
    header("Location: index.php");
}
?>
<?php include ('header.php'); ?>
<?php //include ('nav.php'); ?>

    <?php //echo "Welcome " . $_SESSION['username']; ?>

    <div class="container">
      <div class="row">
        <div class="col">
          <form>
            <div class="form-row">
              <div class="col">
                <input type="text" id="fname" class="form-control" placeholder="Firstname">
                <small id="emailHelp" class="form-text text-muted">Enter Student's Firstname</small>
              </div>
              <div class="col">
                <input type="text" id="lname" class="form-control" placeholder="Lastname">
                <small id="emailHelp" class="form-text text-muted">Enter Student's Lastname</small>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <select class="custom-select" id="campus">
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
              </div>
              <div class="col-md-6">
                <select class="custom-select" id="acad_year">
                  <option selected>Academic Year</option>
                  <option value="2020">20/2021</option>
                  <option value="2021">21/2022</option>
                  <option value="2022">22/2023</option>
                </select>
              </div>
            </div>
            <br/>
            <br/>
            <h4> Data output </h4>
            <div class="form-group row">
              <label for="staticEmail" class="col-sm-2 col-form-label">Email:</label>
              <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="@jts.edu.jm">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">ID #: </label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="idNumber" placeholder="Student's ID # will be generated here" readonly>
              </div>
            </div> <div id="result"> </div>
            <button class="btn btn-outline-info btn-block" name="submit">Save Student Data  </button>
          </form>
        </div>

      <div class="col">
        2 of 2
      </div>
    </div>
  </div>
  <script>

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
      //addID();
    });

    function addID(idFrDb) {

      var id = document.getElementById("idNumber").value;
      var compId = id.concat(00);
      $('#idNumber').val(compId.concat(typeof idFrDb));
      //console.log(compId);
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
        alert('Bummer: there was an error!');
    }
    // handles the response, adds the html
    function drawOutput(responseText) {
        // var container = document.getElementById('result');
        // container.innerHTML = responseText;

        var id = document.getElementById("idNumber").value;
        // var compId = id.concat("00");
        $('#idNumber').val(id.concat(responseText));
         //addID(responseText);
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

  </script>
  </body>
</html>
