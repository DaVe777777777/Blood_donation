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
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <title>Update Donator Information</title>
    <link rel="icon" href="trial.png">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class="container">
        <h2 class="mt-4 mb-4">Update Donator Information</h2>
        <div class="row justify-content-center">
            <div class="col-md-6 border p-4">
                <?php
                include 'connection.php';

                // check if the form has been submitted
                if (isset($_POST['submit'])) {
                    // retrieve the form data
                    $id = $_POST['id'];
                    $blood_type = $_POST['blood_type'];
                    $age = $_POST['age'];
                    $weight = $_POST['weight'];
                    $unit = $_POST['unit'];
            
                    // construct the update query
                    $sql = "UPDATE donator SET blood_type='$blood_type', age='$age', weight='$weight', unit='$unit', status=1 WHERE id=$id";
            
                    // execute the query
                    if ($conn->query($sql) === TRUE) {
                        ?>
                        <script>
                            swal({
                                title: "Success!",
                                text: "Record has been updated.",
                                icon: "success",
                            }).then(function() {
                                window.location = "request.php";
                            });
                        </script>
                        <?php
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
            
                    // close the database connection
                    $conn->close();
                } else {
                    // retrieve the id from the URL
                    $id = $_GET['id'];
            
                    // construct the select query
                    $sql = "SELECT * FROM donator WHERE id=$id";
            
                    // execute the query
                    $result = $conn->query($sql);
            
                    // retrieve the data from the query result
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $selectedBloodType = $row['blood_type'];
                        $age = $row['age'];
                        $weight = $row['weight'];
                        $unit = $row['unit'];
                    } else {
                        echo "No record found";
                    }
            

                ?>
            <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
            <label for="blood_type">Blood Type:</label>
        <select id="blood_type" class="form-control" name="blood_type">
            <option value="<?php echo $selectedBloodType; ?>"><?php echo $selectedBloodType; ?> </option>
                    <option>A</option>
                    <option>B</option>
                    <option>AB</option>
                    <option>O</option>
                    <option>A+</option>
                    <option>B+</option>
                    <option>AB+</option>
                    <option>O+</option>
                    <option>A-</option>
                    <option>B-</option>
                    <option>AB-</option>
                    <option>O-</option>
                </select>
            </div>

            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>">
            </div>

            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $weight; ?>">
            </div>

            <div class="form-group">
                <label for="unit">No of Units:</label>
                <input type="number" class="form-control" id="unit" name="unit" value="<?php echo $unit; ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Update</button>
            <a href="request.php" class="btn btn-danger">Cancel</a>
        </form>
        <?php
// close the database connection
$conn->close();
}
?>

        

<style>
        body {
            padding-top: 50px;
            text-align: center;
        }
    </style>
</body>
</html>
