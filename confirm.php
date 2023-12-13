<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Perform the password change logic here
// Redirect to login.php 
header("Location: login.php"); 
exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Password Change</title>
    <link rel="icon" href="trial.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
</head>
<body>
    <div class="container my-5 text-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card">
                    <div class="card-header">
                    <a class="text-center">
                            <img src="trial.png" alt="Logo" class="logo">
                        </a>
                        <h3 class="text-center">Password Reset Confirmation</h3>
                    </div>
                    <div class="card-body">
                        <p>Your new password has been generated please save it and don't forget again:</p>
                        <h4><?php echo $_SESSION['newPassword']; ?></h4>
                    </div>
                    <div class="card-footer">
                        <form method="POST" >
                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                            <input type="hidden" name="password" value="<?php echo $encpass; ?>">
                            <button type="submit" class="btn btn-primary btn-block">Confirm Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    

    /* .forgot-btn{
        margin-top:10px;
        text-align:center;
        border:none;
        background-color: transparent;
        outline: none;
        font-weight:450;
        cursor:pointer;
    } */
    
    
    
    *{
        margin: 0;
        padding: 0;
        box-sizing:border-box;
    }

    .logo {
        width: 80px; 
        height: auto; 
        margin-right: 10px;
    }
    
    body{
        background-image:url(bg.png);
        background-size: cover;
        height:auto;
        width:100%;
        background-position:center;
        background-repeat: no-repeat;
    
    }
    
    .card {
        box-shadow: 15px 15px 10px rgba(0, 0, 0, 0.8);
        border-radius: 10px;
    }
    
    .card-header h3 {
        font-size: 2.5rem;
        font-family: Arial, Helvetica, sans-serif;
        margin: 10px;
    }
    
    .form-control {
        padding: 12px;
        width: 93%;
        margin: 15px;
        border: 1px solid black;
        outline: none;
        border-radius: 22px;
    }
    
    .btn {
        padding: 12px 30px;
        width: 40%;
        margin: 0px auto 0;
        display: block;
        background-color: blue;
        color: white;
        font-weight: bold;
        border: none;
        outline: none;
        border-radius: 20px;
    }
    
    .input-group-text {
            cursor: pointer;
           
        }
    
        .input-group-text i {
            color: #000; /* Change this to the desired eye icon color */
            margin-top: 10px;
        }
    
        .input-group-text i:hover {
            color: #007bff; /* Change this to the desired eye icon color on hover */
        }
    
    </style>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" 
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNSL2Zf" 
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
    crossorigin="anonymous"></script>
</body>
</html>
