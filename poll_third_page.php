<?php
    require_once("includes\init.php");
    require_once("third_Poll.php");
    require_once("questions_define.php");

    $error = null;
    if ($_GET){
        if($_GET['q_31'] == 'null')
            $error .= "Error:  Question 1 is required.<br>";

        if ($_GET['q_32'] == 'null') {
            $error .= "Error:  Question 2 is required.<br>";    }
        else{
            if (($_GET['q_32'] == "yes") && ( ! $_GET['q_321'])) {
                $error .= "Error:  Question 2.1 is required if you choose Yes in question 2.<br>";    }
        }

        if ($_GET['q_33'] == 'null') {
            $error .= "Error:  Question 3 is required.<br>";    }

        if ($_GET['q_34'] == 'null') {
            $error .= "Error:  Question 4 is required.<br>";    }
        
        if(isset($error)){
            echo $error;
        }
        else{
            $third_poll = new Third_Poll("lioriloior"); //meanwhile this
            // $poll->user_name = $_SESSION['user_name']; for the time that we gonna have login succsesfully
            $third_poll->QUES_31 = $_GET['q_31'];
            $third_poll->QUES_32 = $_GET['q_32'];
            if($_GET['q_32'] == 'yes'){
                $third_poll->QUES_321 = $_GET['321'];
            }
            $third_poll->QUES_33 = $_GET['q_33'];
            $third_poll->QUES_34 = $_GET['q_34'];
            
            $error = $third_poll->add_third_poll();
            if(isset($error)){
                echo ("poll has been added to the DB<br>");
                echo("this is the object that has been added: ".$third_poll);    
                $third_poll -> set_third_poll_final();            
            }
            else
                echo ($error);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Transportaion poll

        </title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body onload="updateText_q_32()">
        <form>
            <h1>Transportation Poll</h1>

            <h2>Transportation Poll - part 3/3</h2>

            <p>1. Would you use a share light transportation such as e-scooter or e-bike? 
                <select name = "q_31" id="q_31">
                    <option value="null">Select</option>    
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </p>

            <p>2. Have you noticed any improvements or declines in public light transportation in your area in recent years?
                <select name="q_32" id="q_32" onchange="updateText_q_32()">
                    <option value="null">Enter Value</option>    
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
            </p>

            <div id = "yes">
                <p><b>Asnwer choosen in previous question - Yes</b></p>
                <p>2.1. Name one way that the goverment should invest to inprove public light transportation? <input type="text" maxlength="200" name="q_321"></p>
            </div>                        
           
            <p>3. How do you think the cost of public transportation compares to the cost of owning and maintaining a personal light transportation vehicle?
                <select name="q_33" id="q_33">
                    <option value="null">Enter Value</option>    
                    <option value="cheaper">public transportation much cheaper then personal vehicle</option>
                    <option value="equal">public transportation is equal to personal vehicle</option>
                    <option value="expensive">public transportation more expensive then personal vehicle</option>
                </select>
            </p>
            
            <p>4. How safe do you feel using shared self-light transportation? 
                <select name = "q_34" id="q_34">
                    <option value="null">Select</option>    
                    <option value="not_safe">Not Safe</option>
                    <option value="mid_safe">Adequately Safe</option>
                    <option value="very_safe">Very Safe</option>
                </select>
            </p>

            <p><input type="submit" onclick = "movingPage()"></p>
        </form>
        <p>To the Transportaion Poll part 2 : <button><a href="poll_second_page.php">Transportaion Poll Part 2</a></button></p>
        <p>Back To Main: <button><a href="index.php">Back To Main</a></button></p>
        <script>
                function movingPage(){
                    window.location.href="index.php";
                }

                function updateText_q_32() {
                    var answer = document.getElementById("q_32").value;                   
                    if(answer == 'yes'){
                        document.getElementById("yes").style.display = 'block';
                    }
                    else{
                        document.getElementById("yes").style.display = 'none';
                    }
                }
            </script>
    </body>
</html>
