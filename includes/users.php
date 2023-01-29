<?php

require_once("includes\init.php");
class User
{
    private $user_name;
    private $full_name;
    private $password;
    private $phone;
    private $email;
    private $birth_day;

    public function __construct($user_name = null, $full_name = null, $password = null, $phone = null, $email = null, $birth_day = null)
    {
        $this->user_name = $user_name;
        $this->full_name = $full_name;
        $this->password = self::EncPass($user_name,$password);
        $this->phone = $phone;
        $this->email = $email;
        $this->birth_day = $birth_day;
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

    public function find_user_by_username_pass($user_name, $password)
    {
        global $database;
        $error = null;
        
        $result = $database->query("select * from users where user_name  = '". $user_name."' and password = '". self::EncPass($user_name,$password)."'");
        if(!$result)
            $error = "coul'd not find user. Error is :" . $database->get_connection()->error;
        elseif($result->num_rows > 0)
        {
            $found_user = $result->fetch_assoc();
            $this->instantation($found_user);
        }
        else
            $error = "Can't find user by this user name " . $user_name;
        return $error;
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

    public function add_user()
    {
        global $database;
        $error = null;
        // echo ($this->user_name . "<br>" . $this->full_name . "<br>" . $this->password . "<br>" . $this->phone . "<br>" . $this->email . "<br>" . $this->birth_day . "<br>");
        $sql = "insert into users(user_name,full_name,password,phone,email,birth_day) values ('".$this -> user_name."','".$this -> full_name."','".$this -> password."','".$this -> phone."','".$this -> email."','".$this -> birth_day."')";
        $result = $database -> query($sql);
        if(!$result)
            $error = "coul'd not find user. Error is :". $database -> get_connection() -> error;
        return $error;
    }
}
