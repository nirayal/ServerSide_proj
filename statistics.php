<?php
    require_once("includes\init.php");
    require_once("questions_define.php");
    require_once("First_Poll.php");
    require_once("second_poll.php");
    require_once("third_poll.php");
    

    if (!$session->signed_in){
        header('Location: login.php');
        exit;
    }

    global $database;
    $error = null;
    // graph 1 section

    $first_polls_arr = $poll -> fetch_first_polls();
    $second_polls_arr = $second_poll -> fetch_second_polls();
    $third_poll_arr = $third_poll -> fetch_third_polls();

    $public_trans_not_safe = 0;
    $light_trans_not_safe = 0;
    $arrive_duration_by_city;
    foreach($first_polls_arr as $first_poll_ans){
        foreach($first_polls_arr -> $QUES_11 as $city){
            if($first_poll_ans -> $QUES_11 == $city){}
                $arrive_duration_by_city [$city] += (int)$first_poll_ans -> $QUES_134;
            
        }
        print_r($arrive_duration_by_city);
    }

    foreach($second_polls_arr as $second_poll_ans){
        if($second_poll_ans -> $QUES_25 == 'not_safe')
            $public_trans_not_safe += 1;
    }

    foreach($third_polls_arr as $third_poll_ans){
        if($third_poll_ans -> $QUES_34 == 'not_safe')
            $light_trans_not_safe += 1;
    }







    $public_trans_not_safe = "select count(*) from second_poll where QUES_25 = 'not_safe'";
    $public_trans_mid_safe = "select * from second_poll where QUES_25 = 'mid_safe'";
    $public_trans_very_safe = "select * from second_poll where QUES_25 = 'very_safe'";
    $light_trans_not_safe = "select count(*) from third_poll where QUES_34 = 'not_safe'";
    $light_trans_mid_safe = "select * from third_poll where QUES_34 = 'mid_safe'";
    $light_trans_very_safe = "select * from third_poll where QUES_34 = 'very_safe'";

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
