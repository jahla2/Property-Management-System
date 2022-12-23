<?php include "includes/db.php"; ?>
<?php session_start() ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="pms-logo.png" type="image/png">
    <title>Property Management System</title>
    <style>
        .card {
            width: 350px;
            /* margin: 0 30%; */
            margin: 0 auto;
        }
        .main-login {
            margin-top: 100px;
        }
        .card-title {
            padding-bottom: 0;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>

  <?php

$userErr = $passErr = "";
$username = $password = "";

$flag = true;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (empty($_POST["username"])) {
    $userErr = "Username is required";
    $flag = false;
    } else {
    $username = test_input($_POST["username"]);
    }
    if (empty($_POST["password"])) {
    $passErr = "Password is required";
    $flag = false;
    } else {
    $password = test_input($_POST['password']);
    }
    //if the validation is success
if($flag) {
        if(isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $username = mysqli_real_escape_string($connection,$username);
            $passwords = mysqli_real_escape_string($connection,$password);

            $query = "SELECT * FROM users WHERE username = '{$username}' AND passwords = '$passwords'";
            $send_query = mysqli_query($connection, $query);

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
                if(!empty($_POST['remember'])){
                    //Create cookies
                    setcookie ("username",$username,time()+ (10 * 365 * 24 * 60 * 60));
                    setcookie ("password",$password,time()+ (10 * 365 * 24 * 60 * 60));
                }
                else
                {
                //Destroy cokiee
                if(isset($_COOKIE["username"]))
                {
                setcookie ("username","");
                }
                if(isset($_COOKIE["password"]))
                {
                setcookie ("password","");
                }
                }
                //Start Session When triggired
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $db_username;
                $_SESSION['password'] = $db_passwords;
                header("Location: admin.php");
            }else {
                header("Location: index.php");
            }

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

  <body>
        <div class="container">
            <div class="main-login">
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
                    <div class="card justify-content-center rounded-0">
                    <div class="card-header rounded-0 bg-primary text-white">
                        <div class="row">
                            <img class="col-2 w-25" src="logo.png" alt="">
                            <h1 class="pt-2 text-left card-title col-9">PMS Login</h1>
                        </div>
                    </div>
                    <div class="card-body">
                            <input class="input-group-text form-control mt-4 col-12 rounded-0" type="text" name="username" id="Login" placeholder="Username" value="<?php if(isset($_COOKIE['username'])) { echo $_COOKIE['username'];} else {
                                echo $username;
                            }?>">

                            <!-- value="<//?= $username; ?>" -->
                            <center><strong class="text-danger"><?= $userErr; ?></strong></center>
                            <input class="input-group-text form-control mt-4 col-12 rounded-0" type="password" name="password" id="Login" placeholder="Password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password'];} else {
                                echo $password;
                            }?>">
                            <!-- value="<//?= $password;?>" -->
                            <center><strong class="text-danger"><?= $passErr; ?></strong></center>
                            <small></small>
                            <div class="text-center">
                                <center>
                                <div class="form-group mt-3">
                                    <input type="checkbox" name="remember" id="rememb" <?php if(isset($_COOKIE["username"])) { ?> checked <?php } ?>/>
                                    <label for="rememb">Remember-me</label>
                                </div>
                                </center>
                            <button class="btn btn-primary mt-4" type="submit" name="login">Login</button>
                            </div class="pb-5">
                            <div>

                            </div>
                    </div>

                </form>
            </div>
        </div>
        </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
