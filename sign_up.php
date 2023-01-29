<?php
require_once("includes/init.php");
$error = null;
if ($_POST) {
    // user name validation
    if (!$_POST['user_name'])
        $error .= "Error:  User Name is required for sign-up.<br>";
    else {
        $chars = str_split($_POST['user_name']);
        foreach ($chars as $char) {
            if (!ctype_alpha($char) && !is_numeric($char)) {
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
        foreach ($chars as $char) {
            if (!ctype_alpha($char) && $char != " ") {
                $error .= "Error:  Full Name must contain only letters.<br>";
                break;
            }
        }
    }
    // password validation
    if (!$_POST['password'])
        $error .= "Error:  Password is required for sign-up.<br>";
    else {
        if (strlen($_POST['password']) < 8)
            $error .= "Error:  Password must be at least 8 chars for sign-up.<br>";
        if (!preg_match("#[0-9]+#", $_POST['password']))
            $error .= "Error: Password Must Contain At Least 1 Digit.<br>";
        if (!preg_match("#[A-Z]+#", $_POST['password']))
            $error = "Password Must Contain At Least 1 Capital Letter!.<br>";
        if (!preg_match("#[a-z]+#", $_POST['password']))
            $error = "Password Must Contain At Least 1 Lower Letter!.<br>";
    }
    if (!$_POST['password-repeat'])
        $error .= "Error:  Password Repeat is required for sign-up.<br>";
    else {
        if ($_POST['password'] != $_POST['password-repeat'])
            $error .= "Error:  The two Passwords are not the same.<br>";
    }
    // phone number validation
    if (!$_POST['phone'])
        $error .= "Error:  phone number is required.<br>";
    elseif (!preg_match('/^[0-9]{10}+$/', $_POST['phone']))
        $error .= "Error:  Only get digits in phone number.<br>";

    // email validation
    if (!$_POST['email'])
        $error .= "Error:  e-mail is required.<br>";
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $error .= "Error:  Only get valid E-Mail.<br>";

    // birth-day validation
    if (!$_POST['birth_day'])
        $error .= "Error:  Birth-date is required.<br>";
    elseif (!filter_var($_POST['birth_day'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"))))
        $error .= "Error:  Birth-date is not valid.<br>";

    // print_r($_POST);

    if (!$error) {
        $user = new User($_POST);
        $error = $user->add_user();
        if (!$error)
            // echo ("user has been added to the DATABASE");
            header('Location: index.php');
        else
            echo $error;
    } else {
        echo $error;
    }
}
else
    echo ("Error : Information could not rertive.");
?>