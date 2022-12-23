<?php include "includes/admin_header.php" ?>

<?php 

if(isset($_SESSION['username'])) {

    $id = $_SESSION['id'];
    $username = $_SESSION['username'];

    $query ="SELECT * FROM users WHERE username = '{$username}' ";

    $send_query =  mysqli_query($connection,$query);

    while($row = mysqli_fetch_array($send_query)) {
      $username = $row['username'];
      $password =$row['passwords'];

    }
    if(isset($_POST['edit_user'])) {

      $username = $_POST['username'];
      $password = $_POST['password'];
   
      $query = "UPDATE users SET ";
      $query .="username = '{$username}', ";
      $query .="passwords = '{$password}' ";
      $query .="WHERE id = '{$id}' ";
  
   
      $send_update_query = mysqli_query($connection,$query);
   
      if(!$send_update_query)
      {
           die("Error". mysqli_error($connection));
      }
      else
      {
           echo "Success";
      }
      
    }

  }


 

?>

<?php

 

?>
<div class="container-fluid">
    <h1>Profile User Setting</h1>

       <form action="" method="POST">
            <div class="row">
                    <div class="col-xs-6 col-md-6">
                        <label for="user">Username</label>
                        <input type="text" class="form-control" id="user" name="username"  value="<?php echo $username; ?>">
                    </div>

                    <div class="col-xs-6 col-md-6">
                        <label for="pass">Password</label>
                        <input type="text" class="form-control" id="pass" name="password"  value="<?php echo $password; ?>">
                    </div>
                    <div class="pt-3 col-xs-6 col-mdx-6">
                        <button class="btn btn-primary" type="submit" name="edit_user">Submit</button>
                    </div>
            </div>
       </form>
    
    
</div>

<?php include "includes/admin_footer.php" ?>