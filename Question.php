<?php
require_once("..\includes\init.php");


class Question
{
    private $question_number;
    private $answer;
    private $pull_number;

     public function Question()
    {}
    function __toString(){ //for test to print the object
        return "Question: || number: ".$this->question_number." | in pull number : ".$this->pull_number." | answer : ".$this->answer." ||<br>";
    }

    public function __construct($question_number = null, $answer = null, $pull_number = null)
    {
        $this -> question_number = $question_number;
        $this -> answer = $answer;
        $this -> pull_number = $pull_number;
    }

    //general getter methods
    public function __get($property)
    {
        if(property_exists($this, $property))
        {
            return $this -> $property;
        }
    }
    public function setAnswer($newAnswer)
    {
        $this->answer = $newAnswer;
    }
    private function instantation($question_array)
    {
        foreach($question_array as $attribute => $value)
            if($result = $this -> has_attribute($attribute))
                $this -> $attribute = $value;
    }
    private function has_attribute($attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($attribute, $object_properties);
    }
    public static function fetch_questions()
    {
        global $database;
        $sql = "select * from questions";
        $result = $database -> query($sql);
        $pulls = null;

        if($result)
        {
            $i = 0;
            if($result -> num_rows > 0)
                while($row = $result -> fetch_assoc())
                {
                    $question = new Question();
                    $question -> instantation($row);
                    $questions [$i] = $question;
                    $i += 1;
                }
        }
        return $questions;
    }
    public function add_question()
    {
        global $database;
        $error = null;

        $sql = "insert into questions(question_number, pull_number, answer) values ('".$this -> question_number."','".$this -> pull_number."','".$this -> answer."')";
        $result = $database -> query($sql);

        if(!$result)    
            $error = "coul'd not find question. Error is :". $database -> get_connection() -> error;
        return $error;
    }
    public function find_question_by_attribute($attribute, $value)
    {
        global $database;
        $error = null;

        $sql = "select * from questions where ".$attribute." = '".$value."'";
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