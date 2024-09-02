<?php
include 'connection.php';
session_start();
if(empty($_SESSION['user_username']))
{
    header('location:login.php');
}
if(!empty($_SESSION['user_username']))
{
$username = $_SESSION['user_username'];
}

// Fetch user information from the database
$selectUserQuery = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($selectUserQuery);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $newUsername = $_POST['username'];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $secretword = $_POST["secretword"];
        $encsecretword = md5($secretword);
        

        // Update username in users table
        $updateUserQuery = "UPDATE users SET username='$newUsername', email='$email', mobile='$mobile', secretword='$encsecretword' WHERE username='$username'";
        if ($conn->query($updateUserQuery) === TRUE) {
            // Update the session with the new username
            $_SESSION['username'] = $newUsername;
            // Update the $username variable
            $username = $newUsername;

            // Fetch user information from the database with the updated username
            $selectUserQuery = "SELECT * FROM users WHERE username='$username'";
            $result = $conn->query($selectUserQuery);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }

            $message = "Profile updated successfully.";
            echo '<script>alert("Profile updated successfully.");</script>';
        } else {
            $error = "Error updating profile: " . $conn->error;
        }

        // Update username in donator table
        $updateDonatorQuery = "UPDATE donator SET username='$newUsername' WHERE username='$username'";
        if ($conn->query($updateDonatorQuery) === TRUE) {
            $message .= " Username updated.";
        } else {
            $error .= " Error updating username: " . $conn->error;
        }
    } elseif (isset($_POST['changePassword'])) {
        $currentPassword = md5($_POST['currentPassword']);
        $newPassword = $_POST['newPassword'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$currentPassword'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $newEncPass = md5($newPassword);
            $updatePasswordSql = "UPDATE users SET password='$newEncPass' WHERE username='$username'";
            if ($conn->query($updatePasswordSql) === TRUE) {
                $message = "Password changed successfully.";
                echo '<script>alert("Password changed successfully.");</script>';
            } else {
                $error = "Error changing password: " . $conn->error;
                
            }
        } else {
            $error = "";
            echo '<script>alert("Invalid current password.");</script>';
        }
    }

    // Redirect to reload the page
    // header('Location: ' . $_SERVER['PHP_SELF']);
    // exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PROFILE</title>
    <link rel="icon" href="trial.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="animate__animated animate__fadeIn">
<section class="header">
<nav>
            <a href="index.php"><img src="trial.png" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>

                <li><a href="requirements.php">REQUIREMENTS</a></li>
                <li class="dropdown"> 
                        <a href="#">DONATION</a> 
                        <ul class="dropdown-menu"> 
                            <li><a href="view_donator.php">REQUEST</a></li>
                            <li><a href="donator.php">DONATE</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.php">CONTACT</a></li>
                    <li class="dropdown"> 
                        <a href="#">USER</a> 
                        <ul class="dropdown-menu"> 
                        <li><a href="certificate.php">CERTIFICATE</a></li>
                        <li><a href="profile.php">PROFILE</a></li>
                        </ul>
                    </li>
                <li ><a href="logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
            </div>
            <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>
</section>


