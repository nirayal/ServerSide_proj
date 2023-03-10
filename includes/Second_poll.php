<?php
require_once("init.php");


class Second_Poll
{
    private $user_name;
    private $poll_status; 
    private $QUES_21;
    private $QUES_22;
    private $QUES_23;
    private $QUES_231;
    private $QUES_24;
    private $QUES_25;

    function __toString(){ //for test to print the object
        return "Poll: || number: ".$this->poll_number." | by user: ".$this->user_name." | status: ".$this->poll_status." ||<br>";
    }

    public function __construct()
    {
        $this -> poll_status = "non-final";
        $this -> user_name = $_SESSION['user_name'];
        $this -> QUES_21 = null;
        $this -> QUES_22 = null;
        $this -> QUES_23 = null;
        $this -> QUES_231 = null;
        $this -> QUES_24 = null;
        $this -> QUES_25 = null;
    }

    //general getter methods
    public function __get($property)
    {
        if(property_exists($this, $property))
        {
            return $this -> $property;
        }
    }
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) 
            $this->$property = $value;
    }

    public function set_second_poll_final()
    {
        global $database;
        $error = null;

        $this->find_second_poll_by_attribute('user_name', $_SESSION['user_name']);
        $this->poll_status = "final";
     
        $sql = "update second_poll set poll_status = '" . $this->poll_status . "' where user_name ='". $_SESSION['user_name']."'";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    private function instantation($poll_array)
    {
        foreach($poll_array as $attribute => $value)
            if($result = $this -> has_attribute($attribute))
                $this -> $attribute = $value;
    }
    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    public static function fetch_second_polls()
    {
        global $database;
        $sql = "select * from second_poll";
        $result = $database -> query($sql);
        $polls = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $poll = new Second_poll();
                    $poll -> instantation($row);
                    $polls [$i] = $poll;
                    $i += 1;
                }
        }
        return $polls;
    }
    public function add_second_poll()
    {
        global $database;
        $error = null;

        $sql = "insert into second_poll(user_name, poll_status, QUES_21, QUES_22, QUES_23, QUES_231, QUES_24, QUES_25) values ('".$this -> user_name."','".$this -> poll_status."','".$this -> QUES_21."','".$this -> QUES_22."','".$this -> QUES_23."','".$this -> QUES_231."','".$this -> QUES_24."','".$this -> QUES_25."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function update_second_poll()
    {
        global $database;
        $error = null;

        $sql = "update second_poll set poll_status = '" . $this->poll_status . "', QUES_21 = '" . $this->QUES_21 . "', QUES_22 = '" . $this->QUES_22 . "', QUES_23 = '" . $this->QUES_23 . "', QUES_231 = '" . $this->QUES_231 . "', QUES_24 = '" . $this->QUES_24 . "', QUES_25 = '" . $this->QUES_25 . "' where user_name = '" . $this-> user_name . "'";
        // echo $sql;
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_second_poll_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $sql = "select * from second_poll where ".$attribute." = '".$value."'";
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
    }
    // this function will return if the user answered all the poll.
    public function second_poll_full_status()
    {
        $this->find_second_poll_by_attribute('user_name', $_SESSION['user_name']);
        $user_progress = 0;
        if($this -> QUES_21 != null)
            $user_progress += (1/5);
        if($this -> QUES_22 != null)
            $user_progress += (1/5);
        if($this -> QUES_23 != null)
            $user_progress += (1/5);
        if($this -> QUES_24 != null)
            $user_progress += (1/5);
        if($this -> QUES_25 != null)
            $user_progress += (1/5);
        return (float)$user_progress;
    }  
    public function second_poll_is_final(){
        global $database;
        $error = null;

        $this->find_second_poll_by_attribute('user_name', $_SESSION['user_name']);
        $sql = "select poll_status from second_poll where user_name = '".$_SESSION['user_name']."'";
        // echo $sql;
        $result = $database -> query($sql);
        // print_r($result);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;

        if($result -> num_rows > 0)
            if(mysqli_fetch_row($result)['0'] == 'final')
                return "final";
        else
            return 'non-final';   
    }
}
$second_poll = new Second_Poll();