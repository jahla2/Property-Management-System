<?php include 'includes/db.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate QR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style media="screen">
      .qr-image {
        width: 200px;
      }
    </style>
    <style media="print">
    * {
      background: #482ff7 !important;
    }
    </style>
  </head>
  <body>


<?php


      if(isset($_GET['generate_code'])) {

            $id = $_GET['generate_code'];
            //PULL DATA FROM DATABASE
            $query = "SELECT * FROM records WHERE id = $id ";
            $select_query = mysqli_query($connection,$query);

            while($row = mysqli_fetch_array($select_query)) {
              // Extract Data from database to display in web
              // $id = $row['id'];
              $serial_no = $row['serial_no'];
              $property_no = $row['property_no'];
              $location = $row['location'];
              $date = $row['date'];
              $cost = $row['cost'];
              $prescription = $row['prescription'];

              include('phpqrcode/qrlib.php');
                //include('config.php');

                // how to save PNG codes to server

                $tempDir = "qrcodes/";
                $extracted_data = $serial_no. "" .$property_no. "" .$location. "" .$date . "" .$cost. "" .$prescription;
                // $codeContents = 'This Goes From Fissssle';

                // we need to generate filename somehow,
                // with md5 or with database ID used to obtains $codeContents...
                $fileName = 'qrcode_file_'.md5($extracted_data).'.png';

                $pngAbsoluteFilePath = $tempDir.$fileName;
                $urlRelativeFilePath = $tempDir.$fileName;
                
                // // generating
                // if (!file_exists($pngAbsoluteFilePath)) {
                    // QRcode::png($extracted_data, $pngAbsoluteFilePath);
                //     echo 'File generated!';
                //     echo '<hr />';
                // } else {
                //     echo 'File already generated! We can use this cached file to speed up site on common codes!';
                //     echo '<hr />';
                // }
                

                // echo 'Server PNG File: '.$pngAbsoluteFilePath;
                // echo '<hr />';

                // displaying

            }

             echo "User Id: " . $id = $_GET['generate_code'];

                ?>

                <section class='text-center' id='img-qr'>
                <div id="a"><img class="qr-image" src="<?php echo $urlRelativeFilePath; ?>" /></div>
                </section>
<?php
          }          
 ?>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
