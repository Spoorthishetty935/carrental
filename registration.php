


<?php
// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'carrentalsystem';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Register user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm_password"];
  $mobile_no = $_POST["mobile_no"];
  $email_address = $_POST["email_address"];
  $address = $_POST["address"];

  // Check if passwords match
  if ($password != $confirm_password) {
    echo "<script>alert('Passwords do not match!');</script>";
  } else {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO registration (username, password, mobile_no, email_address, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $password, $mobile_no, $email_address, $address);

    if ($stmt->execute()) {
      echo "<script>alert('Registration successful!');</script>";
    } else {
      echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <h2>Registration Form</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    <label>Password:</label>
    <input type="password" name="password" required><br><br>
    <label>Confirm Password:</label>
    <input type="password" name="confirm_password" required><br><br>
    <label>Mobile No:</label>
    <input type="text" name="mobile_no" required maxlength="10"><br><br>
    <label>Email Address:</label>
    <input type="email" name="email_address" required><br><br>
    <label>Address:</label>
    <textarea name="address" required></textarea><br><br>
    <input type="submit" value="Register" name="register">
    <?php if (isset($_POST['register'])) {
      if ($password != $confirm_password) {
        echo "<p class='error'>Passwords do not match!</p>";
      }
    }
    
    ?>
  </form>

</body>
</html>


