<?php include"includes/db.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PMS - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://kit.fontawesome.com/5ee06cd395.js" crossorigin="anonymous"></script>
    <?php include './css_js.php' ?>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PMS Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                


<?php 
    $query = "SELECT * FROM users";
    $send_query = mysqli_query($connection,$query);

    if(!$send_query) {
        die("Query Failed ". mysqli_error($connection));
    }

    $count_user = mysqli_num_rows($send_query);

    $query = "SELECT * FROM records";
    $send_query = mysqli_query($connection,$query);

    if(!$send_query) {
        die("Query Failed ". mysqli_error($connection));
    }

    $count_record = mysqli_num_rows($send_query);

?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">

                    <?php 
include 'includes/db.php';

use Dompdf\Dompdf; 

if(isset($_GET['generate_pdf'])) {
  $id = $_GET['generate_pdf'];

//     // Include autoloader 
    require_once 'dompdf/autoload.inc.php'; 
    
//     //  Reference the Dompdf namespace 
$dompdf = new Dompdf();
                



include('phpqrcode/qrlib.php');
$imageData = base64_encode(file_get_contents('./PMS.png'));

$src = 'data: ' . mime_content_type('./PMS.png') . ';base64,' . $imageData;

// Instantiate and use the dompdf class 
$query = "SELECT * FROM records WHERE id = $id ";
$select_query = mysqli_query($connection,$query);

$row = mysqli_fetch_array($select_query);
$serial_no = $row['serial_no'];
$property_no = $row['property_no'];
$location = $row['location'];
$date = $row['date'];
$cost = $row['cost'];
$prescription = $row['prescription'];

  $tempDir = "qrcodes/";
            // $extracted_data = $serial_no. "" .$property_no. "" .$location. "" .$date . "" .$cost. "" .$prescription;
            $extracted_data = '192.168.46.83/pms/view-record.php?view_properties='.$id;
            // $codeContents = "This Goes From Fissssle";

            // we need to generate filename somehow 
            // with md5 or with database ID used to obtains $codeContents...
            $fileName = "qrcode_files_".md5($extracted_data).".png";

            $pngAbsoluteFilePath = $tempDir.$fileName;
            $urlRelativeFilePath = $tempDir.$fileName;
            QRcode::png($extracted_data, $pngAbsoluteFilePath);
      
    // Load HTML content 
    $html = '
    <!doctype html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PMS-QRCODE</title>
        <style>

        .background-image {
          position: absolute;
          padding-top: 200px;
          padding-left: 135px;
          margin: 0 15%;
          width: 502px;
          height:295px;
        }

        .qrcode_img {
          position: absolute;
          padding-top: 220px;
          padding-left: 500px;
          width: 200px;
          height: 200px;
        }

        </style>
      </head>
      <body>
        <img class="background-image" src="PMS.png" width="200px">
        <img class="qrcode_img" src="'.$pngAbsoluteFilePath.'">
        <div>

        </div>
        
      </body>
    </html>

    ';


    $dompdf->loadHtml($html); 
    
    // (Optional) Setup the paper size and orientation 
    $dompdf->setPaper('A4', 'landscape'); 
    
    // Render the HTML as PDF 
    $dompdf->render(); 
    $dompdf->stream("", array("attachment" => false));
    
    // Output the generated PDF to Browser 
    $dompdf->stream();
}


?>


                    <!-- Content Row -->

                    <div class="row">

                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">

                

                        <div class="col-lg-6 mb-4">

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php include './includes/admin_footer.php' ?>




