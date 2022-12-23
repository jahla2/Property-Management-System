<?php include 'includes/header.php' ?>
<?php
  //RECIEVE GET REQUEST FROM URL
 if (isset($_GET['edit_properties'])) {
   //
   $id = $_GET['edit_properties'];
 }

 $query = "SELECT * FROM records WHERE id = $id ";
 $select_query = mysqli_query($connection,$query);

 while($row = mysqli_fetch_assoc($select_query)) {
   // Extract Data from database to display in web
   $id = $row['id'];
   $serial_no = $row['serial_no'];
   $property_no = $row['property_no'];
   $location = $row['location'];
   $date = $row['date'];
   $cost = $row['cost'];
   $prescription = $row['prescription'];

 }
 //Update Query
 if (isset($_POST['update'])) {
   //Variables for Storage
   $serial_no = $_POST['serial_no'];
   $property_no = $_POST['property_no'];
   $location = $_POST['location'];
   $date = $_POST['date'];
   $cost = $_POST['cost'];
   $prescription = $_POST['prescription'];

   //Filter String
   $serial_no = mysqli_real_escape_string($connection,$serial_no);
   $property_no = mysqli_real_escape_string($connection,$property_no);
   $location = mysqli_real_escape_string($connection,$location);
   $date = mysqli_real_escape_string($connection,$date);
   $cost = mysqli_real_escape_string($connection,$cost);
   $prescription = mysqli_real_escape_string($connection,$prescription);

   //Update query
   $query = "UPDATE records SET ";
   $query .= "serial_no = '{$serial_no}', ";
   $query .= "property_no = '{$property_no}', ";
   $query .= "location = '{$location}', ";
   $query .= "date = '{$date}', ";
   $query .= "cost = '{$cost}', ";
   $query .= "prescription = '{$prescription}' ";
   $query .= "WHERE id = {$id} ";

   $update_query = mysqli_query($connection,$query);
   if (!$update_query) {
     die("Query Error" . mysqli_error($connection));
   }

   echo "<h1><a href='admin.php'>View Records</a></h1>";
 }

 ?>

 <section class="container">
   <h1>Property Records</h1>

   <form action="" method="post" class="row needs-validation" novaidate>

     <div class="col-md-6">
       <label for="serialno" class="form-label">Serial No.</label>
       <input type="text" class="form-control" id="serialno" value='<?php echo $serial_no; ?>' name="serial_no" aria-describedby="emailHelp" required>
       <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
     </div>

     <div class="col-md-6">
       <label for="propertyno" class="form-label">Property No.</label>
       <input type="text" class="form-control" value='<?php echo $property_no; ?>' name="property_no" id="propertyno" required>
     </div>

     <div class="mb-3 col-6">
       <label for="exampleInputPassword1" class="form-label">Location</label>
       <input type="text" class="form-control" value='<?php echo $location; ?>' name="location" id="exampleInputPassword1" required>
     </div>

     <div class="mb-3 col-6">
       <label for="dateaquired" class="form-label">Date Acquired</label>
       <input type="date" class="form-control" value='<?php echo $date; ?>' name="date" id="dateaquired" required>
     </div>

     <div class="mb-3 col-6">
       <label for="Costid" class="form-label">Cost</label>
       <input type="number" class="form-control" value='<?php echo $cost; ?>' name="cost" id="Costid" placeholder="₱"required>
     </div>

     <div class="mb-3 col-6">
       <label for="prescriptionid" class="form-label">Prescription</label>
       <input type="text" class="form-control" value='<?php echo $prescription; ?>' name="prescription" id="prescriptionid">
     </div>

     <button type="submit"  name="update" class="btn btn-primary">Update</button>
   </form>
 </section>
