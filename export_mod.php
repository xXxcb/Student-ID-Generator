<?php

    if(!isset($_SESSION)) {
      session_cache_limiter('private');
      $cache_limiter = session_cache_limiter();

      /* set the cache expire to 30 minutes */
      session_cache_expire(1);
      $cache_expire = session_cache_expire();
      session_start();
    }

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

  <div class="row justify-content-center align-items-center" id="here" style="overflow-y: auto; height: 650px;">

  <?php
  require_once('./engine/connect.php');
    $query = "SELECT * FROM s_data";
    $query_run = mysqli_query($conn, $query);
    if($query_run){

    $out = '
        <table class="table table-responsive">
            <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Programme</th>
                <th scope="col">Email</th>
                <th scope="col">Academic Year</th>
                <th scope="col">Campus</th>
                <th scope="col">Select</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
    ';

        while($row = mysqli_fetch_assoc($query_run)){
            $out .= '<tr class="trID_' .$row['id']. '">';
            $out .= '<td class="td_name">' . $row['name'] . '</td>';
            $out .= '<td class="td_rollno">' . $row['rollno'] . '</td>';
            $out .= '<td class="td_contact">' . $row['contact'] . '</td>';
            $out .= '<td class="td_address">' . $row['address'] . '</td>';
            $out .= "<td><button class='td_btn btn btn-link btn-custom dis'>EDIT</button> </td>";
            $out .= '</tr>';
        }
        $out .= '</tbody></table>'
        echo $out;
?>

<script>
    $(document).ready(){
        $('.td_btn').click(function(){
            var $row = $(this).closest('tr');
            var rowID = $row.attr('class').split('_')[1];
            var name =  $row.find('.td_name').val();
            var rollno =  $row.find('.td_rollno').val();
            var contact =  $row.find('.td_contact').val();
            var address =  $row.find('.td_address').val();
            $('#frm_id').val(rowID);
            $('#frm_name').text(name);
            $('#frm_rollno').text(rollno);
            $('#frm_contact').text(contact);
            $('#frm_address').text(address);
            $('#myModal').modal('show');
        });
    });//END document.ready
</script>

       <div class="modal fade" id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                       <h4 class="modal-title" id="myModalLabel">EDIT RECORD</h4>
                   </div>
                   <div class="modal-body">

                       <form id="updateValues" action="update.php" method="POST" class="form">
                           <div class="form-group">
                               <label for="name">NAME</label>
                               <input type="text" class="form-control" name="name" id="frm_name">
                           </div>
                           <div class="form-group">
                               <label for="rollno">ROLL NO</label>
                               <input type="text" class="form-control" name="rollno" id="frm_rollno">
                           </div>
                           <div class="form-group">
                               <label for="contact">CONTACT</label>
                               <input type="text" class="form-control" name="contact" id="frm_contact">
                           </div>
                           <div class="form-group">
                               <label for="address">ADDRESS</label>
                               <textarea class="form-control" rows="3" name="address" id="frm_address"></textarea>
                           </div>
                           <input type="hidden" name="frm_id">
                           <input type="submit" class="btn btn-primary btn-custom" value="Save changes">
                       </form>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                       <div id="results"></div>
                   </div>

               </div>
           </div>
       </div>
<?php
        }
    }
?>

    <script>



    //Datatables
    $(document).ready(function() {
        $('#s_data').DataTable({
              "bLengthChange": false
            });
    } );

    //Shift select checkBoxes
    $(document).ready(function() {
    var $chkboxes = $('.sel');
    var lastChecked = null;

    $chkboxes.click(function(e) {
        if (!lastChecked) {
            lastChecked = this;
            return;
        }

        if (e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);

            $chkboxes.slice(Math.min(start,end), Math.max(start,end)+ 1).prop('checked', lastChecked.checked);
        }

        lastChecked = this;
    });
});

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
                                var campus = row.cells[6].innerHTML;

                                cont.id = id;
                                cont.firstname = firstname;
                                cont.lastname = lastname;
                                cont.programme = programme;
                                cont.email = email;
                                cont.campus = campus;

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
                                  headers: ['Student ID', 'FirstName', 'LastName', 'Programme', 'Email', 'Campus'],
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
