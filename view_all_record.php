<?php include './includes/admin_header.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">View All Record</h1>
                    </div>

                    <!-- Content Row -->


<?php
//Check if the user is registerd or not
if(empty($_SESSION['username'])){
  header("Location: index.php");
}
 ?>
<?php 

//BulK Options
if(isset($_POST['checkBoxArray'])) {

  foreach ($_POST['checkBoxArray'] as $postValueId ) {

  $bulk_options = $_POST['bulk_options'];

  switch ($bulk_options) {

    case 'delete':
      $query = "DELETE FROM records WHERE id='{$postValueId}' ";
      $update_to_delete_status = mysqli_query($connection, $query);
      if(!$connection) {
        die("Query Failed". mysqli_error($connection));
      }else {
        // echo 'Query Success!';
            }
      break;

    case 'clone':
      $query = "SELECT * FROM records WHERE id='{$postValueId}' ";
      $clone_query = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($clone_query)) {
          $serial_no = $row['serial_no'];
          $property_no = $row['property_no'];
          $location = $row['location'];
          $date = $row['date'];
          $cost = $row['cost'];
          $prescription = $row['prescription'];

        }
        //QUERY TO INSERT
        $query = "INSERT INTO records(serial_no, property_no, location,
           date, cost, prescription) ";

        $query .= "VALUES('{$serial_no}','{$property_no}','{$location}',now(),'{$cost}','{$prescription}') ";
        $send_to_database = mysqli_query($connection,$query);
        if(!$send_to_database) {
          die("QUERY FAILED. " . mysqli_error($connection));
        }

      break;

    default:
      // code...
      break;
  }

  }

}
?>
        <!-- CONTENT -->
                        
                        <form action="" method="POST">
                            <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Records</h6>

                                        <div class="row">
                                            <div id="bulkOptionContainer" style="padding: 0px;" class="col-xs-6 col-md-4">
                                                <select class="form-control" name="bulk_options">
                                                    <option value="">Select Option</option>
                                                    <option value="delete">Delete</option>
                                                </select>
                                            </div>

                                            <div class="col-xs-6 col-md-4">
                                                <input class="btn btn-success" type="submit" name="submit" value="Apply">
                                                <a class="btn btn-primary" href="add_new_record.php">Add New</a>
                                            </div>
                                        </div>

                                    </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table" class="table display table-bordered" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col"><input id="selectAllBoxes" type="checkbox"></th>
                                                    <th scope="col">#id</th>
                                                    <th scope="col">Serial No.</th>
                                                    <th scope="col">Property No.</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Date Acquired</th>
                                                    <th scope="col">Cost</th>
                                                    <th scope="col">Pescrption</th>
                                                    <th scope="col">Edit</th>
                                                    <th scope="col">Delete</th>
                                                    <!-- <th scope="col">Generate QRCode</th> -->
                                                    <th scope="col">QRcode</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM records ORDER BY id DESC";
                                                $select_record = mysqli_query($connection,$query);
                                                while($row = mysqli_fetch_assoc($select_record)) {
                                                    $id = $row['id'];
                                                    $serial_no = $row['serial_no'];
                                                    $property_no = $row['property_no'];
                                                    $location = $row['location'];
                                                    $date = $row['date'];
                                                    $cost = $row['cost'];
                                                    $prescription = $row['prescription'];
                                                    echo "<tr>";
                                                    ?>
                                                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $id;  ?>'></td>
                                                    <?php
                                                    echo "<th scope='row'>$id</th>";
                                                    echo "<td>$serial_no</td>";
                                                    echo "<td>$property_no</td>";
                                                    echo "<td>$location</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>₱".number_format($cost)."</td>";
                                                    echo "<td>$prescription</td>";
                                                    echo "<td><a class='btn btn-info' href='edit_record.php?edit_properties={$id}'>Edit</a></td>";
                                                    // echo "<td><a class='btn btn-info' href='view-record.php?view_properties={$id}'>View</a></td>";
                                                    ?>
                                                    <td><a class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#exampleModal'>Delete</a></td>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                            Are you sure do you want to Delete?
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <a id="confirm" href="delete.php?delete_properties=<?php echo $id ?>" class="btn btn-primary">Confirm</a>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    // echo "<td><a class='btn btn-primary' href='generate_code.php?generate_code={$id}'>Generate</a></td>";
                                                    echo "<td><a class='btn btn-success' href='index-pdf.php?generate_pdf={$id}' target='_blank'>PDF</a></td>";
                                                    echo "</tr>";
                                                    //onClick=\" javascript: return confirm('Are you sure do you want to delete?'); \"
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>   
                                </div>         
                            </div>
                            
                        </form>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

<?php include './includes/admin_footer.php' ?>