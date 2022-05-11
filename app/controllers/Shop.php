<?php
class Shop{
    private $name;
    private $description;
    private $cost;
    private $ID;
    private $stock;
    private $size;

public function __construct($name, $description, $cost, $ID, $stock, $size){
    $this->name = $name;
    $this->description = $description;
    $this->cost = $cost;
    $this->ID = $ID;
    $this->stock = $stock;
    $this->size = $size;
}

//GETTERS & SETTERS

public function getName(){
    return $this->name;
}
public function setName($name) {
    $this->name = $name;
}

public function getDescription(){
    return $this->description;
}
public function setDescription($description) {
    $this->description = $description;
}

public function getCost(){
    return $this->cost;
}
public function setCost($cost) {
    $this->cost = $cost;
}

public function getID(){
    return $this->ID;
}
public function setID($ID){
    $this->ID = $ID;
}

public function getStock(){
    return $this->stock;
}
public function setStock($stock){
    $this->stock = $stock;
}

public function getSize(){
    return $this->size;
}
public function setSize($size) {
    $this->size = $size;
}

}