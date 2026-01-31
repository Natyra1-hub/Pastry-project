<?php
session_start();

if(isset($_SESSION['username'])){
   header("location:pastry.php");
   exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="loginpage.css">
</head>
<body>
    <div id="loginPage" class="login-page">
    <div class="login-container">

        <div class="login-image">
            <img src="homepage/52fff62a917d557c29429ee43f639ce2.jpg" alt="Login Image">
        </div>
  
        <div class="login-card">
            <h2>Login</h2>

            <form action="loginValidate.php" method="post" onsubmit="return validateLogin()">
            <input type="text" id="username" name="username" placeholder="Username" required> 
            <input type="password" id="password" name="password"  placeholder="Password" required>

            <p id="errorMsg">
                <?php
                 
                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']); 
                    }
                    ?>
            </p>

            <button type="submit" name="loginBtn">Login</button>
        </form>

            <div class="links">
                <a href="signuppage.php">Don't have an account? Sign up</a>
            </div>
        </div>
    </div>
</div>

<script src="loginpage.js"></script>
</body>
</html>