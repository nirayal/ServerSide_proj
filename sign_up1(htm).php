<?php
require_once("includes/init.php");
$error = null;
if($_POST)
{
// user name validation
    if(!$_POST['user_name'])
        $error .= "Error:  User Name is required for sign-up.<br>";
    else
    {
        $chars = str_split($_POST['user_name']);
        foreach($chars as $char)  
        {
            if(!ctype_alpha($char) || !is_numeric($char))
            {
                $error .= "Error:  User Name must contain only letters and numbers.<br>";
                break;
            }
        }  
    }
    // full name validation
    if (!$_POST['full_name']) 
        $error .= "Error:  full name is required.<br>";
    else {
        $chars = str_split($_POST['full_name']);
        foreach ($chars as $char)
        {
            if(!ctype_alpha($char) || $char == " ")
                $error .= "Error:  Full Name must contain only letters.<br>";
                break;
            }
        }            
    // password validation
    if(!$_POST['password'])
        $error .= "Error:  Password is required for sign-up.<br>";
    else
    {
        if(strlen($_POST['password']) < 8)
            $error .= "Error:  Password must be at east 8 chars for sign-up.<br>";
        if(!preg_match("#[0-9]+#",$_POST['password']))
            $error .= "Error: Password Must Contain At Least 1 Digit";
        if(!preg_match("#[A-Z]+#",$_POST['password']))
            $error = "Password Must Contain At Least 1 Capital Letter!";
        if(!preg_match("#[a-z]+#",$_POST['password']))
            $error = "Password Must Contain At Least 1 Lowercase Letter!";
    }
    if(!$_POST['password-repeat'])
        $error .= "Error:  Password Repeat is required for sign-up.<br>";
    else
    {
    if($_POST['password'] != $_POST['password-repeat'])
        $error .= "Error:  The two Passwords are not the same.<br>";
    }    
    // phone number validation
    if (!$_POST['phone']) 
        $error .= "Error:  phone number is required.<br>";
    elseif (! preg_match('/^[0-9]{10}+$/', $_GET['phone']))
        $error .= "Error:  Only get digits in phone number.<br>";
    // email validation
    if (!$_POST['email'])
        $error .= "Error:  e-mail is required.<br>";
    elseif (! filter_var($_GET['email'],FILTER_VALIDATE_EMAIL))
        $error .= "Error:  Only get valid E-Mail.<br>";
    // birth-day validation
    if(!$_POST['birth_day'])
        $error .= "Error:  Birth-date is required.<br>";
    elseif (!filter_var($_POST['birth_day'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>"/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"))))
        $error .= "Error:  Birth-date is not valid.<br>";
    print_r("im POST array<br>" . $_POST . "<br>");
    if(!$error){
        echo ("hello sun");
        $user = new User();
        $error = $user -> add_user();
        if(!$error)
            // echo ("user has been added to the DATABASE");    
            header('Location: sign_up.php');
        else
            echo $error;
    }
    else{
        echo $error;
        // print_r($_POST);
    }
}
else
    $error .= "Error : Information could not rertive.";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Project - user sign-up</title>
        <link rel="stylesheet" href="sign_up.css">
    </head>
<body>
    <button onclick = "document.getElementById('sign_up01').style.display='block'" style = "width:auto;">Sign Up</button>
    <div id = "sign_up01" class = "modal">
    <span onclick = "document.getElementById('sign_up01').style.display='none'" class = "close" title = "Close Modal">&times;</span>
    <form class = "modal-content" method = "post">
        <div class = "container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an User.</p>
        <hr>
        <!-- user name sing up -->
        <label for = "user_name"><b>User Name</b></label>
        <input type = "text" placeholder = "Enter User Name" name = "user_name" required>
        <!-- full name sign up -->
        <label for = "full_name"><b>Full Name</b></label>
        <input type = "text" placeholder = "Enter Full Name" name = "full_name" required>
        <!-- password and re password sign up -->
        <label for = "password"><b>Password</b></label>
        <input type = "password" placeholder = "Enter Password" name = "password" required>

        <label for = "password-repeat"><b>Repeat Password</b></label>
        <input type = "password" placeholder = "Repeat Password" name = "password-repeat" required>
        <!-- email sign up -->
        <label for = "email"><b>Email</b></label>
        <input type = "text" placeholder = "Enter Email" name = "email" required>
        
        <label for = "phone"><b>Phone Number</b></label>
        <input type = "tel" placeholder = "Enter Phone Number" name = "phone" required><br>
        <!-- birth-day sign up -->

        <label for = "birth_day"><b>Birth Day</b></label>
        <input type = "date" placeholder = "enter birth day" name = "birth_day" required>

        <div class="clearfix">
            <button type = "button" onclick = "document.getElementById('sign_up01').style.display='none'" class = "cancelbtn">Cancel</button>
            <button type = "submit" class = "signupbtn">Sign Up</button>
        </div>
    </form>
    </div>

    <script>
    // Get the modal
    var modal = document.getElementById('sign_up01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
    if (event.target == modal) 
    {
        modal.style.display = "none";
    }
    }
    </script>

</body>
</html>