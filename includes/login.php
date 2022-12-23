<?php include 'db.php'?>
<?php session_start() ?>
<?php 
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection,$username);
    $passwords = mysqli_real_escape_string($connection,$password);

    $query = "SELECT * FROM users WHERE username = '{$username}' AND passwords = '$passwords'";
    $send_query = mysqli_query($connection, $query);
// print_r($send_query);
    if(!$send_query) {
        die("QUERY FAILED." . mysqli_error($connection));
    }

    while($row = mysqli_fetch_assoc($send_query)){
        $id = $row['id'];
        $db_username = $row['username'];
        $db_passwords = $row['passwords'];
    }

//    echo $username.'------'.$db_username.'------'.$passwords.'------'.$db_passwords.'---';
    //Validate from databasw
    if($username == $db_username && "$passwords" == "$db_passwords"){
        // echo 'asd';
        // if() {
        $_SESSION['username'] = $db_username;
        $_SESSION['password'] = $db_passwords;
// echo 'asd';
        header("Location: ../admin.php");
        // }else {
            // echo 'aaaa';
            // header("Location: ../indexb.php");
        // }
    }else {
        header("Location: ../index.php");
    }
    // echo $password;

}

?>

