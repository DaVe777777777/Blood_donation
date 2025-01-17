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
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BDMS WEBSITE</title>
    <link rel="icon" href="trial.png">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet" /> -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>

<body class="animate__animated animate__fadeIn">


    <section class="animate__animated animate__bounceInRight header">
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
        <div class="animate__animated animate__bounceInRight text-box">
            <h1>DONATE BLOOD,</h1>
            <h1>SAVE LIFE.</h1>
            <br>
            <p>One pint of blood can save live</p>
            <br />
            <a href="donator.php" class="hero-btn">DONATE NOW &rarr;</a>
        </div>
    </section>

    <section class="info">

        <div class="row" id="">
            <div class="info-col">
                <hr color="red">
                <hr color="red">
                <h1>ABOUT US</h1>
                <hr color="red">
                <hr color="red">
                <p>Our blood donation system management team is committed to making a difference in the world by helping
                    save lives through blood donation. Our goal is to connect donors with patients in need, making it as
                    easy as possible to donate blood and provide support to those who require it. We believe that
                    donating blood is a simple act of kindness that can have a major impact on the health and well-being
                    of those in need. With our dedicated team of professionals, we strive to ensure that every donor has
                    a positive and meaningful experience when contributing to our cause. Thank you for being a part of
                    our mission to save lives through blood donation.</p>


            </div>
            <div class="info-col">
                <img src="poor.jpg">

            </div>
        </div>
    </section>


    <section id="contact" class="contact">
        <div class="contact-text">
            <hr color="red">
            <hr color="red">
            <h2>CONTACT US</h2>
            <hr color="red">
            <hr color="red">
            <br>
            <h4>Contact with us any time for further information</h4>
            <p></p>
            <div class="contact-list">
                <li><i class='bx bxs-location-plus'></i> J.P Laurel Highway, Lipa City, Batangas.</li>
                <li><i class='bx bxs-envelope'></i> bdms_07@gmail.com</li>
                <li><i class='bx bxs-phone'></i> (043)773-6800</li>
                <li><i class='bx bxs-mobile'></i></i> 0993 388 5401</li>
                <a href="contact.php" class="hero-btn">CONTACT US</a>

            </div>
            
        </div>

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

    .text-box {
    width: 90%;
    color: #fff;
    position: relative;
    text-align: left;
    margin: auto;
    padding: 3% 5%; 
    box-sizing: border-box; 
    font-size:20px;
}

.text-box h1 {
    margin-bottom: 10px;
    font-size:80px;
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


        .row {
            margin-top: 5%;
            display: flex;
            justify-content: space-between;
        }


        .info {
            width: 80%;
            margin: auto;
            padding-top: 0;
            padding-bottom: 0;

        }

        .info-col {
            flex-basis: 48%;
            padding: 30px 2px;
            
        }

        .info-col img{
            box-shadow: 15px 15px 10px rgba(0, 0, 0, 0.8);
        }

        .info-col img {
            width: 100%;
            height: 100%;
        }

        .info-col h1 {
            text-align: left;
        }

        .info-col h1 {
            text-align: left;
        }

        .info-col p {
            margin: 0px;
            font-size: 20px;
            font-style: italic;
            padding: 15px 0 25px;
        }

        .contact {
            margin: 100px auto;
            width: 80%;
            height: 250px;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(contact.jpg);
            background-position: center;
            background-size: cover;
            border-radius: 10px;
            text-align: center;
            padding: 80px 0;
            color: white;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5);
           
        }

        .contact h2 {
            font-size: 36px;
        }

        .contact h4 {
            font-size: 20px;
        }

        .contact-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            font-size: 18px;
            /* Increased font size */
        }

        .contact-list li {
            margin-bottom: 10px;
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
            .text-box {
    width: 90%;
    color: #fff;
    position: relative;
    text-align: left;
    margin: auto;
    padding: 10% 5%; 
    box-sizing: border-box; 
    font-size:20px;
}

.text-box h1 {
    margin-bottom: 10px;
    font-size:50px;
}

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

           
    .dropdown-menu {
            margin-left: 12px;
            margin-top: -20px;
            background-color: red;

        }

        .dropdown-menu li {
            margin: -10px;

        }


            .row {
                flex-direction: column;
            }

            .contact h2 {
                font-size: 24px;
            }

            .contact h4 {
                font-size: 16px;
            }

            .contact-list {
                font-size: 14px;
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