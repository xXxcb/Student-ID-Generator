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

  <div class="row">
      <div class="" style="padding: 20px;">
        <button class="btn btn-outline-warning" onclick="myFunction();"> Export </button>
      </div>
  </div>

  <br/>

  <div class="row" id="here" style="overflow-y: auto; height: 600px;">
    <table class="table table-hover" id="s_data">
        <thead class="thead-light">
          <tr>
            <th scope="col">Student ID</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Programme</th>
            <th scope="col">Email</th>
            <th scope="col">Academic Year</th>
            <th scope="col">Select<th/>
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
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['programme']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['acad_year']; ?></td>
            <td><input id="sel" type="checkbox"/></td>
          </tr>
        <?php }  ?>
           <?php endif; ?>
        </tbody>
      </table>
    <script>
    // $(document).ready(function() {
    //     $('#s_data').DataTable();
    // } );


    //Reference the Table.
    var grid = document.getElementById("s_data");

    //Reference the CheckBoxes in Table.
    var checkBoxes = grid.getElementsByTagName("INPUT");


        function myFunction() {

              if (checkBox()) {


                        datah = [];

                        //Loop through the CheckBoxes.
                        for (var i = 0; i < checkBoxes.length; i++) {
                            if (checkBoxes[i].checked) {
                                var row = checkBoxes[i].parentNode.parentNode;

                                var cont = {};

                                var id = row.cells[0].innerHTML;
                                var firstname = row.cells[1].innerHTML;
                                var lastname = row.cells[2].innerHTML;
                                var programme = row.cells[3].innerHTML;
                                var email = row.cells[4].innerHTML;

                                cont.id = id;
                                cont.firstname = firstname;
                                cont.lastname = lastname;
                                cont.programme = programme;
                                cont.email = email;

                                datah.push(cont);
                            }

                        }

                        //Sweet Alert
                        let timerInterval
                          Swal.fire({
                            title: 'Converting to CSV',
                            html: 'Please wait while data downloads.',
                            timer: 2500,
                            timerProgressBar: true,
                            onBeforeOpen: () => {
                              Swal.showLoading()
                              timerInterval = setInterval(() => {
                                const content = Swal.getContent()
                                if (content) {
                                  const b = content.querySelector('b')
                                  if (b) {
                                    b.textContent = Swal.getTimerLeft()
                                  }
                                }
                              }, 100)
                            },
                            onClose: () => {
                              clearInterval(timerInterval)

                              //Convert and download csv
                              objectExporter({
                                  exportable: datah,
                                  type: 'csv',
                                  headers: ['Student ID', 'FirstName', 'LastName', 'Programme', 'Email'],
                                  fileName: moment().format('MMMM Do YYYY, h:mm:ss a')
                                })

                              //Clear CheckBoxes
                              location.reload();

                            }
                          }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                              console.log('I was closed by the timer');
                            }
                          })

              } else {
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'You need to select something first!',
                  footer: '<a href>Not sure what to do?</a>'
                })

              }
          }

        function checkBox() {
              for (var i = 0; i < checkBoxes.length; i++) {
                      if (checkBoxes[i].checked) {
                        return true;
                      }
                }
            }
  </script>
  </div>
</div>
