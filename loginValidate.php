<?php
session_start();
require_once __DIR__ . "/database.php";

$db = new Database();
$conn = $db->getConnection();

if(isset($_POST['loginBtn'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        echo "Please fill all fields!";
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        if(password_verify($password, $user['PASSWORD'])){
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            if($user['role'] === "admin"){
                header("Location: dashboard.php");
            } else {
                header("Location: pastry.php");
            }
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Username not found!";
    }
}