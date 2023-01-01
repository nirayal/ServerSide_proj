<?php
require_once("..\inclouds\init.php");
$error = null;
if(!$_POST)
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
                $error .= "Error:  Full Name must contain only letters.<br>";
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
            if(!ctype_alpha($char)){
                $error .= "Error:  Full Name must contain only letters.<br>";
                break;
            }
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
            $passwordErr = "Password Must Contain At Least 1 Lowercase Letter!";
    }
    if(!$_POST['password-repeat'])
        $error .= "Error:  Password Repeat is required for sign-up.<br>";
    else
    {
    if($_POST['password'] != $_POST['password-repeat'])
        $error .= "Error:  The two Passwords are not the same.<br>";
    }    
    // phone number validation
    if (!$_POST['phone_number']) 
        $error .= "Error:  phone number is required.<br>";
    elseif (! preg_match('/^[0-9]{10}+$/', $_GET['phone_number']))
        $error .= "Error:  Only get digits in phone number.<br>";
    // email validation
    if (!$_POST['e_mail'])
        $error .= "Error:  e-mail is required.<br>";
    elseif (! filter_var($_GET['e_mail'],FILTER_VALIDATE_EMAIL))
        $error .= "Error:  Only get valid E-Mail.<br>";
    // birth-day validation
    if(!$_POST['birth_date'])
        $error .= "Error:  Birth-date is required.<br>";
    elseif (!filter_var($birthdate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=>"/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"))))
        $error .= "Error:  Birth-date is not valid.<br>";
    
    if(isset($error))
        echo $error;
    else
    {
        $user = new User();
        $error = $user -> add_user();
        if(isset($error))
            echo $error;
        else
            echo ("user has been added to the DATABASE");
    }
}
else
    $error .= "Error : information could not rertive.";
?>