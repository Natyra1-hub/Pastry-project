<?php
include_once 'users.php';

if(isset($_POST['loginBtn'])){
    if(empty($_POST['username']) || empty($_POST['password'])){
        echo "Please fill all fields!";
    }else{
        $username = $_POST['username'];
        $password = $_POST['password'];

        $i=0;
        foreach($users as $user){
            $i++;
            if($username == $user['username'] && $password == $user['password']){

               session_start();

               $_SESSION['username']=$username;
               $_SESSION['password'] = $password;
               $_SESSION['role'] = $user['role'];

               header("location:pastry.php");
                exit();

            }else{
                if($i == sizeOf($users)){
                    echo "Username or Password is incorrect!";
                    exit();
                }
                
            }
        }


    }
}


?>