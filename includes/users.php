<?php

require_once("includes\init.php");
class User
{
    private $user_name;
    private $full_name;
    private $password;
    private $city;
    private $neighbourhood;
    private $phone;
    private $email;

    public function __construct()
    {
        $this->user_name = $_POST['user_name'];
        $this->full_name = $_POST['full_name'];
        $this->password = self::EncPass($_POST['user_name'],$_POST['password']);
        $this->city = $_POST['city'];
        $this->neighbourhood = $_POST['neighbourhood'];
        $this->phone = $_POST['phone'];
        $this->email = $_POST['email'];
    }
    public static function EncPass($user_name, $password)
    {
        return md5(md5($user_name).$password);
    }
    //general getter methods
    public function __get($property)
    {
        if(property_exists($this, $property))
            return $this -> $property;
    }

    public function find_user_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $result = $database->query("select * from users where ".$attribute." = '". $value."'");
        if (!$result)
            $error = "coul'd not find user. Error is :" . $database->get_connection()->error;
        elseif ($result->num_rows > 0) {
            $found_user = $result->fetch_assoc();
            $this->instantation($found_user);
        } else
            $error = "Can't find user by this user_name";
        return $error;
    }
    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }

    private function instantation($user_array)
    {
        foreach($user_array as $attribute => $value)
            if($result = $this -> has_attribute($attribute))
                $this -> $attribute = $value;
    }

    public static function fetch_users()
    {
        global $database;
        $sql = "select * from users";
        $result = $database -> query($sql);
        $users = null;

        if($result)
        {
            $i = 0;
            if($result ->num_rows >0)
                while($row = $result ->fetch_assoc())
                {
                    $user = new User();
                    $user -> instantation($row);
                    $users[$i] = $user;
                    $i += 1;
                }
        }
        return $users;
    }

    public function add_user($user_name, $full_name, $password, $city, $neighbourhood, $phone, $email)
    {
        global $database;
        $error = null;

        $sql = "insert into users(user_name,full_name,password,city,neighbourhood,phone,email) values ('".$this -> user_name.'","'.$this -> full_name.'","'.$this -> password.'","'.$this -> city.'","'.$this -> neighbourhood.'","'.$this -> phone.'","'.$this -> email."')";
        $result = $database -> query($sql);
        if(!$result)
            $error = "coul'd not find user. Error is :". $database -> get_connection() -> error;
        return $error;
    }
}
