<?php
    require_once("includes\init.php");
    require_once("includes\Second_poll.php");
    require_once("includes\questions_define.php");
    include("navbar.htm");

    if (!$session->signed_in){
        header('Location: login.php');
        exit;
    }

    $error = null;
    if ($_GET){
        if ($_GET['q_22'] == 'null') {
            $error .= "Error:  Question 2 is must be answered.<br>"; }   

        if ($_GET['q_23'] == 'null') {
            $error .= "Error:  Question 3 is must be answered.<br>"; }
        else
            if($_GET['q_23'] == "yes")
                if( ! $_GET['q_231'])
                    $error .= "Error:  Question 3.1 is required if you choose Yes in question 3.<br>";    
                else {
                    $chars = str_split($_GET['q_231']);
                    foreach ($chars as $char){
                        if(! (ctype_alpha($char) || $char == " ")){
                            $error .= "Error:  Question 3.1 must contain only letters.<br>";
                            break;
                        }
                    }           
                }
        
        if ($_GET['q_24'] == 'null') {
            $error .= "Error:  Question 4 is required.<br>";    }

        if ($_GET['q_25'] == 'null') {
            $error .= "Error:  Question 5 is required.<br>";    }
        
        if(isset($error)){
            echo $error;
        }
        else{   
            $flagNewOBJ = false;
            if($second_poll->find_second_poll_by_attribute("user_name",$_SESSION["user_name"]) != null){ //null means that i have a poll and done insatntaion
                $second_poll = new Second_poll();
                $flagNewOBJ = true;
            }            
            $second_poll->user_name = $_SESSION['user_name'];
            $second_poll->QUES_21 = $_GET['q_21'];
            $second_poll->QUES_22 = $_GET['q_22'];
            $second_poll->QUES_23 = $_GET['q_23'];
            if($_GET['q_23'] == 'yes')
                $second_poll->QUES_231 = $_GET['q_231'];
            else
                $second_poll->QUES_231 = 'null';
            $second_poll->QUES_24 = $_GET['q_24'];
            $second_poll->QUES_25 = $_GET['q_25'];

            if($flagNewOBJ)
                $error = $second_poll->add_second_poll();
            else
                $error = $second_poll->update_second_poll();
            if(!$error){
                // echo ("poll has been added to the DB<br>");
                // echo("this is the object that has been added: ".$second_poll);                
                // $second_poll -> set_second_poll_final();
                header('Location: poll_third_page.php');
            }
            else 
                echo $error;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Transportaion poll
        </title>
        <link rel="stylesheet" href="CSS/style.css">
        <script src="JS/poll.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body onload ="updateText_q_23()">

        <form>
            <h2>Transportation Poll</h2>
            <a href="poll_first_page.php" class="previous pollpage">&#8249;</a>
            <a href="poll_third_page.php" class="next pollpage">&#8250;</a>
            <h3>Transportation Poll - part 2/3</h3>

            <p>1. How satisfied are you with the availability and reliability of public transportation in your area? 
                <input type="range" min ="1" max ="5" name="q_21">
            </p>
            
            <p>2. Have you noticed any improvements or declines in public transportation in your area in recent years? 
            <select name="q_22" id="q_22">
                <option value="null">Enter Value</option>    
                <option value="yes_I">Yes, Improvements.</option>
                <option value="yes_D">Yes, Declines</option>
                <option value="no">No</option>
            </select>
            </p>

            <p>3. do you think the collage should invest in public transportation?           
                <select name="q_23" id="q_23" onchange="updateText_q_23()">
                    <option value="null">Enter Value</option>    
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </p>
                
            <div id = "yes">
                <p><b>Answer choosen in previous question - Yes</b></p>
                <p>3.1. name one way that the collage should invest to inprove public transportation? <input type="text" maxlength="200" name="q_231"></p>
            </div>            
            
            <p>4. How do you think the cost of public transportation compares to the cost of owning and maintaining a personal vehicle? <input type="text" maxlength="200" name="q_24"></p>
            
            <p>5. How safe do you feel using public transportation?
            <select name="q_25" id="q_25">
                <option value="null">Enter Value</option>    
                <option value="not_safe">Not Safe</option>
                <option value="mid_safe">Adequately Safe</option>
                <option value="very_safe">Very Safe</option>
            </select>
            </p>

            <p><input type="submit" class = "submit"></p>
        </form>
     
    </body>
</html>
