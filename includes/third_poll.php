<?php
require_once("init.php");


class Third_Poll
{
    private $user_name;
    private $poll_status; 
    private $QUES_31;
    private $QUES_32;
    private $QUES_321;
    private $QUES_33;
    private $QUES_34;
    function __toString(){ //for test to print the object
        return "Poll: || number: ".$this->poll_number." | by user: ".$this->user_name." | status: ".$this->poll_status." ||<br>";
    }

    public function __construct()
    {
        $this -> poll_status = "non-final";
        $this -> user_name = $_SESSION['user_name'];
        $this -> QUES_31 = null;
        $this -> QUES_32 = null;
        $this -> QUES_321 = null;
        $this -> QUES_33 = null;
        $this -> QUES_34 = null;
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
            $this -> $property = $value;
    }

    public function set_third_poll_final()
    {
        global $database;
        $error = null;

        $this -> find_third_poll_by_attribute('user_name', $_SESSION['user_name']);
        $this -> poll_status = "final";
     
        $sql = "update third_poll set poll_status = '" . $this->poll_status . "' where user_name = '". $this -> user_name."'";
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
    public static function fetch_third_polls()
    {
        global $database;
        $sql = "select * from third_poll";
        $result = $database -> query($sql);
        $polls = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $poll = new Third_Poll();
                    $poll -> instantation($row);
                    $polls [$i] = $poll;
                    $i += 1;
                }
        }
        return $polls;
    }
    public function add_third_poll()
    {
        global $database;
        $error = null;

        $sql = "insert into third_poll(user_name, poll_status, QUES_31, QUES_32, QUES_321, QUES_33, QUES_34) values ('".$this -> user_name."','".$this -> poll_status."','".$this -> QUES_31."','".$this -> QUES_32."','".$this -> QUES_321."','".$this -> QUES_33."','".$this -> QUES_34."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function update_third_poll()
    {
        global $database;
        $error = null;

        $sql = "update third_poll set poll_status = '" . $this->poll_status . "', QUES_31 = '" . $this->QUES_31 . "', QUES_32 = '" . $this->QUES_32 . "', QUES_321 = '" . $this->QUES_321 . "', QUES_33 = '" . $this->QUES_33 . "', QUES_34 = '" . $this->QUES_34 . "' where user_name = '" . $this -> user_name . "'";
        // echo $sql;
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_third_poll_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $sql = "select * from third_poll where ".$attribute." = '".$value."'";
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
    public function third_poll_full_status()
    {
        $this->find_third_poll_by_attribute('user_name', $_SESSION['user_name']);
        $user_progress = 0;
        if($this -> QUES_31 != null)
            $user_progress += (1/4);
        if($this -> QUES_32 != null)
            $user_progress += (1/4);
        if($this -> QUES_33 != null)
            $user_progress += (1/4);
        if($this -> QUES_34 != null)
            $user_progress += (1/4);

        return (float)$user_progress;
    }  
    public function third_poll_is_final(){
        global $database;
        $error = null;

        $this->find_third_poll_by_attribute('user_name', $_SESSION['user_name']);
        $sql = "select poll_status from third_poll where user_name = '".$_SESSION['user_name']."'";
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
$third_poll = new Third_Poll();