<div class="animate__animated animate__flipInY container">
    <h2>Welcome, <?php echo $username; ?></h2>
    <?php
    if (isset($_GET['message'])) {
        echo "<div class='success'>" . $_GET['message'] . "</div>";
    }
    if (isset($error)) {
        echo "<div class='error'>" . $error . "</div>";
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <h4>Update Profile</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php echo $row['email']; ?>" oninput="this.value= this.value.replace(/\s/g, '')"
                           required>
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile"
                           value="<?php echo $row['mobile']; ?>" maxlength="11"
                           oninput="this.value=this.value.replace(/[^0-9]/g, '')" required
                           pattern="[0-9]{11}"
                           title="Mobile should have 11 numbers">
                </div>
                <div class="form-group">
                                <label for="secretword">Secret Word:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="secretword" name="secretword" oninput="this.value= this.value.replace(/\s/g, '')" required
                                    pattern="^(?=.*[!@#$%^&*])\S{8,12}$" 
                                    title="Password must be 8-12 characters long and contain at least one special character (!@#$%^&*)">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0" id="toggleSecret">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                <button type="submit" name="update" class="btn btn-primary" onclick="return confirm('Are you sure you want to update your profile?')">Update</button>

                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'">Cancel</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Change Password</h4>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                                <label for="currentPassword">Current Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="currentPassword" name="currentPassword" oninput="this.value= this.value.replace(/\s/g, '')" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0" id="togglecurrentPassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                <div class="form-group">
                                <label for="NewPassword">New Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="NewPassword" name="NewPassword" oninput="this.value= this.value.replace(/\s/g, '')" required
                                    pattern="^(?=.*[!@#$%^&*])\S{8,12}$"
                                    title="Password must be 8-12 characters long and contain at least one special character (!@#$%^&*)">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent border-0" id="toggleNewPassword">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                <button type="submit" name="changePassword" class="btn btn-primary" onclick="return confirmChangePassword()">Change Password</button>
                <button type="button" class="btn btn-danger" onclick="location.href='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'">Cancel</button>
            </form>
        </div>
    </div>
</div>

<section class="footer">
        <h3>&copy; 2023 Blood Donation Management System.</h3>
    </section>

<style>
    /* .success {
        border: 2px solid green;
        padding: 10px;
        margin-bottom: 10px;
    }

    .error {
        border: 2px solid red;
        padding: 10px;
        margin-bottom: 10px;
    } */

    * {
    margin: 0;
    padding: 0;
    font-family: "Roboto", sans-serif;
}

.header {
        width: 100%;
        background-color: red;
        background-size: cover;
        height: 20vh;
    }

    nav {
        display: flex;
        padding: 0% 7%;
        justify-content: space-between;
        align-items: center;
        padding-top:14px;
    }

    nav img {
        width: 100px;
     
        
        
    }

    .nav-links {
        flex: 1;
        text-align: center;

    }

    .nav-links ul {
    padding: 0;
    margin: 0;
    text-align: center;
}

    .nav-links ul li {
        list-style: none;
        display: inline-block;
        padding: 0 55px;
        position: relative;
    }

    .nav-links ul li a {
        color: white;
        text-decoration: none;
        font-size: 15px;
        font-weight: bolder;
    }

    .nav-links ul li a::after {
        content: "";
        width: 0%;
        height: 2px;
        background: yellow;
        display: block;
        margin: auto;
        transition: 0.5s;
    }

    .nav-links ul li a:hover::after {
        width: 100%;
    }

    .logout-button {
        display: inline-block;
        padding: 5px 16px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        background-color: #c0392b;
        border: none;
        border-radius: 5px;
        box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
        transition: background-color 0.2s ease-in-out;
    }

    .logout-button:hover {
        background-color: #e74c3c;
    }

    nav .bi {
        display: none;
    }


.dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: red;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        text-align: left;
        top: 100%;
        left: 0;
        padding-top: 10px;
        padding-bottom: 10px;

    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu li {
        margin: 3px;
        margin-left: 3px;
    }   

    .container{
        padding:20px;
    }

    .footer {
    width: 100%;
    background-color: red;
    text-align: center;
    background-size: cover;
    color: white;
    padding: 20px 0;
    padding-bottom:12px;
    
    
}

.footer h3{
  font-size: 20px;
  font-weight:bolder;
 
}

.input-group-text {
        cursor: pointer;
    }

    .input-group-text i {
        color: #000; /* Change this to the desired eye icon color */
        
    }

    .input-group-text i:hover {
        color: #007bff; /* Change this to the desired eye icon color on hover */
    }
    @media (max-width: 768px) {

        .nav-links ul li {
        display: block;
        padding: 20px 12px;
    }
    .nav-links {
        position: absolute;
        background: red;
        height: 100vh;
        width: 200px;
        top: 0;
        right: -200px;
        text-align: left;
        z-index: 2;
        transition: 1s;
    }

    nav .bi {
        display: block;
        color: #fff;
        margin: 10px;
        font-size: 22px;
        cursor: pointer;
    }
    .nav-links ul {
        padding: 30px;
    }
}


</style>

<script>
    const togglecurrentPassword = document.querySelector('#togglecurrentPassword');
    const toggleNewPassword = document.querySelector('#toggleNewPassword');
    const toggleSecret = document.querySelector('#toggleSecret');
    const currentPassword = document.querySelector('#currentPassword');
    const NewPassword = document.querySelector('#NewPassword');
    const secretword = document.querySelector('#secretword');

    togglecurrentPassword.addEventListener('click', function (e) {
        const type = currentPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        currentPassword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    toggleNewPassword.addEventListener('click', function (e) {
        const type = NewPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        NewPassword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    toggleSecret.addEventListener('click', function (e) {
        const type = secretword.getAttribute('type') === 'password' ? 'text' : 'password';
        secretword.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>


<script>
    function showMenu() {
        var navLinks = document.getElementById("navLinks");
        navLinks.style.right = "0";
    }

    function hideMenu() {
        var navLinks = document.getElementById("navLinks");
        navLinks.style.right = "-200px";
    }

    function confirmUpdate() {
        return confirm("Are you sure you want to update your profile?");
    }

    function confirmChangePassword() {
        return confirm("Are you sure you want to change your password?");
    }
</script>

</body>
</html>
