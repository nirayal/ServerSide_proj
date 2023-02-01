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
echo "<p>Hey there <b>". $user_name ."</b>! You are logged in</p><hr>";

if($_GET)
    if($_GET["poll_finish"] == "Done"){        
        $poll->set_first_poll_final();
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
            <p>the poll contain 3 sections. in the end of every one of them you can stop and continue all time</p>
            <p> until now you have done: 
                <?php
                $precentageOfProcess = $poll->first_poll_full_status() + $second_poll->second_poll_full_status() + $third_poll->third_poll_full_status();
                if ($precentageOfProcess == 3)
                    echo "<b>100%</b>";
                elseif ($precentageOfProcess == 2)
                    echo "<b>66.6%</b>";
                elseif ($precentageOfProcess == 1)
                    echo "<b>33.3%</b>";
                else
                    echo "<b>0%</b>";
                ?>
            of the poll.</p>
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