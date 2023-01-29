<?php
require_once("includes\init.php");
include("navbar.htm");
require_once("First_Poll.php");
require_once("Second_Poll.php");
require_once("third_Poll.php");


if (!$session -> signed_in){
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
echo "<p>Hey there ". $user_name ."! You are logged in</p><hr>";

if($_GET)
    if($_GET["poll_finish"] == "Done"){
        $first_poll->set_first_poll_final();
        $second_poll->set_second_poll_final();
        $third_poll->set_third_poll_final();
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nir Ayal, Tomer Ben Ami, Lior Sendik</title>
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <header>
            <h2>This is the main page of the poll</h2>
            <p>you can see your answers at all time</p>
            <p>the poll caontain 3 section. in the end of every one of them you can stop and continue all time</p>
        </header>      


        <p>To the Transportaion Poll : <button><a href="poll_first_page.php">Transportaion Poll</a></button></p>
        <p>To the Poll Statistics : <button><a href="#">Statistics</a></button></p>
        
        <br><hr><br>
        
        <form>
            <h3>Final mode </h3>
            <p>press here if you done your poll<br>
            you will be able to see the statistics.</p>
            <!-- java script for seeing the statistics -->            
            <p><input type="submit" name = "poll_finish" value="Done"></p>
        </form>
        
        
             

    </body>
</html>