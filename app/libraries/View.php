<?php

abstract class View{// The view in MVC is for the frontend of the project
    protected $model;
    protected $controller;

    public function __construct($model, $controller){
        $this->model = $model;
        $this->controller = $controller;
    }

    public abstract function output();
}