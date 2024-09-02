<?php
session_start();
if(empty($_SESSION['admin_username'])) {
}
if(!empty($_SESSION['admin_username']))
{
    $username = $_SESSION['admin_username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>REQUEST DETAILS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="trial.png">
    <style>
       
       body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            border: 2px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            max-width: 600px;
            text-align: center;
        }

        .logo {
            width: 100px;
        }

        .btn {
            background-color: blue;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            margin-top: 20px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: lightblue;
        }

        .print-btn-container {
            margin-top: 20px;
            text-align: center;
            margin-bottom: 20px; 
            
        }

        p {
            font-size: 18px;
            margin-bottom: 12px;
        }
        
        h1{
            font-size: 50px; 
        }
        /* Adjusted font size for status */
        .accepted-status, .rejected-status, .pending-status {
            font-size: 20px;
        }
        

        @media print {
            .btn{
                display: none;
            }
    }
    </style>
</head>
<body>
    <div class="form-container">
    <img class="logo" src="trial.png" alt="Logo">
        <h1>BLOOD DONATION REQUEST</h1>
        <?php
        include 'connection.php';
        // Check if the 'id' parameter exists in the URL
        if (isset($_GET['id'])) {
            // Sanitize the input to prevent SQL injection
            $id = intval($_GET['id']); // Assuming 'id' is an integer in the database
            
            // Query to fetch the record based on the provided ID
            $query = "SELECT * FROM donator WHERE id = $id"; // Replace 'your_table' with your table name
            $result = $conn->query($query);

            // Check if the query executed successfully and fetched a record
            if ($result && $result->num_rows > 0) {
                // Fetch the data associated with the provided ID
                $row = $result->fetch_assoc();

                // Display the data in paragraphs
                echo "<p><strong>Name:</strong> " . $row['username'] . "</p>";
                echo "<p><strong>ID:</strong> " . $row['id'] . "</p>";
                echo "<p><strong>Blood Type:</strong> " . $row['blood_type'] . "</p>";
                
                echo "<p><strong>Status:</strong> ";
if ($row['status'] == 2) {
    echo "<span class='accepted-status'>Accepted</span>";
} elseif ($row['status'] == 3) {
    echo "<span class='rejected-status'>Rejected</span>";
} else {
    echo "<span class='pending-status'>Pending</span>";
}
echo "</p>";

            } else {
                echo "No record found for the provided ID.";
            }

            // Close the database connection when done
            $conn->close();
        } else {
            header('location: admin_login.php');
        }
        ?>
       <div class="print-btn-container">
        <button onclick="window.print()" class="btn">Print</button>
    </div>
    </div>
    
   
</body>
</html>
