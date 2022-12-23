<?php

function Add_data() {
  global $connection;
  if(isset($_POST['submit'])){
    $serial_no = $_POST['serial_no'];
    $property_no = $_POST['property_no'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $cost = $_POST['cost'];
    $prescription = $_POST['prescription'];
  
    if(empty($serial_no) || empty($property_no) || empty($location) || empty($date) || empty($cost) || empty($prescription)) {
     
    }else {
        //CRUD- create or insert
    $query = "INSERT INTO records(serial_no,property_no,location,date,cost,prescription) ";
    $query .= "VALUES('$serial_no','$property_no','$location','$date','₱$cost','$prescription');";
  
    $result = mysqli_query($connection, $query);
  
    if (!$result) {
      die('Query failed' . mysqli_error($connection));
    }
    else {
      echo "<h2 class='container'>Record Created<a href='index.php'>View Record</a></h2>";
    }
    }
    
  
  }
}

 function create() {
   global $connection;

   if(isset($_POST['submit'])){

    //  $id = $POST['id'];
     $serial_no = $_POST['serial_no'];
     $property_no = $_POST['property_no'];
     $location = $_POST['location'];
     $date = $_POST['date'];
     $cost = $_POST['cost'];
     $prescription = $_POST['prescription'];

     //CRUD- create or insert
     $query = "INSERT INTO records(serial_no,property_no,location,date,cost,prescription) ";
     $query .= "VALUES('$serial_no','$property_no','$location','$date','$cost','$prescription')";

     $result = mysqli_query($connection, $query);

     if (!$result) {
       die('Query failed' . mysqli_error($connection));
     }
     else {
       echo "Record Created";
     }

   }

 }









 ?>
