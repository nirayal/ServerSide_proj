<?php
require_once("includes\init.php");
require_once("questions_define.php");
require_once("poll_first_page.php");
require_once("poll_second_page.php");
require_once("poll_third_page.php");

if (!$session->signed_in){
    header('Location: login.php');
    exit;
}

global $database;
$error = null;
// graph 1 section

$light_trans_not_safe = "select * from second_poll where QUES_25 = 'not_safe'";
$light_trans_mid_safe = "select * from second_poll where QUES_25 = 'mid_safe'";
$light_trans_very_safe = "select * from second_poll where QUES_25 = 'very_safe'";
$public_trans_not_safe = "select * from third_poll where QUES_34 = 'not_safe'";
$public_trans_mid_safe = "select * from third_poll where QUES_34 = 'mid_safe'";
$public_trans_very_safe = "select * from third_poll where QUES_34 = 'very_safe'";

global $database;
$error = null;

$sql = "select * from first_poll where ".$attribute." = '".$value."'";
$result = $database -> query($sql);
if(!$result)
    $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
elseif($result -> num_rows >0)
{
    $found_pull = $result ->fetch_assoc();
    $this -> instantation($found_pull);
}
else
    $error = "Can't find poll by this value";
return $error;


?>
