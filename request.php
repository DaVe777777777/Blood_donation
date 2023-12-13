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

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>REQUEST LIST | ADMIN</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link rel="icon" href="trial.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet" /> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>


<section class="header">
        <nav>
            <a href="dashboard.php"><img src="trial.png" /></a>
            <div class="nav-links" id="navLinks">
                <i class="bi bi-x-lg" onclick="hideMenu()"></i>
            <ul>
                <li><a href="admin_requirements.php">REQUIREMENTS</a></li>
                <li><a href="donor.php">DONOR</a></li>
                <li><a href="">REQUEST</a></li>
                <li ><a href="admin_logout.php" class="logout-button">LOGOUT</a></li>
            </ul>
            </div>
            <i class="bi bi-list" onclick="showMenu()"></i>
        </nav>
</section>
    

    <div class="container mt-4">
        
                <hr color="red">
                <hr color="red">
                <h1 class="text-center">REQUEST LIST</h1>
                <hr color="red">
                <hr color="red">
                <a href="request_search.php" class="btn btn-primary"><i class="fas fa-search"></i> SEARCH<a>


                <div class="table-responsive mt-4 ">
                    <table class="table table-striped table-hover table-bordered">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Blood Type</th>
                            <th>Age</th>
                            <th>Weight</th>
                            <th>Units</th>
                            <th>Actions</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                        <?php

                        include 'connection.php';

                        // Pagination variables
                        $records_per_page = 3; // Number of records to display per page
                        $current_page = isset($_GET['page']) ? $_GET['page'] : 1; // Get the current page number

                        // Calculate the offset for the SQL query
                        $offset = ($current_page - 1) * $records_per_page;

                        // Retrieve records for the current page only
                        $sql = "SELECT * FROM donator ORDER BY id DESC LIMIT $offset, $records_per_page";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['blood_type'] . "</td>";
                                echo "<td>" . $row['age'] . "</td>";
                                echo "<td>" . $row['weight'] . "</td>";
                                echo "<td>" . $row['unit'] . "</td>";
                                echo "<td>
                                            <a href='admin_update.php?id=" . $row['id'] . "' class='btn btn-sm btn-warning'>Update</a>
                                            <a href='admin_delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")' class='btn btn-sm btn-danger'>Delete</a>
                                        </td>";
                                echo "<td class='status-column'>";
                                if ($row['status'] == 2) {
                                    echo "<span class='accepted-status'>Accepted</span>";
                                } elseif ($row['status'] == 3) {
                                    echo "<span class='rejected-status'>Rejected</span>";
                                } else {
                                    echo "<span class='pending-status'>Pending</span>";
                                }
                                echo "</td>";
                                echo "<td>
                                            <select onchange='updateStatus(" . $row['id'] . ", this.value)'>
                                                <option value='1'>Pending</option>
                                                <option value='2'>Accepted</option>
                                                <option value='3'>Rejected</option>
                                            </select>
                                        </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No records found</td></tr>";
                        }

                        // $conn->close();

                        ?>


                    </table>
                </div>
    </div>

                <!-- Pagination buttons -->
                <div class="pagination mt-4">
                    <?php
                    // Retrieve total number of records
                    $total_records_sql = "SELECT COUNT(*) AS count FROM donator";
                    $total_records_result = $conn->query($total_records_sql);
                    $total_records = $total_records_result->fetch_assoc()['count'];

                    // Calculate total number of pages
                    $total_pages = ceil($total_records / $records_per_page);

                    // Display previous button if not on the first page
                    if ($current_page > 1) {
                        echo "<a href='request.php?page=" . ($current_page - 1) . "' class='btn btn-primary'>Previous</a>";
                    }

                    // Display page numbers
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $current_page) {
                            echo "<a href='request.php?page=" . $i . "' class='btn btn-primary active'>" . $i . "</a>";
                        } else {
                            echo "<a href='request.php?page=" . $i . "' class='btn btn-primary'>" . $i . "</a>";
                        }
                    }

                    // Display next button if not on the last page
                    if ($current_page < $total_pages) {
                        echo "<a href='request.php?page=" . ($current_page + 1) . "' class='btn btn-primary'>Next</a>";
                    }
                    $conn->close();
                    ?>
                </div>

                <script>
                    function updateStatus(id, status) {
                        var confirmUpdate = confirm("Are you sure you want to update the status?");
                        if (confirmUpdate) {
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "update_status.php", true);
                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhr.onreadystatechange = function () {
                                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                                    console.log(xhr.responseText); // Handle the response here (if needed)
                                    window.location.reload(); // Auto-refresh the page
                                }
                            };
                            xhr.send("id=" + encodeURIComponent(id) + "&status=" + encodeURIComponent(status));
                        }
                    }
                </script>



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
        padding: 0 80px;
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

    nav .bi {
        display: none;
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

    .text-center{
    font-size:100px;
    font-weight: bolder;
}

    


.pagination {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-bottom:20px;
}

.pagination a {
    margin: 0 5px;
    text-decoration: none;
    padding: 5px 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    background-color: #f1f1f1;
    color: #333;
}

.pagination a:hover {
    background-color: #ddd;
}

.pagination a.active {
    background-color: #007bff;
    color: #fff;
}

.status-column span {
    display: inline-block;
    padding: 6px 12px; 
    border-radius: 4px;
    font-weight: bold;
}

.pending-status {
    background-color: orange;
    color: white;
}

.accepted-status {
    background-color: green;
    color: white;
}

.rejected-status {
    background-color: red;
    color: white;
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

    .text-center{
    font-size:50px;
    font-weight: bolder;
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
