<?php
session_start();
class Session{
    public function setSession($name, $value){
        $_SESSION[$name] = $value;
    }
    static function getSession($name){
        return $_SESSION[$name];
    }
}