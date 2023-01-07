<?php
require_once("includes\init.php");

class Ride
{
    private $user_name;
    private $type; 
    private $day_in_week;
    private $time;

    public function Ride()
    {}
    function __toString(){ //for test to print the object
        return "Ride: || user_name: ".$this->user_name." | in veichle: ".$this->type." | day in week: ".$this->day_in_week." | took him (time): ".$this->time." ||<br>";
    }

    public function __construct($type = null,$day_in_week = null,$time = null)
    {
        $this->user_name = $_SESSION['user_id'];
        $this->type = $type;
        $this->day_in_week = $day_in_week;
        $this->time = $time;
    }

    //general getter methods
    public function __get($property)
    {
        if(property_exists($this, $property))
        {
            return $this -> $property;
        }
    }
    private function instantation($ride_array)
    {
        foreach($ride_array as $attribute => $value)
            if($result = $this -> has_attribute($attribute))
                $this -> $attribute = $value;
    }
    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    public static function fetch_rides()
    {
        global $database;
        $sql = "select * from rides";
        $result = $database -> query($sql);
        $rides = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $ride = new Ride();
                    $ride -> instantation($row);
                    $rides [$i] = $ride;
                    $i += 1;
                }
        }
        return $rides;
    }
    public function add_ride()
    {
        global $database;
        $error = null;

        $sql = "insert into rides(user_name, type, day_in_week,time) values ('".$this -> user_name."','".$this -> type."','".$this -> day_in_week."','".$this -> time."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find ride. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_ride_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $sql = "select * from rides where ".$attribute." = '".$value."'";
        $result = $database -> query($sql);
        if(!$result)
            $error = "coul'd not find ride. Error is :". $database -> get_connection() -> error;
        elseif($result -> num_rows >0)
        {
            $found_pull = $result ->fetch_assoc();
            $this -> instantation($found_pull);
        }
        else
            $error = "Can't find ride by this value";
        return $error;
    }
}