<!DOCTYPE html>
<html>
<head>
    <title>Blood Donation Eligibility Test</title>
</head>
<body>

<h2>Blood Donation Eligibility Test</h2>

<form method="post">
    <label for="age">Enter your age:</label>
    <input type="number" id="age" name="age" required>
    <br><br>
    <input type="submit" name="submit" value="Check Eligibility">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $age = $_POST['age'];

    if ($age >= 18) {
        echo "<h3>You are eligible to donate blood.</h3>";
        generate_certificate();
    } else {
        echo "<h3>Sorry, you are not eligible to donate blood.</h3>";
    }
}

function generate_certificate() {
    // Code to generate and display the certificate
    echo "<h4>Certificate of Blood Donation Eligibility</h4>";
    echo "<p>This certifies that the holder is eligible to donate blood.</p>";
}
?>

</body>
</html>
