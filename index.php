<?php
require_once("includes\init.php");
include("navbar.htm");
require_once("includes\First_Poll.php");
require_once("includes\Second_Poll.php");
require_once("includes\\third_Poll.php");


if (!$session -> signed_in){
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
echo "<p>Hey there, <b>". $user_name ."</b>! You are logged in</p><hr>";

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
        <title>Transportaion Poll</title>
        <link rel="stylesheet" href="CSS/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="JS/general.js"></script>
    </head>
    <body onload="done_poll()">
        <header>
            <h2>This is the main page of the poll</h2>
            <p>you can follow "My Poll" in order to check your answers</p>
            <p>the poll contain 3 sections. in the end of every section you can stop and continue at all time.</p><br>
            <p> Your Progress Is : 
                <?php
                $firstProccess = $poll->first_poll_full_status();
                $secondProccess = $second_poll->second_poll_full_status();
                $thirdProccess = $third_poll->third_poll_full_status();
                if($firstProccess >= 1)
                    $firstProccess = 1;
                $precentageOfProcess = $firstProccess + $secondProccess + $thirdProccess;
                if ($precentageOfProcess >= 3)
                    echo "<b>100%</b>";
                else
                    echo "<b>".($precentageOfProcess / 3 * 100)."%</b>";                
                ?>
            of the poll.</p>
        </header>      


        <table>
            <!-- real -->
            <tr id="poll_real">  <td>  <p>Transportaion Poll :</p>  </td> <td>  <button><a class ="btnIndex" href="poll_first_page.php">Transportaion Poll</a></button>  </td>
            <!-- fake -->
            <tr id="poll_fake">  <td>  <p>Transportaion Poll :</p>  </td> <td>  <button><a class ="btnIndex" href="#">Transportaion Poll</a></button>  </td>
            <!-- real -->
            <tr id="statistics_real">  <td>  <p>Poll's Statistics : </p>  </td> <td>  <button><a class ="btnIndex" href="statistics.htm">Statistics</a></button>  </td>
            <!-- fake -->
            <tr id="statistics_fake">  <td>  <p>Poll's Statistics : </p>  </td> <td>  <button><a class ="btnIndex" href="#">Statistics</a></button>  </td>
        </table>
        
        <br><hr><br>
        
        <form>
            <h3>Final mode </h3>
            <div id = "final">
                <?php
                // echo ('nir1'.$poll->first_poll_is_final().'nir1<br>');
                // echo ($second_poll->second_poll_is_final().'nir2<br>');
                // echo ($third_poll->third_poll_is_final().'nir3<br>');
                if($poll->first_poll_is_final() == 'final' and $second_poll->second_poll_is_final() == "final" and $third_poll->third_poll_is_final() == "final")
                    echo "finito";
                ?>
            </div>
            <div id = "non-final">
            <p>press here if you done your poll<br>
            you will be able to see the statistics. but you wont be able to edit your poll again</p>
            <p><input type="submit" name = "poll_finish" value="Done"></p></div>
        </form>
        
        
             

    </body>
</html>