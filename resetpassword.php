
<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "cars";

$con = new mysqli($hostname, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $old_password = $_POST["old_password"];
    $new_password = $_POST["new_password"];
    $confirm_password = $_POST["confirm_password"];
 if ($new_password !== $confirm_password) {
    echo "<script>alert('New password does not match confirm password: " . $con->connect_error . "');</script>";
    exit;
}

$query = "SELECT * FROM cars WHERE useremail = '$email' AND password = '$old_password'";
$res = $con->query($query);

if ($res->num_rows > 0) {
    $update_query = "UPDATE cars SET password = '$new_password' WHERE useremail = '$email'";
    if ($con->query($update_query) === TRUE) {
        echo "<script>alert('Password updated successfully.');</script>";

    } else {
        echo "<script>alert('Error updating password: " . $con->error . "');</script>";

    }
} else {
    echo "<script>alert('Invalid email or old password.');</script>";

}
}

$con->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password </title>
    <link rel="stylesheet" href="resetstyle.css">
</head>
<body>
    <div class="reset-container">
        <h2>Reset Your Password</h2>
        <form action="" method="POST">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="old_password">Old Password</label>
            <input type="password" id="old_password" name="old_password" required>
            
            <label for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
