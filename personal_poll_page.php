<?php
    require_once("includes\init.php");
    include("navbar.htm");
    require_once("First_Poll.php");
    require_once("Second_Poll.php");
    require_once("third_Poll.php");
    require_once("questions_define.php");

    if (!$session->signed_in){
        header('Location: login.php');
        exit;
    }

    $poll -> find_first_poll_by_attribute('user_name',$_SESSION['user_name']);    
    $second_poll -> find_second_poll_by_attribute('user_name',$_SESSION['user_name']);
    $third_poll -> find_third_poll_by_attribute('user_name',$_SESSION['user_name']);

    








?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            Transportaion poll
        </title>
        <link rel="stylesheet" href="CSS/style.css">
        <script src="JS/poll.js"></script>
    </head>
    <body onload ="updateText_q_23(), updateText1()">
    <h2>Transportation Poll</h2>
        <form>
            <h3>Transportation Poll - part 1/3</h3>

            <p>1. from witch city do you drive to the collage? <input type="text" maxlength="200" name="city" placeholder = <?php echo $poll->__get("QUES_11");?>></p>
            <p>2. witch area of the city? <input type="text" maxlength="200" name="area" placeholder = <?php echo $poll->__get("QUES_12");?>></p>


            <p>3. witch transport vehicle do you use?
                <select name="vehicle1" id="vehicle1" onchange="updateText1()">
                    <option value= <?php echo $poll->__get("QUES_13");?>><?php echo $poll->__get("QUES_13");?></option>    
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
                <p>4. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_car1" placeholder=<?php echo $poll->__get("QUES_131");?>></p>
                <p>5. is the driven time is similar every time? <select name = "car2" id="car2">
                    <option value= <?php echo $poll->__get("QUES_132");?>><?php echo $poll->__get("QUES_132");?></option>    
                </select></p>
                <p>6. how much time do you spend on traffics? <input type="number" name="time_car3" placeholder=<?php echo $poll->__get("QUES_133");?>></p>
            </div>            

            <div id = "bus">
                <p><b>vehicle choosen - bus</b></p>
                <p>4. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_bus1" placeholder=<?php echo $poll->__get("QUES_131");?>></p>
                <p>5. is the driven time is similar every time? <select name = "bus2" id="bus2">
                    <option value= <?php echo $poll->__get("QUES_132");?>><?php echo $poll->__get("QUES_132");?></option>    
                    </select></p>
                <p>6. how much time do you spend on traffics? <input type="number" name="time_bus3" placeholder=<?php echo $poll->__get("QUES_133");?>></p>
            </div>

            <div id = "motor">
                <p><b>vehicle choosen - motorcycle</b></p>
                <p>4. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_motor1" placeholder=<?php echo $poll->__get("QUES_131");?>></p>
                <p>5. is the driven time is similar every time? <select name = "motor2" id="motor2">
                    <option value= <?php echo $poll->__get("QUES_132");?>><?php echo $poll->__get("QUES_132");?></option>       
                </select></p>
                <p>6. how much time do you spend on traffics? <input type="number" name="time_motor3" placeholder=<?php echo $poll->__get("QUES_133");?>></p>
            </div>

            <div id = "bike">
                <p><b>vehicle choosen - bike </b></p>
                <p>4. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_bike1" placeholder=<?php echo $poll->__get("QUES_134");?>></p>
                <p>5. do you ride only on bike paths? <select name = "bike2" id="bike2">
                    <option value= <?php echo $poll->__get("QUES_135");?>><?php echo $poll->__get("QUES_135");?></option>       
                </select></p>
                <p>6. do you stand in red lights? <select name = "bike3" id="bike3">
                    <option value= <?php echo $poll->__get("QUES_136");?>><?php echo $poll->__get("QUES_136");?></option>       
                </select></p>
            </div>

            <div id = "e-bike">
                <p><b>vehicle choosen - e-bike</b></p>
                <p>4. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_ebike1" placeholder=<?php echo $poll->__get("QUES_134");?>></p>
                <p>5. do you ride only on bike paths? <select name = "ebike2" id="ebike2">
                    <option value= <?php echo $poll->__get("QUES_135");?>><?php echo $poll->__get("QUES_135");?></option>  
                </select></p>
                <p>6. do you stand in red lights? <select name = "ebike3" id="ebike3">
                    <option value= <?php echo $poll->__get("QUES_136");?>><?php echo $poll->__get("QUES_136");?></option>       
                </select></p>
            </div>

            <div id = "foot">
                <p><b>vehicle choosen - foot</b></p>
                <p>4. what is the avarge time that you spends on the way to the collage? <input type="number" name="time_foot1" placeholder=<?php echo $poll->__get("QUES_137");?>></p>
                <p>5. what is the distance to the collage from your home (in KM)? <input type="number" name="foot2" placeholder=<?php echo $poll->__get("QUES_138");?>></p>
            </div>
            
            <hr>

            <h3>Transportation Poll - part 2/3</h3>

            <p>1. How satisfied are you with the availability and reliability of public transportation in your area? 
                <input type="range" min ="1" max ="5" name="q_21" value =<?php echo $second_poll->__get("QUES_21");?>>
            </p>
            
            <p>2. Have you noticed any improvements or declines in public transportation in your area in recent years? 
            <input type="text" name="q_22" placeholder =<?php echo $second_poll->__get("QUES_22");?>>
            </p>
            
            <p>3. do you think the collage should invest in public transportation?           
                <select name="q_23" id="q_23" onchange="updateText_q_23()">
                    <option value= <?php echo $second_poll->__get("QUES_23");?>><?php echo $second_poll->__get("QUES_23");?></option>       
                </select>
            </p>
                
            <div id = "yes">
                <p><b>Answer choosen in previous question - Yes</b></p>
                <p>3.1. name one way that the collage should invest to inprove public transportation? <input type="text" maxlength="200" name="q_231" placeholder =<?php echo $second_poll->__get("QUES_231");?>>
            </div>            
            
            <p>4. How do you think the cost of public transportation compares to the cost of owning and maintaining a personal vehicle? <input type="text" maxlength="200" name="q_24" placeholder =<?php echo $second_poll->__get("QUES_24");?>></p>
            
            <p>5. How safe do you feel using public transportation?
            <select name="q_25" id="q_25">
                <option value= <?php echo $second_poll->__get("QUES_23");?>><?php echo $second_poll->__get("QUES_23");?></option>       
            </select>
            </p>

            <hr>

            <h3>Transportation Poll - part 3/3</h3>

            <p>1. Would you use a share light transportation such as e-scooter or e-bike? 
                <select name = "q_31" id="q_31">
                    <option value= <?php echo $third_poll->__get("QUES_31");?>><?php echo $third_poll->__get("QUES_31");?></option>       
                </select>
            </p>

            <p>2. Have you noticed any improvements or declines in public light transportation in your area in recent years?
                <select name="q_32" id="q_32" onchange="updateText_q_32()">
                    <option value= <?php echo $third_poll->__get("QUES_32");?>><?php echo $third_poll->__get("QUES_32");?></option>       
                </select>
            </p>

            <div id = "yes">
                <p><b>Asnwer choosen in previous question - Yes</b></p>
                <p>2.1. Name one way that the goverment should invest to inprove public light transportation? <input type="text" maxlength="200" name="q_321" placeholder =<?php echo $third_poll->__get("QUES_321");?>>
            </div>                        
           
            <p>3. How do you think the cost of public transportation compares to the cost of owning and maintaining a personal light transportation vehicle?
                <select name="q_33" id="q_33">
                    <option value= <?php echo $third_poll->__get("QUES_33");?>><?php echo $third_poll->__get("QUES_33");?></option>       
                </select>
            </p>
            
            <p>4. How safe do you feel using shared self-light transportation? 
                <select name = "q_34" id="q_34">
                    <option value= <?php echo $third_poll->__get("QUES_34");?>><?php echo $third_poll->__get("QUES_34");?></option>       
                </select>
            </p>
        </form>
        
    </body>
</html>
