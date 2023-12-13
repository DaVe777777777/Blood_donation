    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Forgot Password</title>
        <link rel="icon" href="trial.png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
                            <h3 class="text-center">Forgot Password</h3>
                        </div>
                        <div class="card-body">
                            <form  method="POST">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="secretword">Secret Word:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="secretword" name="secretword" oninput="this.value= this.value.replace(/\s/g, '')" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text bg-transparent border-0" id="toggleSecret">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
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

    <script>
        
        const toggleSecret = document.querySelector('#toggleSecret');
        const secretword = document.querySelector('#secretword');

        toggleSecret.addEventListener('click', function (e) {
            const type = secretword.getAttribute('type') === 'password' ? 'text' : 'password';
            secretword.setAttribute('type', type);
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
