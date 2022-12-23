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
            $extracted_data = '192.168.254.132/pms/view-record.php?view_properties='.$id;
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