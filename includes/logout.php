<?php session_start(); ?>
<?php
//Deleting the user session asigning to null
$_SESSION['username'] = null;
$_SESSION['password'] = null;

header("Location: ../index.php");

?>