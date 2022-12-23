<?php 
include 'includes/db.php';
$query = "SELECT * FROM records";
$send_query = mysqli_query($connection,$query);
while($row = mysqli_fetch_assoc($send_query)){
    $id = $row['id'];
    $serial_no = $row['serial_no'];
    $property_no = $row['property_no'];
    $location = $row['location'];
    $date = $row['date'];
    $cost = $row['cost'];
    $prescription = $row['prescription'];
    echo"<tr>";
    echo "<td>$serial_no</td>";
    echo "<td>$property_no</td>";
    echo "<td>$location</td>";
    echo "<td>$date</td>";
    echo "<td>$cost</td>";
    echo "<td>$prescription</td>";
}


 
?>