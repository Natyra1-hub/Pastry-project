<?php
session_start();
include_once 'users.php';

if(isset($_POST['signupBtn'])){
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $dob = trim($_POST['dob']);
    $password = trim($_POST['password']);

    if(empty($email) || empty($username) || empty($dob) || empty($password)){
        $_SESSION['error'] = "Please fill all fields!";
        header("Location: signuppage.php");
        exit();
    }

    foreach($users as $user){
        if($user['username'] === $username || $user['email'] === $email){
            $_SESSION['error'] = "Username or email already exists!";
            header("Location: signuppage.php");
            exit();
        }
    }

    $_SESSION['success'] = "Sign up successful! You can now log in.";
    header("Location: loginpage.php");
    exit();
}
?>