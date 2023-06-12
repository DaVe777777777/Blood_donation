<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        <h3 class="text-center">Blood Donation Management System</h3>
                    </div>
                    <div class="card-body">
                        <form  method="POST">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="secretword">Secret Word:</label>
                                <input type="password" class="form-control" id="secretword" name="secretword" oninput="this.value= this.value.replace(/\s/g, '')" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="text-center"><a href="login.php">Back to Login</a></p>
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
        $secretword = $_POST["secretword"];
        $encsecretword = md5($secretword);

        $sql = "SELECT * FROM users WHERE username='$username' AND secretword='$encsecretword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Secret word matched, generate a new password for the user
            $newPassword = generatePassword();
            $encpass = md5($newPassword);

            // Update the user's password in the database
            $updateSql = "UPDATE users SET password='$encpass' WHERE username='$username'";
            if ($conn->query($updateSql) === true) {
                // Password updated successfully
                $_SESSION['newPassword'] = $newPassword;

                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script>
                    swal({
                        title: "Password Changed Successfully",
                        text: "Your password has been changed successfully",
                        icon: "success",
                        button: "OK",
                    }).then((result) => {
                        if (result) {
                            window.location.href = "confirm.php";
                        }
                    });
                </script>';
                exit;
            } else {
                // Error occurred while updating password
                echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
                echo '<script>
                    swal({
                        title: "Error",
                        text: "An error occurred while resetting your password. Please try again later.",
                        icon: "error",
                        button: "OK",
                    }).then((result) => {
                        if (result) {
                            window.location.href = "fp.php";
                        }
                    });
                </script>';
                exit;
            }
        } else {
            // Secret word does not match
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
            echo '<script>
                swal({
                    title: "Invalid Username or Secret Word!",
                    text: "Please enter the correct username and secret word.",
                    icon: "error",
                    button: "OK",
                }).then((result) => {
                    if (result) {
                        window.location.href = "fp.php";
                    }
                });
            </script>';
            exit;
        }
    }

    function generatePassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $password .= $characters[$index];
        }
        return $password;
    }

    $conn->close();
    ?>

    <style>
    .logo {
        width: 80px; 
        height: auto; 
        margin-right: 10px;
    }

    /* Add your custom styles here */
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
