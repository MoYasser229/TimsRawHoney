<?php
abstract class Model{
    protected $database;

    public function __construct(){
        $this->database = new Database;
    }


    public function getDatabase(){
        return $this->database;
    }
    
}