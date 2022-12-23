<?php include 'includes/db.php'; ?>
<?php
if (isset($_GET['delete_properties'])) {
  $id = $_GET['delete_properties'];

  $query = "DELETE FROM records WHERE id =". mysqli_real_escape_string($connection, $_GET['delete_properties']) ." ";
  $delete_query = mysqli_query($connection, $query);

  header("Location: view_all_record.php");

  if (!$delete_query) {
    die("Query Error" . mysqli_error($connection));
  }
}



 ?>
