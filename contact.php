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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CONTACT</title>
    <link rel="icon" href="trial.png">
    <link rel="stylesheet" href="requirements.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
        <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
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

<section class="req">
        <hr class="animate__animated animate__backInLeft "color="red">
        <hr class="animate__animated animate__backInLeft "color="red">
        <h1 class="animate__animated animate__backInLeft ">CONTACT</h1>
        <hr class="animate__animated animate__backInLeft "color="red">
        <hr class="animate__animated animate__backInLeft "color="red"> 
</section>


<section class="contact-section">
        <div class="map">
            <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3866.2677032131436!2d121.13029701425894!3d13.913133190234323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397a2b5d306a773%3A0x99a0a10e8a608aa1!2sMataasnakahoy!5e0!3m2!1sen!2sph!4v1606816671474!5m2!1sen!2sph"
            width="100%" height="700px" allowfullscreen="" aria-hidden="false" 
            tabindex="0">
        </iframe>
        </div>
        <h2>BATANGAS</h2>
        <p>0993 388 5401</p>
        <p>(043)773-6800</p>
        <p>bdms_07@gmail.com</p>
        <p class="address">J.P Laurel Highway, Lipa City, Batangas.</p>
     
    </section>


<section class="footer">
        <h3>&copy; 2023 Blood Donation Management System.</h3>
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

    .contact-section {
            
            text-align: center;
            padding-bottom: 40px;

        }

        .map{
            border-top: 2px solid black;
            border-bottom: 2px solid black;
           
        }

        .contact-section h1 {
           
            color: black;
            font-size: 30vh;
            margin-bottom: 20px;
        }

        .contact-section h2 {
            padding-top: 20px;
            text-align: center;
            font-size: 30px;
            background-color: red;
            color: #fff;

        }

        .contact-section p {
            font-size: 23px;
            background-color: red;
            color: #fff;
        }

        .address {
            border-bottom: 2px solid black;
            margin-bottom: 40px;
            padding-bottom: 20px;
            background-color: red;
            color: #fff;
        }

        .req h1  {
    font-size: 16vh;
    margin: 20px;
    text-align: center;
    font-weight: bolder;
}

hr {
    border: none;
    height: 0.5px;
    background-color: red;
    margin: 17px 0;
    font-weight: lighter;
    
}
.req{
    width: 80%;
    margin: auto;
    text-align: center;
    padding-top: 10px;
}

.req h1{
    font-size:100px;
}

.footer {
            width: 100%;
            background-color: red;
            text-align:center;
            background-size: cover;
            padding: 20px 0;
            color:white;
        }


  @media (max-width: 768px) {

    .nav-links ul li {
        display: block;
        padding: 20px 12px;
        text-align: center;
    }
    .nav-links {
        position: absolute;
        background: red;
        height: 100vh;
        width: 200px;
        top: 0;
        right: -200px;
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

    .dropdown-menu {
            margin-left: 12px;
            margin-top: -20px;
            background-color: red;

        }

        .dropdown-menu li {
            margin: -10px;

        }

    .req h1{
    font-size:45px;
}

    .contact h1{
        font-size: 24px;
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