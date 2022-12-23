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
  <body>
        <div class="container">
            <div class="main-login">
                <form action="includes/login.php" method="post">
                    <div class="card justify-content-center rounded-0">
                    <div class="card-header rounded-0 bg-primary text-white">
                        <div class="row">
                            <img class="col-2 w-25" src="logo.png" alt="">
                            <h1 class="pt-2 text-left card-title col-9">PMS Login</h1>
                        </div>
                    </div>
                    <div class="card-body">
                            <input class="input-group-text form-control mt-4 col-12 rounded-0" type="text" name="username" id="Login" placeholder="Username">
                            <input class="input-group-text form-control mt-4 col-12 rounded-0" type="password" name="password" id="Login" placeholder="Password">
                            <div class="text-center">
                            <button class="btn btn-primary mt-4" type="submit" name="login">Login</button>
                            </div class="pb-5">
                    </div>
                </form>
            </div>
        </div>  
        </div>
        </div>

    <script>
        $(document).ready(function(){
            $('');

        });
    </script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
