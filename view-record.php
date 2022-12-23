<?php include"includes/db.php"; ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="pms-logo.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <style media="screen">
      /* .dataTables_wrapper .dataTables_filter input {
        margin: 20px;
        padding: 2% 5%;
      } */
      .box{ height: 200px; }
      .nav-title {
        text-align: center;
      }
      .navg {
        margin: 0 auto;
        font-size: 20px;
        text-decoration: none;
      }
    </style>
    <title>Property Managent System</title>
  </head>
  <body>

    <!-- <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid"> -->
        <!-- <div class=""> -->
        <!-- <a class="navg align-items-center justify-content-center" href="#">PMS</a>
        <div class="collapse navbar-collapse" id="navbarNav">
        </div>
      </div>
    </nav> -->

<?php
  //RECIEVE GET REQUEST FROM URL
 if (isset($_GET['view_properties'])) {
   //
   $id = $_GET['view_properties'];
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


 ?>

 <section class="container pt-3">
    <img src="pms-banner.png" class="img-fluid" alt="...">
   <h6>RECORD NO:<?php echo $id;?></h6>

   <form action="" method="post" class="row needs-validation" novaidate>

     <div class="col-md-6">
       <label for="serialno" class="form-label">Serial No.</label>
       <input type="text" class="form-control" id="serialno" value='<?php echo $serial_no; ?>' name="serial_no" aria-describedby="emailHelp" disabled>
       <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
     </div>

     <div class="col-md-6">
       <label for="propertyno" class="form-label">Property No.</label>
       <input type="text" class="form-control" value='<?php echo $property_no; ?>' name="property_no" id="propertyno" disabled>
     </div>

     <div class="mb-3 col-6">
       <label for="exampleInputPassword1" class="form-label">Location</label>
       <input type="text" class="form-control" value='<?php echo $location; ?>' name="location" id="exampleInputPassword1" disabled>
     </div>

     <div class="mb-3 col-6">
       <label for="dateaquired" class="form-label">Date Acquired</label>
       <input type="date" class="form-control" value='<?php echo $date; ?>' name="date" id="dateaquired" disabled>
     </div>

      <div class="col-6">
          <label for="Costid" class="form-label">Cost</label>
          <div class="mb-3 col-12 input-group">
            <span class="input-group-text">₱</span>
            <input type="text" class="form-control" value='<?php echo number_format($cost); ?>' name="cost" id="Costid" placeholder="₱" disabled>
          </div>
      </div>

      <div class="col-6">
          <label for="prescriptionid" class="form-label">Prescription</label>
          <div class="mb-3 col-12">
            <input type="text" class="form-control" value='<?php echo $prescription; ?>' name="prescription" id="prescriptionid" disabled>
          </div>
      </div>

   </form>
 </section>
