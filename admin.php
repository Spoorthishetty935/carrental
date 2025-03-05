

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="admin.css"type="text/css" rel="stylesheet">
</head>

<body>
<div class="nav">
        <a href="vehicle.php">HOME</a>
        <a href="admin.php">ADMIN</a>
        <a href="#">ADD</a>
        <a href="#about">ABOUT</a>
    </div>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>

    <label for="vercode">Verification Code:</label>
    <input type="text" id="vercode" name="vercode"><br><br>

    <button type="submit" name="submit">Login</button>
</form>






<?php if (isset($_POST['submit'])) { 
    // Get form values 
    $un = $_POST['username']; 
    $ps = $_POST['password']; 
    $vc = $_POST['vercode']; 
  
    // Correct credentials 
    $orgun = "Admin12345"; 
    $orgps = "car@sss"; 
    $orgvercode = "632593"; 
  
    // Check if the form fields are not empty 
    if (!empty($un) && !empty($ps) && !empty($vc)) { 
      // Validate credentials 
      if ($un == $orgun && $ps == $orgps && $vc == $orgvercode) { 
        // Success message 
        echo "<script>alert('Login successful! Welcome, $un.');</script>"; 
        // Optionally, redirect after displaying success message (uncomment to enable redirection): 
        // header("Location: success.php"); 
 // Optionally, redirect after displaying success message (uncomment to enable redirection): 
      // header("Location: success.php"); 
     //  exit(); 
      // Stop further script execution after header 
      header("Location: success.php"); 
      // Change 'success.php' to your desired page 
      exit(); 
    } else { 
      // If credentials are incorrect, show an error message 
      echo "<script>alert('Invalid credentials. Please try again.');</script>"; 
    } 
  } else { 
    // If any form field is empty, show an error message 
    echo "<script>alert('Please fill in all fields.');</script>"; 
  } 
} 
  
?>

</body>
</html>
