<?php
    require_once("includes\init.php");
    require_once("First_Poll.php");
    require_once("questions_define.php");

    $error = null;
    if ($_GET){
        if ( ! $_GET['city']) {
            $error .= "Error:  The city is required.<br>";    }
        else {
            $chars = str_split($_GET['city']);
            foreach ($chars as $char){
                if(! (ctype_alpha($char) || $char = " ")){
                    $error .= "Error:  City must contain only letters.<br>";
                    break;
                }
            }           
        }

        if ( ! $_GET['area']) {
            $error .= "Error:  The area is required.<br>";    }
        else {
            $chars = str_split($_GET['area']);
            foreach ($chars as $char){
                if(! (ctype_alpha($char) || $char = " ")){
                    $error .= "Error:  Area must contain only letters.<br>";
                    break;
                }
            }           
        }

        if ($_GET['vehicle1'] == 'car') {
            if (!$_GET['time_car1']) {
                if ($_GET['time_car1'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for car question 1.<br>";
            } elseif ((int) $_GET['time_car1'] < 0)
                $error .= "Error : time cannot be negative.<br>";

            if ($_GET['car2'] == 'null') {
                $error .= "Error : Please choose Yes or No for car question 2.<br>";
            }

            if (!$_GET['time_car3']) {
                if ($_GET['time_car3'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for car question 3.<br>";
            } elseif ((int) $_GET['time_car3'] < 0)
                $error .= "Error : time cannot be negative.<br>";
        }

        if ($_GET['vehicle1'] == 'bus') {
            if (!$_GET['time_bus1']) {
                if ($_GET['time_bus1'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for bus question 1.<br>";
            } elseif ((int) $_GET['time_bus1'] < 0)
                $error .= "Error : time cannot be negative.<br>";

            if ($_GET['bus2'] == 'null') {
                $error .= "Error : Please choose Yes or No for bus question 2.<br>";
            }
            
            if (!$_GET['time_bus3']) {
                if ($_GET['time_bus3'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for bus question 3.<br>";
            } elseif ((int) $_GET['time_bus3'] < 0)
                $error .= "Error : time cannot be negative.<br>";
        }

        if ($_GET['vehicle1'] == 'motor') {
            if (!$_GET['time_motor1']) {
                if ($_GET['time_motor1'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for motor question 1.<br>";
            } elseif ((int) $_GET['time_motor1'] < 0)
                $error .= "Error : time cannot be negative.<br>";

            if ($_GET['motor2'] == 'null') {
                $error .= "Error : Please choose Yes or No for motor question 2.<br>";
            }

            if (!$_GET['time_motor3']) {
                if ($_GET['time_motor3'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for motor question 3.<br>";
            } elseif ((int) $_GET['time_motor3'] < 0)
                $error .= "Error : time cannot be negative.<br>";
        }

        if ($_GET['vehicle1'] == 'bike') {
            if (!$_GET['time_bike1']) {
                if ($_GET['time_bike1'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for bike question 1.<br>";
            } elseif ((int) $_GET['time_bike1'] < 0)
                $error .= "Error : time cannot be negative.<br>";

            if ($_GET['bike2'] == 'null') {
                $error .= "Error : Please choose Yes or No for bike question 2.<br>";
            }
            
            if ($_GET['bike3'] == 'null') {
                $error .= "Error : Please choose Yes or No for bike question 3.<br>";
            }
        }

        if ($_GET['vehicle1'] == 'e-bike') {
            if (!$_GET['time_ebike1']) {
                if ($_GET['time_ebike1'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for e-bike question 1.<br>";
            } elseif ((int) $_GET['time_ebike1'] < 0)
                $error .= "Error : time cannot be negative.<br>";

            if ($_GET['ebike2'] == 'null') {
                $error .= "Error : Please choose Yes or No for e-bike question 2.<br>";
            }
            
            if ($_GET['ebike3'] == 'null') {
                $error .= "Error : Please choose Yes or No for e-bike question 3.<br>";
            }
        }

        if ($_GET['vehicle1'] == 'foot') {
            if (!$_GET['time_foot1']) {
                if ($_GET['time_foot1'] == '0')
                    $error .= "Error : time cannot be zero.<br>";
                else
                    $error .= "Error : time is required for foot question 1.<br>";
            } elseif ((int) $_GET['time_foot1'] < 0)
                $error .= "Error : time cannot be negative.<br>";

            if (!$_GET['foot2']) {
                if($_GET['foot2'] != '0')
                    $error .= "Error : distance is required.<br>";
            }
            elseif((int)$_GET['foot2'] < 0)
                $error .= "Error : distance cannot be negative.<br>";
        }
         
        if ($_GET['vehicle1'] == 'null')
            $error .= "Error:  You must choose a vehicle.<br>";

        
        if(isset($error)){
            echo $error;
        }
        else{   
            $poll = new First_Poll("lioriloior"); //meanwhile this
            // $poll->user_name = $_SESSION['user_name']; for the time that we gonna have login succsesfully
            $poll->QUES_11 = $_GET['city'];
            $poll->QUES_12 = $_GET['area'];
            $poll->QUES_13 = $_GET['vehicle1'];
            if($_GET['vehicle1'] == 'car'){
                $poll->QUES_131 = $_GET['time_car1'];
                $poll->QUES_132 = $_GET['car2'];
                $poll->QUES_133 = $_GET['time_car3'];
            }
            if($_GET['vehicle1'] == 'bus'){
                $poll->QUES_131 = $_GET['time_bus1'];
                $poll->QUES_132 = $_GET['bus2'];
                $poll->QUES_133 = $_GET['time_bus3'];
            }
            if($_GET['vehicle1'] == 'motor'){
                $poll->QUES_131 = $_GET['time_motor1'];
                $poll->QUES_132 = $_GET['motor2'];
                $poll->QUES_133 = $_GET['time_motor3'];
            }
            if($_GET['vehicle1'] == 'bike'){
                $poll->QUES_134 = $_GET['time_bike1'];
                $poll->QUES_135 = $_GET['bike2'];
                $poll->QUES_136 = $_GET['bike3'];
            }
            if($_GET['vehicle1'] == 'ebike'){
                $poll->QUES_134 = $_GET['time_ebike1'];
                $poll->QUES_135 = $_GET['ebike2'];
                $poll->QUES_136 = $_GET['ebike3'];
            }
            if($_GET['vehicle1'] == 'foot'){
                $poll->QUES_137 = $_GET['time_toof1'];
                $poll->QUES_138 = $_GET['foot2'];
            }
            
            $error = $poll->add_first_poll();
            if(isset($error)){
                echo ("poll has been added to the DB<br>");
                echo("this is the object that has been added: ".$poll);                
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
    <body>
        <form>
            <h1>Transportation Poll</h1>

            <h2>Transportation Poll - part 1/3</h2>


            <p>1. from witch city do you drive to the collage? <input type="text" maxlength="200" name="city"></p>
            <p>2. witch area of the city? <input type="text" maxlength="200" name="area"></p>

            <div>
                3. witch transport vehicle do you use (please select 2 vehicles)?<br>
            </div>
                
            <p>choise: <select name="vehicle1" id="vehicle1" onchange="updateText1()">
                <option value="null">Enter Value</option>    
                <option value="car">Car</option>
                <option value="bus">Bus</option>
                <option value="bike">Bike</option>
                <option value="e-bike">E-Bike</option>
                <option value="foot">Foot</option>
                <option value="motorcycle">Motorcycle</option>
               </select>
            </p>
                
            <div id = "car">
                <p><b>vehicle choosen - car</b></p>
                <p>1. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_car1"></p>
                <p>2. is the driven time is similar every time? <select name = "car2" id="car2">
                    <option value="null">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    </select></p>
                <p>3. how much time do you spend on traffics? <input type="number" name="time_car3"></p>
            </div>            
            
            <div id = "bus">
                <p><b>vehicle choosen - bus</b></p>
                <p>1. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_bus1"></p>
                <p>2. is the driven time is similar every time? <select name = "bus2" id="bus2">
                    <option value="null">Select</option>    
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                    </select></p>
                <p>3. how much time do you spend on traffics? <input type="number" name="time_bus3"></p>
            </div>

            <div id = "motor">
                <p><b>vehicle choosen - motorcycle</b></p>
                <p>1. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_motor1"></p>
                <p>2. is the driven time is similar every time? <select name = "motor2" id="motor2">
                    <option value="null">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select></p>
                <p>3. how much time do you spend on traffics? <input type="number" name="time_motor3"></p>
            </div>

            <div id = "bike">
                <p><b>vehicle choosen - bike </b></p>
                <p>1. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_bike1"></p>
                <p>2. do you ride only on bike paths? <select name = "bike2" id="bike2">
                    <option value="null">Select</option>  
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select></p>
                <p>3. do you stand in red lights? <select name = "bike3" id="bike3">
                    <option value="null">Select</option>    
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select></p>
            </div>
            
            <div id = "e-bike">
                <p><b>vehicle choosen - e-bike</b></p>
                <p>1. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_ebike1"></p>
                <p>2. do you ride only on bike paths? <select name = "ebike2" id="ebike2">
                    <option value="null">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select></p>
                <p>3. do you stand in red lights? <select name = "ebike3" id="ebike3">
                    <option value="null">Select</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select></p>
            </div>
            
            <div id = "foot">
                <p><b>vehicle choosen - foot</b></p>
                <p>1. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_foot1"></p>
                <p>2. what is the distance to the collage from your home (in KM )? <input type="number" name="foot2"></p>
            </div>

            <p><input type="submit"></p>
        </form>
        <p>To the Transportaion Poll part 2 : <button><a href="poll_second_page.php">Transportaion Poll Part 2</a></button></p>
        <p>Back : <button><a href="index.php">Back</a></button></p>

        <script>
                function updateText1() {
                    var answer = document.getElementById("vehicle1").value;                   
                    if(answer == 'car'){
                        document.getElementById("car").style.display = 'block';
                    }else{
                        document.getElementById("car").style.display = 'none';
                    }
                    if(answer == 'bus'){
                        document.getElementById("bus").style.display = 'block';
                    }else{
                        document.getElementById("bus").style.display = 'none';
                    }
                    if(answer == 'motorcycle'){
                        document.getElementById("motor").style.display = 'block';
                    }else{
                        document.getElementById("motor").style.display = 'none';
                    }
                    if(answer == 'bike'){
                        document.getElementById("bike").style.display = 'block';
                    }else{
                        document.getElementById("bike").style.display = 'none';
                    }
                    if(answer == 'e-bike'){
                        document.getElementById("e-bike").style.display = 'block';
                    }else{
                        document.getElementById("e-bike").style.display = 'none';
                    }
                    if(answer == 'foot'){
                        document.getElementById("foot").style.display = 'block';
                    }else{
                        document.getElementById("foot").style.display = 'none';
                    }
                }
            </script>
    </body>
</html>