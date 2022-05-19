<?php
class Cart{
    private $ID;
    private $products;
    private $price;
    private $quantity;

    public function __construct($ID,$products,$price,$quantity){
        $this->ID = $ID;
        $this->products = $products;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getID(){
        return $this->ID;
    }

    public function getProducts(){
        return $this->products;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setID($ID){
        $this->ID = $ID;
    }

    public function setProducts($products){
        $this->products = $products;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    //cart product Operations  


    //Cost Operations

    //Cart cookies operations

}