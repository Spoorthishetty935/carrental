
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="admin.css" type="text/css" rel="stylesheet">
</head>
<body>
    <form action="" method="post">
        <label for="new_username">New Username:</label>
        <input type="text" id="new_username" name="new_username"><br><br>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password"><br><br>
        <label for="ver_code">Verification Code:</label>
        <input type="text" id="ver_code" name="ver_code"><br><br>
        <button type="submit" name="submit">Save</button>
    </form>
    <?php
    // Connect to the database
    $conn = mysqli_connect("localhost", "root", "", "carrentalsystem");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['submit'])) {
        // Get form values
        $new_un = $_POST['new_username'];
        $new_ps = $_POST['new_password'];
        $ver_code = $_POST['ver_code'];

        // Correct verification code
        $org_ver_code = "632593";

        // Check if the form fields are not empty
        if (!empty($new_un) && !empty($new_ps) && !empty($ver_code)) {
            // Validate verification code
            if ($ver_code == $org_ver_code) {
                // Update existing values
                $sql = "UPDATE admin SET username='$new_un', password='$new_ps' WHERE vercode='$org_ver_code'";

                if (mysqli_query($conn, $sql)) {
                    echo "Values updated successfully!";
                } else {
                    echo "Error updating values: " . mysqli_error($conn);
                }
            } else {
                // If verification code is incorrect, show an error message
                echo "<script>alert('Invalid verification code. Please try again.');</script>";
            }
        } else {
            // If any form field is empty, show an error message
            echo "<script>alert('Please fill in all fields.');</script>";
        }
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>
</html>
