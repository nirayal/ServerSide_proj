<?php
require_once("..\includes\init.php");


class Pull
{
    private $pull_number;
    private $pull_status; 
    static $pull_counter = 1;
    private $user_name;

    public function Pull()
    {}
    function __toString(){ //for test to print the object
        return "Pull: || number: ".$this->pull_number." | by user: ".$this->user_name." | status: ".$this->pull_status." ||<br>";
    }

    public function __construct()
    {
        $this -> pull_number = self :: $pull_counter;
        self :: $pull_counter ++;
        $this->pull_status = "non-final";
        $this->user_name = $_SESSION['user_id'];
    }

    //general getter methods
    public function __get($property)
    {
        if(property_exists($this, $property))
        {
            return $this -> $property;
        }
    }
    public function setPullFinal()
    {
        $this->pull_status = "non-final";
    }
    private function instantation($pull_array)
    {
        foreach($pull_array as $attribute => $value)
            if($result = $this -> has_attribute($attribute))
                $this -> $attribute = $value;
    }
    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    public static function fetch_pulls()
    {
        global $database;
        $sql = "select * from pulls";
        $result = $database -> query($sql);
        $pulls = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $pull = new Pull();
                    $pull -> instantation($row);
                    $pulls [$i] = $pull;
                    $i += 1;
                }
        }
        return $pulls;
    }
    public function add_pull()
    {
        global $database;
        $error = null;

        $sql = "insert into pulls(pull_number, user_name, pull_status) values ('".$this -> pull_number."','".$this -> user_name."','".$this -> pull_status."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find pull. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_pull_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $sql = "select * from pulls where ".$attribute." = '".$value."'";
        $result = $database -> query($sql);
        if(!$result)
            $error = "coul'd not find pull. Error is :". $database -> get_connection() -> error;
        elseif($result -> num_rows >0)
        {
            $found_pull = $result ->fetch_assoc();
            $this -> instantation($found_pull);
        }
        else
            $error = "Can't find pull by this value";
        return $error;
    }
}