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

    $urlContents = file_get_contents("php://input");

    $first_graph_data = array("code" => 1, 'response' => array());
    $second_graph_data = array("code" => 2, 'response' => array());
    $third_graph_data = array("code" => 3, 'response' => array());
    $fourth_graph_data = array("code" => 4, 'response' => array());

    global $database;
    
    // graph 1 section:
    //this graph will withdraw from the DB all the safety questions from second poll, and will return the answer using AJAX.   
    $result = $database -> query('select count(*) from second_poll where QUES_25 = "not_safe"');
    if ($result->num_rows == 0)
        $first_graph_data['response']['graph1_ques_25_not_safe'] = '0';
    else
        $first_graph_data['response']['graph1_ques_25_not_safe'] = mysqli_fetch_row($result);
    
    $result = $database -> query('select * from second_poll where QUES_25 = "mid_safe"');
    if ($result->num_rows == 0)
        $first_graph_data['response']['graph1_ques_25_mid_safe'] = '0';
    else
        $first_graph_data['response']['graph1_ques_25_mid_safe'] = mysqli_fetch_row($result);
    
    $result = $database -> query('select * from second_poll where QUES_25 = "very_safe"');
    if ($result->num_rows == 0)
        $first_graph_data['response']['graph1_ques_25_very_safe'] = '0';
    else
        $first_graph_data['response']['graph1_ques_25_very_safe'] = mysqli_fetch_row($result);

    $result = $database -> query('select count(*) from third_poll where QUES_34 = "not_safe"');
    if ($result->num_rows == 0)
        $first_graph_data['response']['graph1_ques_34_not_safe'] = '0';
    else
        $first_graph_data['response']['graph1_ques_34_not_safe'] = mysqli_fetch_row($result);

    $result = $database -> query('select * from third_poll where QUES_34 = "mid_safe"');
    if ($result->num_rows == 0)
        $first_graph_data['response']['graph1_ques_34_mid_safe'] = '0';
    else
        $first_graph_data['response']['graph1_ques_34_mid_safe'] = mysqli_fetch_row($result);
    
    $result = $database -> query('select * from third_poll where QUES_34 = "very_safe"');
    if ($result->num_rows == 0)
        $first_graph_data['response']['graph1_ques_34_very_safe'] = '0';
    else
       $first_graph_data['response']['graph1_ques_34_very_safe'] = mysqli_fetch_row($result);

    // graph 2 section:
    // this graph will withdraw from the DB all the avarage time from each city the exist in the DB from the first poll, and will return the answer using AJAX.

    $result = $database -> query("select distinct QUES_11 from First_Poll");
    if ($result->num_rows == 0)
        $second_graph_data['response']['graph2_cities'] = null;
    else {
        $second_graph_data['response']['graph2_cities'] = array();
        while ($city = $result -> fetch_assoc()) {
            $resultCity = $database->query("select AVG(QUES_131)+AVG(QUES_134)+AVG(QUES_137) from first_poll where QUES_11 = '" . $city['QUES_11'] . "' GROUP by QUES_11");
            $second_graph_data['response']['graph2_cities']["'". $city["QUES_11"]."'"] = mysqli_fetch_row($resultCity);
        }
        
    }
    // graph 3 section :
    //this graph will withdraw from the DB the subject that answerd that their felt improvment to decline in the public transportation in their area. 

    $resalt = $database -> query("select Q_22 from second_poll where Q_22 is like 'yes%'");
    $countImprovments = 0;
    $countDeclines = 0;
    if ($result->num_rows == 0)
        $third_graph_data['response']['graph3_chanches'] = null;
    else{
        $third_graph_data['response']['graph3_chanches'] = array();
        while($change = $resalt -> fetch_assoc()){
            if(mysqli_fetch_row($change) == 'yes - improvments')
                $countImprovments = $countImprovments + 1;
            else
                $countDeclines = $countDeclines + 1;
        }
        $third_graph_data['reresponses']['graph3_chanches']['improvments'] = $countImprovments;
        $third_graph_data['reresponses']['graph3_chanches']['Declines'] = $countDeclines;
       }

    //graph 4 section :
    //this geaph will withdraw from the DB the subjects opintion about the collage investing in public transportation in order to improve it.
    $result = $database -> query("select Q_23 from second_poll");
    $countAgree = 0;
    $countDisagree = 0;
    if($resalt -> num_rows == 0)
       $fourth_graph_data['response']['collage_invest'] = null;
    else{
        $fourth_graph_data['response']['collage_invest'] = array();
        while($opinion = $resalt -> fetch_assoc()){
            if(mysqli_fetch_row($opinion) == 'yes')
                $countAgree = $countAgree + 1;
            else
                $countDisagree = $countDisagree + 1;
        }
        $fourth_graph_data['response']['collage_invest']['investAgree'] = $countAgree;
        $fourth_graph_data['response']['collage_invest']['investDisagree'] = $countDisagree;
    }

    $response_data = array("graph_1" => $first_graph_data, "graph_2" => $second_graph_data, "graph_3" => $third_graph_data, "graph_4" => $fourth_graph_data);
    $response_data = json_encode($response_data);
    echo $response_data;

    






?>