<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="signuppage.css">
</head>
<body>
    <div id="signupPage" class="signup-page">
    <div class="signup-container">

        <div class="signup-image">
            <img src="homepage/52fff62a917d557c29429ee43f639ce2.jpg" alt="signup Image">
        </div>

        <div class="signup-card">
            <h2>Sign Up</h2>

            <form action="signupvalidate.php" method="post" onsubmit="return validateSignup()">
            <input type="email" id="email" name="email" placeholder="Email">
            <input type="text" id="username" name="username" placeholder="Username">
            <input type="date" id="dob" name="dob" placeholder="Date of Birth">
            <input type="password" id="password" name="password" placeholder="Password">

            <p id="errorMsg">
                <?php

                    if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>
            </p>

            <button type="submit" name="signupBtn">Sign Up</button>
        </form>

            <div class="links">
                <a href="loginpage.php">Already have an account? Login</a>
            </div>
        </div>
    </div>
</div>

<script src="signuppage.js"></script>
</body>
</html>