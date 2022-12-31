<?php
require_once("includes\init.php");


class First_Poll
{
    private $poll_number;
    private $user_name;
    private $poll_status; 
    static $poll_counter = 1;
    private $QUES_11;
    private $QUES_12;
    private $QUES_13;
    private $QUES_131;
    private $QUES_132;
    private $QUES_133;
    private $QUES_134;
    private $QUES_135;
    private $QUES_136;
    private $QUES_137;
    private $QUES_138;

    public function Poll()
    {}
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
        $this -> QUES_11 = null;
        $this -> QUES_12 = null;
        $this -> QUES_13 = null;
        $this -> QUES_131 = null;
        $this -> QUES_132 = null;
        $this -> QUES_133 = null;
        $this -> QUES_134 = null;
        $this -> QUES_135 = null;
        $this -> QUES_136 = null;
        $this -> QUES_137 = null;
        $this -> QUES_138 = null;
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

    public function setPollFinal()
    {
        $this->poll_status = "non-final";
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
    public static function fetch_polls()
    {
        global $database;
        $sql = "select * from first_poll";
        $result = $database -> query($sql);
        $polls = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $poll = new First_Poll();
                    $poll -> instantation($row);
                    $polls [$i] = $poll;
                    $i += 1;
                }
        }
        return $polls;
    }
    public function add_poll()
    {
        global $database;
        $error = null;

        $sql = "insert into first_poll(poll_number, poll_status, user_name, QUES_11, QUES_12, QUES_13, QUES_131, QUES_132, QUES_133, QUES_134, QUES_135, QUES_136, QUES_137, QUES_138) values ('".$this -> poll_number."','".$this -> user_name."','".$this -> poll_status."','".$this -> QUES_11."','".$this -> QUES_12."','".$this -> QUES_13."','".$this -> QUES_131."','".$this -> QUES_132."','".$this -> QUES_133."','".$this -> QUES_134."','".$this -> QUES_135."','".$this -> QUES_136."','".$this -> QUES_137."','".$this -> QUES_138."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find poll. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_poll_by_attribute($attribute, $value)
    {
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
    }
    // this function will return if the user answered all the poll.
    public function first_poll_full_status()
    {
        $user_progress = 0;
        if($this -> QUES_11 != null)
            $user_progress += (1/6);
        if($this -> QUES_12 != null)
            $user_progress += (1/6);
        if($this -> QUES_13 != null)
        {
            $user_progress += (1/6);
            if($this -> QUES_131 != null)
                $user_progress += (1/6);
            if($this -> QUES_132 != null)
                $user_progress += (1/6);
            if($this -> QUES_133 != null)
                $user_progress += (1/6);

            if($this -> QUES_134 != null)
                $user_progress += (1/6);
            if($this -> QUES_135 != null)
                $user_progress += (1/6);
            if($this -> QUES_136 != null)
                $user_progress += (1/6);

            if($this -> QUES_137 != null)
                $user_progress += (1/6);
            if($this -> QUES_138 != null)
                $user_progress += (1/6);
            if($this -> QUES_137 != null && $this -> QUES_138 != null)
                $user_progress += (1/6);
        }
        return $user_progress * 100;
    }  


}