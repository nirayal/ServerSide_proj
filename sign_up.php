<?php
require_once("includes/init.php");

$urlContents = file_get_contents("php://input");
$urlarray = json_decode($urlContents, true);

$error_data = array("code" => 0, 'response' => array());
$success_data = array();

if (User::usernameExist($urlarray['user_name'])) //if func return True - means that there is a user name in that name
    $error_data["response"]["add_error"] = "User Name is Occupied";

if(!$urlarray['user_name']){
    $error_data["response"]["error_username"] = "Error: User Name is required for sign-up.";
}
else{
    $chars = str_split($urlarray['user_name']);
    foreach ($chars as $char) {
        if (!ctype_alpha($char) && !is_numeric($char)) {
            $error_data["response"]["error_username"] = "Error: User Name must contain only letters and numbers.";
            break;
        }
    }
}
if (!$urlarray['full_name'])
$error_data["response"]["error_fullname"] = "Error: full name is required.";
else {
    $chars = str_split($urlarray['full_name']);
    foreach ($chars as $char) {
        if (!ctype_alpha($char) && $char != " ") {
            $error_data["response"]["error_fullname"] = "Error: Full Name must contain only letters.";
            break;
        }
    }
}
// password validation
if (!$urlarray['password'])
    $error_data["response"]["error_password"] = "Error: Password is required for sign-up.";
else {
    if (strlen($urlarray['password']) < 8)
        $error_data["response"]["error_password"] = "Error: Password must be at least 8 chars for sign-up.";    
    if (!preg_match("#[0-9]+#", $urlarray['password']))
        $error_data["response"]["error_password"] = "Error: Password Must Contain At Least 1 Digit.";
    if (!preg_match("#[A-Z]+#", $urlarray['password']))
        $error_data["response"]["error_password"] = "Error: Password Must Contain At Least 1 Capital Letter!";
    if (!preg_match("#[a-z]+#", $urlarray['password']))
        $error_data["response"]["error_password"] = "Error: Password Must Contain At Least 1 Lower Letter!";
}
if (!$urlarray['password-repeat'])
    $error_data["response"]["error_password_reapet"] = "Error: Password Repeat is required for sign-up";
else if ($urlarray['password'] != $urlarray['password-repeat'])
    $error_data["response"]["error_password_reapet"] = "Error: The two Passwords are not the same.";

// phone number validation
if (!$urlarray['phone_num'])
    $error_data["response"]["error_phone"] = "Error: Phone number is required.";
elseif (!preg_match('/^[0-9]{10}+$/', $urlarray['phone_num']))    
    $error_data["response"]["error_phone"] = "Error:  Only get digits in phone number.";

// email validation
if (!$urlarray['email'])
    $error_data["response"]["error_email"] = "Error:  e-mail is required.";
elseif (!filter_var($urlarray['email'], FILTER_VALIDATE_EMAIL))
    $error_data["response"]["error_email"] = "Error:  Only get valid e-mail.";
    
// birth-day validation
if (!$urlarray['birth_day'])
    $error_data["response"]["error_birth_day"] = "Error: Birth-date is required.";
elseif (!filter_var($urlarray['birth_day'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/"))))
    $error_data["response"]["error_birth_day"] = "Error: Birth-date is not valid.";

if(sizeof($error_data["response"]) == 0){
    $error = User::add_user($urlarray["user_name"], $urlarray["full_name"], $urlarray["password"], $urlarray["phone_num"], $urlarray["email"], $urlarray["birth_day"]);
    if (!$error){
        // echo ("user has been added to the DATABASE");
        $success_data["response"] = 'user has been added successfully to the DATABASE';
        // header('Location: index.php');
    }
    else
        $error_data["response"]["add_error"] = "User hasn't been added to DB";
}

$response_data = array("error" => $error_data, "success" => $success_data);
$response_data = json_encode($response_data);
echo $response_data;
?>
