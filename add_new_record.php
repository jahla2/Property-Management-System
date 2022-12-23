<?php include './includes/admin_header.php' ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add New Record</h1>
                    </div> -->

                    <!-- Content Row -->
                    <div class="row">

                    </div>

                    <?php include "function.php" ?>
                    <?php

                    $serialErr = $propertyErr = $locatioErr = $dateErr = $costErr = $prescriptionErr = "";
                    $serial_no  = $property_no = $location = $date = $cost = $prescription = "";

                    $flag = true; 
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        if (empty($_POST["serial_no"])) {
                        $serialErr = "Serial No. is required";
                        $flag = false;
                        } else { 
                        $serial_no = test_input($_POST["serial_no"]);
                        }
                        if (empty($_POST["property_no"])) {
                        $propertyErr = "Property No. is required";
                        $flag = false;
                        } else { 
                        $property_no = test_input($_POST['property_no']);
                        }
                        if (empty($_POST["location"])) {
                        $locatioErr = "Location is required";
                        $flag = false;
                        } else { 
                        $location = test_input($_POST['location']);
                        }
                        if (empty($_POST["date"])) {
                        $dateErr= "Date is required";
                        $flag = false;
                        } else { 
                        $date = test_input($_POST['date']);
                        }
                        if (empty($_POST["cost"])) {
                        $costErr = "Cost is required";
                        $flag = false;
                        } else { 
                        $cost = test_input($_POST['cost']);
                        }
                        if (empty($_POST["prescription"])) {
                        $prescriptionErr = "Priscription is required";
                        $flag = false;
                        } else { 
                        $prescription = test_input($_POST['prescription']);
                        }
                        
                        //Filter Data String
                        $serial_no = mysqli_real_escape_string($connection,$serial_no);
                        $property_no = mysqli_real_escape_string($connection,$property_no);
                        $location = mysqli_real_escape_string($connection,$location);
                        $cost = mysqli_real_escape_string($connection,$cost);
                        $prescription = mysqli_real_escape_string($connection,$prescription);


                        //if the validation is success
                    if($flag) {
                        //Submit form when validated successfuly
                        $query = "INSERT INTO records(serial_no,property_no,location,date,cost,prescription) ";
                        $query .= "VALUES('$serial_no','$property_no','$location','$date','$cost','$prescription');";
                    
                        $result = mysqli_query($connection, $query);
                    
                        if (!$result) {
                        die('Query failed' . mysqli_error($connection));
                        }
                        else {
                        echo "<h2 class='container'>Record Created <a class='btn btn-success' href='admin.php'>View Record</a></h2>";
                        }
                    }

                    }

                    function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                    } 

                    ?>
                    <section class="container">
                        <!-- Add Record -->
                        <h1>Insert New Record</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="row needs-validation" >

                        <div class="col-md-6">
                            <label for="serialno" class="form-label">Serial No.</label>
                            <input type="text" class="form-control" id="serialno" value="<?= $serial_no; ?>" name="serial_no"  aria-describedby="emailHelp">
                            <small class="text-danger"><?= $serialErr; ?></small>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>

                        <div class="col-md-6">
                            <label for="propertyno" class="form-label">Property No.</label>
                            <input type="text" class="form-control" name="property_no" id="propertyno" value="<?= $property_no; ?>">
                            <small class="text-danger"><?= $propertyErr; ?></small>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="exampleInputPassword1" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="exampleInputPassword1" value="<?= $location ?>">
                            <small class="text-danger"><?php echo $locatioErr; ?></small>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="dateaquired" class="form-label">Date Acquired</label>
                            <input type="date" class="form-control" name="date" id="dateaquired" value="<?= $date ?>">
                            <small class="text-danger"><?php echo $dateErr; ?></small>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="Costid" class="form-label">Cost</label>
                            <input type="number" class="form-control" name="cost" id="Costid" placeholder="₱" value="<?= $cost?>">
                            <small class="text-danger"><?php echo $costErr; ?></small>
                        </div>

                        <div class="mb-3 col-6">
                            <label for="prescriptionid" class="form-label">Prescription</label>
                            <input type="text" class="form-control" name="prescription" id="prescriptionid" value="<?= $prescription?>">
                            <small class="text-danger"><?php echo $prescriptionErr; ?></small>
                        </div>

                        <div class="col-12">
                        <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
                        </div>

                       
                        </form>

                    </section>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include './includes/admin_footer.php' ?>