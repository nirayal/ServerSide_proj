<?php
    require_once('includes/init.php');
    global $session;

    $error='';
    if(isset($_POST['submit'])){
        if (!$_POST['name']){
            $error='User is required';
        }
        else if(!$_POST['password']){
            $error = 'Password is required';
        }
        else{
            
            $name=$_POST['name'];
            $password=$_POST['password'];
            $user = new User();
            $error = $user -> find_user_by_username_pass($name,$password);
            if (!$error){
                $session -> login($user);
                header('Location: index.php');
            }
        }
    }
?>
