<?php
    require_once('includes/init.php');
    global $session;
    $info='';
    if(isset($_POST['submit'])){
        if (!$_POST['user_name']){
            $info = 'User name is required';
        }
        else if(!$_POST['password']){
            $info = 'Password is required';
        }
        else{
            $username = $_POST['user_name'];
            $password = $_POST['password'];
            $user = new User();
            $error = $user -> find_user_by_username_pass($name , $password);
            if (!$error){
                $info = 'User Details:<br>User Name: ' . $user->user_name . "<br>Name: " . $user->full_name;
                // $session -> login($user);
                // header('Location: index.php');
            }
            else
                echo ("username or password are not correct.");
        }
    }
?>
