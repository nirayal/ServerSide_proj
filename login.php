<!DOCTYPE html>
<html>
    <head>
        <title>
            log-in interface
        </title>
    </head>
    <body>
        <form action = "login.php" method = "post">
            <fieldset>
                <legend>LOG-IN</legend>
                <p><lable>User ID : <input type = "text" name = "user_id"></lable></p>
                <p><lable>Password : <input type = "text" name = "password"></lable></p>
                <p><input type = "submit" name = "nsubmit" value = "submit"></p>
            </fieldset>
        </form>
        <?php
        require_once("..\includes\init.php");
        $error = " ";

        if(isset($_POST['user_id']))
            $error .= "no user id was entered";
        if(isset($_POST['password']))
            $error .= "no password was entered";
        
        $id = $_POST['user_id'];
        $password = $_POST['password'];
        $user = new User();
        $error = $user -> find_user_by_id_and_password($_POST['user_id'],);
        if(isset($error))
        {
            $user -> id = $_POST['user_id'];
            $user -> password = $_POST['password'];
            $session = new Session();
            $session -> login($user);
        }
        else
            echo $error;

        
        ?>
    </body>
</html>