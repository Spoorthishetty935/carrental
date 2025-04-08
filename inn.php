<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="https://fontawesome.com/icons/whatsapp?f=brands&s=solid">
    
    <link rel="stylesheet" href="loginprg.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=mail" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=globe" />
</head>
<body>
    <div class="out" id="out1">
        <h1>Hello friend!</h1>
        <p id="parag">Please click on sign in , if you are already have an account.</p>
        
        <button id="btn4"> sign in</button>

    </div>
    <div class="outerbox" >
        <!-- <div class="inner1" style="display: none;">
            <h1>Hello friend!</h1>
            <p>Please click on sign up , if you are already have an account.</p>
            
            <button id="btn4">SIGN UP</button>
        </div> -->
        <div class="inner2" >
            <div class="signup" style="opacity: 1;">
             <form action="success.php" method="get">  

                <h1>Sign In</h1>
                <div class="icon">
                  <img src="github-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                  <img src="facebook-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                  <img src="linkedin-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                  <img src="twitter-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                </div>

                <p id="para">or use your email password</p>

                <input type="email" placeholder="Email" id="one" class="inputbox">
                <input type="password" placeholder="password" id="email" class="inputbox">
                <p id="para"><a href="#">Forget Your Password</a></p>
                <button id="btn3">SIGN IN</button>
           </form>
      </div>
















            <div class="createacc" >
                <form method="get" action="success.php">
                 <?php
                 
                 $conn = mysqli_connect("localhost", "root", "", "carrentalsystem");
                 // Check connection
 if (!$conn) {
     die("Connection failed: " );
 }

 if (isset($_POST['btn'])) {
     // Get form values
  
     $ps = $_POST['email'];
     $vc = $_POST['password'];
     $sql = "SELECT * FROM adm1 WHERE password='$vc'";
     $res=mysqli_query($conn,$sql);
     $a="";
     $b="";
   if($r=mysqli_fetch_assoc($res)){
           $a=$r[''];
   }


 }
 

                 ?>

                <h1>Create account</h1>
                <div class="icon">
                    <img src="github-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                  <img src="facebook-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                  <img src="linkedin-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                  <img src="twitter-brands-solid.svg" alt="" style="height: 80%; width: 70%;">
                </div>
                <p id="para2">or use your email for registeration </p>
                <input type="text" placeholder="Name" id="username"  class="inp">
                <input type="email" placeholder="Email" id="email" class="inp">
                <input type="password" placeholder="Password" id="password" class="inp">
                <input type="submit" id="btn" value="SIGN UP">
                </form>
            </div>
        </div>

    </div>
    <script src="index.js"></script>
</body>
</html>