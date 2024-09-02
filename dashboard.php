<?php
session_start();
if(empty($_SESSION['admin_username'])) {
    header('location: admin_login.php');
    exit;
}
if(!empty($_SESSION['admin_username']))
{
    $username = $_SESSION['admin_username'];
}


include 'connection.php';

// Fetch the count of users from the users table
$userCountQuery = "SELECT COUNT(*) AS user_count FROM users";
$userCountResult = $conn->query($userCountQuery);
$userCount = 0;
if ($userCountResult && $userCountResult->num_rows > 0) {
    $userCountData = $userCountResult->fetch_assoc();
    $userCount = $userCountData['user_count'];
}

// Fetch the count of requests from the donator table
$requestCountQuery = "SELECT COUNT(*) AS request_count FROM donator";
$requestCountResult = $conn->query($requestCountQuery);
$requestCount = 0;
if ($requestCountResult && $requestCountResult->num_rows > 0) {
    $requestCountData = $requestCountResult->fetch_assoc();
    $requestCount = $requestCountData['request_count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BDMS WEBSITE | ADMIN</title>
    <link rel="icon" href="trial.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      /> 
</head>
<body class="animate__animated animate__fadeIn">


<section class="header">
        <nav>
        <a href="dashboard.php"><img src="trial.png" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>
                <li><a href="admin_requirements.php">REQUIREMENTS</a></li>
                <li><a href="donor.php">DONOR</a></li>
                <li><a href="request.php">REQUEST</a></li>
                <li><a href="admin_log.php">ADMIN LOG</a></li>
                <li ><a href="admin_logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
            </div>
            <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>

        <div class="animate__animated animate__backInDown" id="welcome">WELCOME ADMIN</div>

        <div class="animate__animated animate__flip status">
            <div class="box">
                <i class="fa-solid fa-user"></i>
                <div class="box-title">TOTAL USERS</div>
                <p class="box-paragraph"><?php echo $userCount; ?></p>
            </div>
            <div class="box">
                <i class="fa-solid fa-hand-holding-droplet"></i>
                <div class="box-title">TOTAL REQUEST</div>
                <p class="box-paragraph"><?php echo $requestCount; ?></p>
            </div>
        </div>

        <!-- <div class="stats-container">
    <div class="user-count-box">
        <h3>Total Users</h3>
        <p><?php echo $userCount; ?></p>
    </div>
    <div class="request-count-box">
        <h3>Total Requests</h3>
        <p><?php echo $requestCount; ?></p>
    </div>
</div> -->
<div class="footer">
            <h3>&copy; 2023 STEP UP. All Rights Reserved.</h3>
        </div>
        
</section>





<style>
     

  
* {
            margin: 0;
            padding: 0;
            font-family: "Roboto", sans-serif;
        }

        .header {
            min-height: 100vh;
            width: cover;
            background-image: linear-gradient(rgba(4, 9, 30, 0.7), rgba(4, 9, 30, 0.7)),
                url(med.png);
            background-position: center;
            background-size: cover;
            position: relative;
        }

        nav {
            display: flex;
            padding: 2% 6%;
            justify-content: space-between;
            align-items: center;
        }

        nav img {
            width: 150px;
        }

        .nav-links {
            flex: 1;
            text-align: right;
        }

        .nav-links ul li {
            list-style: none;
            display: inline-block;
            padding: 0 50px;
            position: relative;
        }

        .nav-links ul li a {
            color: #fff;
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

        nav .bi {
            display: none;
        }

        .logout-button {
            display: inline-block;
            padding: 8px 16px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #c0392b;
            border: none;
            border-radius: 5px;
            box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.2s ease-in-out;
        }

        .logout-button:hover {
            background-color: #e74c3c;
        }


.dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
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

    #welcome {
            font-size: 15vh;
            color: #fff;
            font-weight: bolder;
            text-align: center;
         
        }

.status {
            display: flex;
            flex-direction: row;
            justify-content: center;
            margin: 5vh;
        }

        .box {
            color: #fff;
            padding: 20px;
            margin: 10px;
            border-radius: 5px;
            width: 30%;
            text-align: center;
            box-shadow: 15px 15px 10px black ;
            font-size: 30px;
        }

        .box-title {
            padding-top: 20px;
            font-size: 30px;
            margin-bottom: 10px;
            font-weight: bolder;
        }

        .box-paragraph {
            font-size: 30px;
        }

        .box:nth-child(1) {
            background-color: #3498db;
        }

        .box:nth-child(2) {
            background-color: #e74c3c;
        }

        .box:nth-child(3) {
            background-color: #27ae60;
        }
        

        .box i {
            font-size: 40px;
        }

.footer {
            width: 100%;
            background-color: red;
            text-align:center;
            background-size: cover;
            padding: 20px 0;
            color:white;
            margin-top:6.5rem;

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
        text-align: center;
        z-index: 2;
        transition: 1s;
    }

    nav .bi {
        display: block;
        color: #fff;
        margin: 10px;
        font-size: 22px;
        cursor: pointer;
        text-align: left;
    }
    .nav-links ul {
        padding: 30px;
    }

    .status {
                flex-direction: column;
                align-items: center;
            }

            .box {
                width: 70%;
                margin: 10px 0;
                font-size: 20px; /* Adjust font size for smaller screens */
            }

            .box-title {
                font-size: 20px; /* Adjust title font size for smaller screens */
            }

            .box-paragraph {
                font-size: 20px; /* Adjust paragraph font size for smaller screens */
            }

            #welcome {
                font-size: 10vh; /* Adjust font size for smaller screens */
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
