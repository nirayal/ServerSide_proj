<?php
require_once("includes\init.php");
include("navbar.htm");
if (!$session->signed_in){
    header('Location: login.php');
    exit;
}
$user_name = $_SESSION['user_name'];
// echo $user_name;
echo "<p>hello ". $user_name ." You are logged in</p>";


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Nir Ayal, Tomer Ben Ami, Lior Sendik</title>
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
        <header>
            <h2>this is the main page of the poll</h2>
            <p>you can see your answers at all time</p>
            <p>the poll caontain 3 section. in the end of every one of them you can stop and continue all time</p>
        </header>
        <div id = "info"></div>
        
        


        <p>To the Transportaion Poll : <button><a href="poll_first_page.php">Transportaion Poll</a></button></p>
        <p>To the Poll Statistics : <button><a href="#">Statistics</a></button></p>
        
        <br><hr><br>
        
        <form action="">
            <h3>Final mode </h3>
            <p>press here if you done your poll<br>
            you will be able to see the statistics.</p>
            <!-- java script for seeing the statistics -->            
            <p><input type="submit"></p>
        </form>
        
        
             

    </body>
</html>