<?php
require_once("includes\init.php");
$error = null;
if ($_POST) {
    if (!$_POST['user_name'])
        $error .= "Error:  User Name is required for Log-in.<br>";
    else {
        $chars = str_split($_POST['user_name']);
        foreach ($chars as $char) {
            if (!ctype_alpha($char) && !is_numeric($char)) {
                $error .= "Error:  User Name must contain only letters.<br>";
                break;
            }
        }
    }
    if (!$_POST['password'])
        $error .= "Error:  Password is required for Log-in.<br>";
    if (!$error){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $user = new User($user_name,$password);
        $error = $user->find_user_by_username_pass($user_name, $password);
    }
    if (!$error) {
        $session->login($user);
        session_status();
        $_SESSION['user_name'] = $user_name;
        header('Location: index.php');
    }

 
}
?> 
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/login_sign_up.css">

  </head>
  <body>
    <form class="modal-content animate" action="" method="post">
        <div class="container">
            <h1>Log In</h1>
            <p>Please fill in this form to Enter the system.</p>
            <hr>
            <!-- user name -->
            <label for = "user_name"><b>User Name</b></label>
            <input id = "user_name" type = "text" placeholder = "Enter Username" name = "user_name" required>
            <!-- Password -->
            <label for = "password"><b>Password</b></label>
            <input id = "password" type = "password" placeholder="Enter Password" name="password" required>
            <?php
                if (isset($error))
                    echo "<p>".$error."</p>";
            ?>
            <hr>
            <div class="clearfix">
                <!-- <button type = "button" class = "cancelbtn">Cancel</button> -->
                <button type = "submit" class = "loginbtn buttonSignUP">Login</button>
            </div>
            <p>Don't have an account? <a href="sign_up.htm" class = "nodesign"><b>press here to register</b></a>.</p>

        </div>
    </form>
  </body>
</html>