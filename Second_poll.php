<?php
require_once("includes\init.php");


class Second_Poll
{
    private $poll_number;
    private $user_name;
    private $poll_status; 
    static $poll_counter = 2001;
    private $QUES_21;
    private $QUES_22;
    private $QUES_23;
    private $QUES_231;
    private $QUES_24;
    private $QUES_25;

    public function Second_poll() {}

    function __toString(){ //for test to print the object
        return "Poll: || number: ".$this->poll_number." | by user: ".$this->user_name." | status: ".$this->poll_status." ||<br>";
    }

    public function __construct($user_name = null)
    {
        $this -> poll_number = self :: $poll_counter;
        self :: $poll_counter ++;
        $this -> poll_status = "non-final";
        // $this -> user_name = $_SESSION['user_id']; for the advenced timr that we gonna have loggedin user
        $this -> user_name = $user_name; // meanwhile we gonna do that
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

        $this->poll_status = "final";
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

        $sql = "insert into second_poll(poll_number, poll_status, user_name, QUES_21, QUES_22, QUES_23, QUES_231, QUES_24, QUES_25) values ('".$this -> poll_number."','".$this -> user_name."','".$this -> poll_status."','".$this -> QUES_21."','".$this -> QUES_22."','".$this -> QUES_23."','".$this -> QUES_231."','".$this -> QUES_24."','".$this -> QUES_25."')";
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
        return $user_progress;
    }  
}
$second_poll = new Second_Poll();