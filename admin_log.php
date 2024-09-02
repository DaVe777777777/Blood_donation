<?php
session_start();
if (empty($_SESSION['admin_username'])) {
    header('location: admin_login.php');
    exit;
}
if (!empty($_SESSION['admin_username'])) {
    $username = $_SESSION['admin_username'];
}

include 'connection.php';

$entriesPerPage = 3; // Number of log entries per page

// Query to count total log entries
$countQuery = "SELECT COUNT(*) AS total FROM admin_log";
$countResult = $conn->query($countQuery);
$totalEntries = $countResult->fetch_assoc()['total'];

// Get current page number
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

// Calculate total pages
$totalPages = ceil($totalEntries / $entriesPerPage);

// Calculate the SQL LIMIT for the current page
$offset = ($page - 1) * $entriesPerPage;
$logQuery = "SELECT * FROM admin_log ORDER BY login_time DESC LIMIT $offset, $entriesPerPage";
$logResult = $conn->query($logQuery);
?>

<!-- Rest of your HTML code remains unchanged -->


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body  class="animate__animated animate__fadeIn">

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
        
        
</section>

<div  class="animate__animated animate__backInLeft" id="welcome">
    <hr class="animate__animated animate__backInLeft" color="red">
    <hr  class="animate__animated animate__backInLeft"color="red">
     ADMIN LOG
    <hr  class="animate__animated animate__backInLeft"color="red">
    <hr  class="animate__animated animate__backInLeft"color="red">

</div>


<div class="animate__animated animate__flipInY search-container">
            <form action="admin_log.php" method="GET">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <?php
            // After getting the current page number

$searchQuery = '';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $searchQuery = "WHERE admin_name LIKE '%$search%' OR activity LIKE '%$search%' OR login_time LIKE '%$search%' OR id = '$search'";
}

$countQuery = "SELECT COUNT(*) AS total FROM admin_log $searchQuery";
// ... (the rest of your PHP code remains the same)

// Modify the $logQuery
$logQuery = "SELECT * FROM admin_log $searchQuery ORDER BY login_time DESC LIMIT $offset, $entriesPerPage";
$logResult = $conn->query($logQuery);

        ?>

        
        <div class="animate__animated animate__flipInY admin-log">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Admin Name</th>
                    <th>Activity</th>
                    <th>Login Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display log data in a table format
                if ($logResult->num_rows > 0) {
                    while ($row = $logResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['admin_name'] . "</td>";
                        echo "<td>" . $row['activity'] . "</td>";
                        echo "<td>" . $row['login_time'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No log entries found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="pagination">
        <?php
        // Previous Page link
        if ($page > 1) {
            echo '<a href="admin_log.php?page=' . ($page - 1) . '">Previous</a>';
        }

        // Page numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            echo '<a href="admin_log.php?page=' . $i . '">' . $i . '</a>';
        }

        // Next Page link
        if ($page < $totalPages) {
            echo '<a href="admin_log.php?page=' . ($page + 1) . '">Next</a>';
        }
        ?>
    </div>
    


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
        padding: 0 50px;
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


    #welcome  {
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
    margin-left: 200px;
    margin-right: 200px;
    font-weight: lighter;
}

        .search-container {
    text-align: left;
    margin-top: 20px;
    margin-left: 250px;
}

.search-container input[type="text"] {
    padding: 10px;
    width: 200px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-right: 5px;
}

.search-container button {
    padding: 10px 15px;
    border: none;
    background-color: blue;
    color: white;
    border-radius: 5px;
    cursor: pointer;
}

.search-container button:hover {
    background-color: lightblue;
}
      

/* Your existing styles... */

.admin-log {
    margin: 20px auto;
    max-width: 800px;
   
   
}

.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
    cursor: pointer;
    

}

table th {
    background-color: #f2f2f2;
    font-weight: bold;
}

.td:hover  {
    background-color:gray;
    cursor: pointer;
}

 table tbody tr:hover{
    color: #ddd;
 }



 .pagination {
        margin-top: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        margin-bottom: -45px;
        
    }

    .pagination a {
        margin: 0 5px;
        text-decoration: none;
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        background-color: #f1f1f1;
        color: #333;
        padding-top: 7px;
        padding-bottom: 7px;
    }

    .pagination a:hover {
        background-color: #ddd;
    }

    .pagination a.active {
        background-color: #007bff;
        color: blue;
    }

      

.footer {
            width: 100%;
            background-color: red;
            text-align:center;
            background-size: cover;
            padding: 20px 0;
            color:white;
            margin-top:70.5px;

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

    

    #welcome  {
        font-size: 50px; /* Adjust font size for smaller screens */
    }

    hr {
        margin: 10px 0; /* Reduce margin for smaller screens */
    }


    .search-container {
        text-align: center;
        margin: 20px auto;
    }

    .search-container input[type="text"],
    .search-container button {
        width: auto;
        margin: 5px;
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
