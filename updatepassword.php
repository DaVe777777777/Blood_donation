
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS link -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
   <title>Update Password</title>
   <style>
        html, body {
            height: 100%;
        }
        
        body {
            display: flex;
            align-items: center;
        }
        
    
    </style>
</head>
<body>

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-6" style="background-color: #E2F7E6">
         <?php
         include 'connection.php';

         if (isset($_GET['email']) && isset($_GET['reset_token'])) {
            date_default_timezone_set('Asia/Manila');
            $date = date("Y-m-d");
            $query = "SELECT * FROM users WHERE `email` = ? AND `resettoken` = ? AND `resettokenexpire` = ?";

            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sss", $_GET['email'], $_GET['reset_token'], $date);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) == 1) {
               echo "
                  <form method='POST'>
                     <h3>Create New Password</h3>
                     <div class='mb-3'>
                        <input type='password' class='form-control' placeholder='New Password' name='password'>
                     </div>
                     <div class='mb-3'>
                        <input type='password' class='form-control' placeholder='Confirm Password' name='confirm_password'>
                     </div>
                     <button type='submit' class='btn btn-primary' name='updatepassword'>Update</button>
                     <input type='hidden' name='email' value='" . $_GET['email'] . "'>
                  </form>
               ";
            } else {
               echo "
                  <script>
                     alert('Invalid or expired Link');
                     window.location.href='login.php';
                  </script>
               ";
            }
         }

         if (isset($_POST['updatepassword'])) {
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($password === $confirmPassword) {
               $pass = password_hash($password, PASSWORD_BCRYPT);
               $update = "UPDATE users SET `password` = ?, `resettoken` = NULL, `resettokenexpire` = NULL WHERE `email` = ?";

               $stmt = mysqli_prepare($conn, $update);
               mysqli_stmt_bind_param($stmt, "ss", $pass, $_POST['email']);

               if (mysqli_stmt_execute($stmt)) {
                  echo "
                     <script>
                        alert('Password Updated Successfully!');
                        window.location.href='login.php';
                     </script>
                  ";
               } else {
                  echo "
                     <script>
                        alert('Server Down!');
                        window.location.href='login.php';
                     </script>
                  ";
               }
            } else {
               echo "
                  <script>
                     alert('Password and Confirm Password do not match.');
                     window.location.href='updatepassword.php?email=" . $_POST['email'] . "&reset_token=" . $_GET['reset_token'] . "';
                  </script>
               ";
            }
         }
         ?>
      </div>
   </div>
</div>

<!-- Bootstrap JavaScript link -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>

</body>
</html>





<!-- 
first code -->

<!-- <?php
    include '../config.php';
?>

<?php
if(isset($_GET['email']) && isset($_GET['reset_token'])){
    date_default_timezone_set('Asia/Manila');
    $date = date("Y-m-d");
    $query = "SELECT * FROM admin WHERE `email` = ? AND `resettoken` = ? AND `resettokenexpire` = ?";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sss", $_GET['email'], $_GET['reset_token'], $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($result && mysqli_num_rows($result) == 1) {
        echo "
            <form method='POST'>
                <h3> Create New Password </h3>
                <input type='password' placeholder='New Password' name='password'> 
                <button type='submit' name='updatepassword'> UPDATE </button>
                <input type='hidden' name='email' value='" . $_GET['email'] . "'>
            </form>
        ";
    } else {
        echo "
            <script>
                alert('Invalid or expired Link');
                window.location.href='login_admin.php';
            </script>
        ";
    }
}

if(isset($_POST['updatepassword'])) {
    $pass = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $update = "UPDATE admin SET `password` = ?, `resettoken` = NULL, `resettokenexpire` = NULL WHERE `email` = ?";

    $stmt = mysqli_prepare($conn, $update);
    mysqli_stmt_bind_param($stmt, "ss", $pass, $_POST['email']);

    if(mysqli_stmt_execute($stmt)) {
        echo "
            <script>
                alert('Password Updated Successfully!!');
                window.location.href='login_admin.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Server Down!!');
                window.location.href='login_admin.php';
            </script>
        ";
    }
}
?> -->