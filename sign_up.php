<?php
require_once("includes/init.php");

$info = "";
$urlContents = file_get_contents("sign_up.php");
$urlarray = json_decode($urlContents, true);

if(!$urlarray['user_name']){
    $post_data = array('code' => 0, 'massage' => 'Error:  User Name is required for sign-up.');
    $info = json_encode($post_data);
}
else{
    $chars = str_split($urlarray['user_name']);
    foreach ($chars as $char) {
        if (!ctype_alpha($char) && !is_numeric($char)) {
            $post_data = array('code' => 0, 'massage' => 'User Name must contain only letters and numbers.');
            break;
        }
    }
}
if (!$urlarray['full_name'])
    $post_data = array('code' => 0, 'massage' => 'Error:  full name is required.');
else {
    $chars = str_split($urlarray['full_name']);
    foreach ($chars as $char) {
        if (!ctype_alpha($char) && $char != " ") {
            $post_data = array('code' => 0, 'massage' => 'Error:  Full Name must contain only letters.');
            break;
        }
    }
}
// password validation
if (!$urlarray['password'])
    $post_data = array('code' => 0, 'massage' => 'Error:  Password is required for sign-up.');
else {
    if (strlen($urlarray['password']) < 8)
        $post_data = array('code' => 0, 'massage' => 'Error:  Password must be at least 8 chars for sign-up.');
    if (!preg_match("#[0-9]+#", $urlarray['password']))
        $post_data = array('code' => 0, 'massage' => 'Error:  Password Must Contain At Least 1 Digit.');
    if (!preg_match("#[A-Z]+#", $urlarray['password']))
        $post_data = array('code' => 0, 'massage' => 'Error:  Password Must Contain At Least 1 Capital Letter!.');
    if (!preg_match("#[a-z]+#", $urlarray['password']))
        $post_data = array('code' => 0, 'massage' => 'Error:  Password Must Contain At Least 1 Lower Letter!.');
}
if (!$urlarray['password-repeat'])
    $post_data = array('code' => 0, 'massage' => 'Error:  Password Repeat is required for sign-up.');
else {
    if ($urlarray['password'] != $_POST['password-repeat'])
        $post_data = array('code' => 0, 'massage' => 'Error:  The two Passwords are not the same.');
}
// phone number validation
if (!$urlarray['phone'])
    $post_data = array('code' => 0, 'massage' => 'Error:  phone number is required.');
elseif (!preg_match('/^[0-9]{10}+$/', $urlarray['phone']))    
    $post_data = array('code' => 0, 'massage' => 'Error:  Only get digits in phone number.');

// email validation
if (!$urlarray['email'])
    $post_data = array('code' => 0, 'massage' => 'Error:  e-mail is required.');
elseif (!filter_var($urlarray['email'], FILTER_VALIDATE_EMAIL))
    $post_data = array('code' => 0, 'massage' => 'Error:  Only get valid E-Mail.');

// birth-day validation
if (!$urlarray['birth_day'])
    $post_data = array('code' => 0, 'massage' => 'Error:  Birth-date is required.');
elseif (!filter_var($urlarray['birth_day'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"))))
    $post_data = array('code' => 0, 'massage' => 'Error:  Birth-date is not valid.');

if(!$info){
    $user = new User();
    $error = $user->add_user();
    if (!$error){
        // echo ("user has been added to the DATABASE");
        $post_data = array('code' => 1, 'massage' => 'user has been added successfully to the DATABASE');
        // header('Location: index.php');
    }
    else
        $post_data = array('code' => 0, 'massage' => $error);
}
$info = json_encode($post_data);
echo $info;
?>