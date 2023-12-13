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

// Fetch the username from the database
$sql = "SELECT username FROM users WHERE username = '$username'";
$result = $conn->query($sql);
if ($row = mysqli_fetch_assoc($result)) {
    $name = $row['username'];
   
}

// Date of the certificate
$currentDate = date('F d, Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CERTIFICATE</title>
    <link rel="icon" href="trial.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

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
                <li><a href="certificate.php">CERTIFICATE</a></li>
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
        </div>
        <i class="bi bi-list" onclick="showMenu()"></i>
    </nav>
</section>

<section class="certificate">
    <div class="certificate-content">
        <h1>BLOOD DONATION CERTIFICATE</h1>
        <p>Congratulations!</p>
        <p>This certificate is given to:</p>
        <p>----------------------------------------------------------------</p>
        <h2><?php echo $name; ?></h2>
        <p>----------------------------------------------------------------</p>
        <p>to show our appreciation for donating your blood.</p>
        <p>Presented on <?php echo $currentDate; ?></p>
    </div>

    <div class="text-center">
        <button onclick="window.print()" class="btn ">Print</button>
    </div>
</section>




<style>

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
    }

    nav img {
        width: 100px;
        padding-top:14px;
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
        padding-top:8px;
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
        padding: 8px 16px;
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

.btn {
    background-color: blue; 
    color: white; 
    padding: 12px 24px; 
    font-size: 16px; 
    border: none;
    border-radius:10px;
}

.btn:hover {
    background-color: lightblue; 
}
.text-center {
    margin-top: 20px;
}
.certificate {
    
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: auto;
    padding:20px;

}

.certificate-content {
    text-align: center;
    border: 2px solid black;    
    padding:80px;
    max-width: 400px;
    margin: 0 auto;
}

.certificate-content h1 {
    font-size: 32px;
    font-weight: bold;
    margin-bottom: 20px;
    color:red;
    font-style: italic;
}

.certificate-content h2 {
    font-size: 24px;
    font-weight: bold;
    margin: 20px 0;
    font-family: century;

}

.certificate-content p {
    font-size: 18px;
    margin-bottom: 10px;
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
        var navLinks = document.getElementById("navLinks");

        function showMenu() {
            navLinks.style.right = "0";
        }
        function hideMenu() {
            navLinks.style.right = "-200px";
        }
</script>



   
</body>
</html>