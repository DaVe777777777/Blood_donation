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
    <title>REQUIREMENTS</title>
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
        <h1 class="animate__animated animate__backInLeft ">REQUIREMENTS</h1>
        <hr class="animate__animated animate__backInLeft "color="red">
        <hr class="animate__animated animate__backInLeft "color="red">
        <br>
        <p>To donate blood, individuals need to achieve certain requirements:</p>
      
        <br>
        <div class="row">
           
            <div class="req-col">

                <h2>Age:</h2>
                <p>Individuals must be at least 17 years old or 16 years old with parental consent in some states.</p>
            </div>
            
            <div class="req-col">

                <h2> Weight:</h2>
                <p>Donors must weigh at least 110 pounds.</p>
            </div>
            
            <div class="req-col">

                <h2>Health:</h2>
                <p>Donors must be in good health and not have any contagious diseases.</p>
            </div>
            
            <div class="req-col">

                <h2>Medications:</h2>
                <p>Some medications may prevent individuals from donating. They should consult with their physician before donating blood.</p>
            </div>

             <div class="req-col">

                <h2>Travel:</h2>
                <p>Individuals who have recently traveled to certain countries or regions may not be able to donate due to the risk of disease transmission.</p>
            </div>

             <div class="req-col">

                <h2>Lifestyle:</h2>
                <p>Certain lifestyle choices, such as using intravenous drugs, may prevent individuals from donating blood.</p>
            </div>

             <div class="req-col">

                <h2>Time:</h2>
                <p>Donors should wait at least eight weeks between whole blood donations and 16 weeks between double red cell donations.</p>
            </div>
        </div>
</section>


 <!-- CONTACT -->
 <section class="contact">
        <h1>DID YOU ACHIEVE IT?</h1>
        <a href="donator.php" class="hero-btn">DONATE NOW</a>
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

.req-col{
    flex-basis: 31%;
    border-radius: 10px;
    margin-bottom: 5%;
    background: #c0392b;
    padding: 20px 12px;
    box-sizing: border-box;
    transition: 0.5s;
}


.req-col p{
    padding: 0;
    text-align: center;
    color: #fff;
}

.req-col h2{
    margin-top: 16px;
    margin-bottom: 15px;
    text-align: center;
    color: #fff;
}
.req-col:hover{
    box-shadow: 0 0 20px 0px rgb(229, 255, 0);
    background: red;

}

.contact{
    margin: 50px auto;
    width: 80%;
    background-image: linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.7)),url(poor.jpg);
    background-position: center;
    background-size: cover;
    border-radius: 10px;
    text-align: center;
    padding: 100px 0;
}

.contact h1{
    color: #fff;
    margin-bottom: 40px;
    padding: 0;
}

.hero-btn {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    border: 2px solid #fff;
    padding: 12px 34px;
    font-size: 13px;
    background: transparent;
    position: relative;
    cursor: pointer;
    margin-top: 20px; 
}

        .hero-btn:hover {
            border: 2px solid #fff;
            background: yellow;
            transition: 1s;
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