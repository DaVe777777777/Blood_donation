


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="trial.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <div class="container my-5 text-center   ">
    <div class="row justify-content-center ">
        <div class="col-lg-6 col-md-8 col-sm-10 ">
            <div class="card">
                <div class="card-header">
                    <a class="text-center">
                        <img src="trial.png" alt="Logo" class="logo">
                    </a>
                    <h3 class="text-center">Admin Login</h3>
                </div>
                <div class="card-body ">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                                <label for="password">Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" oninput="this.value= this.value.replace(/\s/g, '')" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0" id="togglePassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="text-center">WELCOME ADMIN!</p>
                    <!-- <p class="text-center"> <a href="admin_register.php">Register here.</a></p> -->
                </div>
            </div>
        </div>
    </div>
</div>


<?php



session_start();


include 'connection.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $encpass = md5($password);

    // check if user exists in the table
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$encpass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // set session variable to indicate user is logged in
        $data = mysqli_fetch_array($result);
        $name = $data['username'];
        $_SESSION['admin_username'] = $name;

        $logTime = date("Y-m-d H:i:s"); // Get current date and time
    $logActivity = "IN"; // Indicates login
    $insertLogQuery = "INSERT INTO admin_log (admin_name, activity, login_time) VALUES ('$name', '$logActivity', '$logTime')";
    $conn->query($insertLogQuery);

        // redirect to donation.php
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script>
            swal({
                title: "Logged In Successfully!",
                icon: "success",
                button: "OK",
            }).then((result) => {
                if (result) {
                    window.location.href="dashboard.php";
                }
            });
        </script>';
        exit;
    } else {
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script>
            swal({
                title: "Invalid username or password!",
                icon: "error",
                button: "OK",
            }).then((result) => {
                if (result) {
                    window.location.href="admin_login.php";
                }
            });
        </script>';
        exit;
    }
}
$conn->close();
?>

<style>

.logo {
    width: 80px; 
    height: auto; 
    margin-right: 10px; 
}

*{
    margin: 0;
    padding: 0;
    box-sizing:border-box;
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
    border-radius: 20px;
}

.btn {
    padding: 12px 30px;
    width: 40%;
    margin: 40px auto 0;
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
</style>


<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
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
