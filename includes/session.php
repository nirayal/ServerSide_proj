<?php
    require_once("init.php");
    class Session
    {
        private $user_id;
        private $signed_in;

        public function __construct()
        {
            session_start();
            $this -> check_login();
        }

        private function check_login()
        {
            if(isset($_SESSION['user_id']))
            {
                $this -> user_id = $_SESSION['user_id'];
                $this -> signed_in = true;
            }
            else
            {
                unset($this -> user_id);
                $this -> signed_in = false;
            }
        }

        //general getter methods
        public function __get($property)
        {
            if(property_exists($this, $property))
            {
                return $this -> $property;
            }
        }

        public function login($user)
        {
            if($user)
            {
                $this -> user_id = $user -> user_name;
                $_SESSION['user_id'] = $user -> user_name;
                $this -> signed_in = true;
            }
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($this -> user_id);
            $this -> signed_in = false; 
        }
    }
    $session = new Session();
?>