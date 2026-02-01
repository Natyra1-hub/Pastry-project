<?php
session_start();
require_once __DIR__ . "/database.php";

$db = new Database();
$conn = $db->getConnection();

if(isset($_POST['signupBtn'])){
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $dob = trim($_POST['dob']);
    $password = trim($_POST['password']);


    if(empty($email) || empty($username) || empty($dob) || empty($password)){
        $_SESSION['error'] = "Please fill all fields!";
        header("Location: signuppage.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email LIMIT 1");
    $stmt->execute(['username' => $username, 'email' => $email]);
    $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

    if($userExists){

        $_SESSION['error'] = "Username or Email already exists!";
        header("Location: signuppage.php");
        exit;
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, email, dob, PASSWORD, role) VALUES (:username, :email, :dob, :password, 'user')");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'dob' => $dob,
        'password' => $hashed_password
    ]);


    $_SESSION['success'] = "Account created successfully! Redirecting to homepage...";


    header("refresh:2;url=pastry.php");
    exit;
}
?>