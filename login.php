<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = mysqli_connect("localhost", "root", "", "carrentalsystem");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login'])) {
    $loginAs = $_POST["login_as"];

    if ($loginAs == "admin") {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        $sql = "SELECT * FROM adm1 WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($password === $row["password"]) {
                $_SESSION['admin'] = $email;
                echo "<script>alert('Admin login successful!'); window.location='admin_dashboard.php';</script>";
                exit;
            } else {
                echo "<script>alert('Incorrect password! Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Admin not found! Check your email.');</script>";
        }
    } 
    else {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if ($password === $row["password"]) {
                $_SESSION['user'] = $username;
                echo "<script>alert('User login successful!'); window.location='user_dashboard.php';</script>";
                exit;
            } else {
                echo "<script>alert('Incorrect password! Please try again.');</script>";
            }
        } else {
            // Register user automatically if not found
            $insert_sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_sql);
            mysqli_stmt_bind_param($insert_stmt, "ss", $username, $password);

            if (mysqli_stmt_execute($insert_stmt)) {
                $_SESSION['user'] = $username;
                echo "<script>alert('User registered and logged in successfully!'); window.location='user_dashboard.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error creating account! Please try again.');</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Login Page</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Login as:</label>
        <input type="radio" name="login_as" value="admin" checked> Admin
        <input type="radio" name="login_as" value="user"> User
        <br><br>
        
        <div id="admin_login">
            <label>Email:</label>
            <input type="email" name="email"><br><br>
            <label>Password:</label>
            <input type="password" name="password"><br><br>
            <a href="k.php">Forgot password?</a>
        </div>

        <div id="user_login" style="display:none;">
            <label>Username:</label>
            <input type="text" name="username"><br><br>
            <label>Password:</label>
            <input type="password" name="password"><br><br>
            <a href="register.php">Register here</a>
        </div>

        <input type="submit" value="Login" name="login">
    </form>

    <script>
        var loginAs = document.getElementsByName('login_as');
        var userLogin = document.getElementById('user_login');
        var adminLogin = document.getElementById('admin_login');

        loginAs.forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.value === "admin") {
                    userLogin.style.display = 'none';
                    adminLogin.style.display = 'block';
                } else {
                    userLogin.style.display = 'block';
                    adminLogin.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
