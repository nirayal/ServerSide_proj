<?php
require_once("..\includes\init.php");

class Veichle
{
    private $type;
    private $user_name; 
    private $speed; 
    private $traffic;

    public function Veichle()
    {}
    function __toString(){ //for test to print the object
        return "Veichle: || type: ".$this->type." | by user: ".$this->user_name." | speed: ".$this->speed." | stops in traffic: ".$this->traffic." ||<br>";
    }

    public function __construct($type = null,$speed = null,$traffic = null)
    {
        $this->user_name = $_SESSION['user_id'];
        $this->type  = $type;
        $this->speed = $speed;
        $this->traffic = $traffic;
    }

    //general getter methods
    public function __get($property)
    {
        if(property_exists($this, $property))
        {
            return $this -> $property;
        }
    }
    private function instantation($veichle_array)
    {
        foreach($veichle_array as $attribute => $value)
            if($result = $this -> has_attribute($attribute))
                $this -> $attribute = $value;
    }
    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    public static function fetch_veichles()
    {
        global $database;
        $sql = "select * from veichle";
        $result = $database -> query($sql);
        $veichles = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $veichle = new Veichle();
                    $veichle -> instantation($row);
                    $veichles [$i] = $veichle;
                    $i += 1;
                }
        }
        return $veichles;
    }
    public function add_veichle()
    {
        global $database;
        $error = null;

        $sql = "insert into veichle(type, user_name,speed,traffic) values ('".$this -> type."','".$this -> user_name."','".$this -> speed."','".$this -> traffic."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find veichle. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_veichle_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $sql = "select * from veichle where ".$attribute." = '".$value."'";
        $result = $database -> query($sql);
        if(!$result)
            $error = "coul'd not find veichle. Error is :". $database -> get_connection() -> error;
        elseif($result -> num_rows >0)
        {
            $found_pull = $result ->fetch_assoc();
            $this -> instantation($found_pull);
        }
        else
            $error = "Can't find veichle by this value";
        return $error;
    }
}