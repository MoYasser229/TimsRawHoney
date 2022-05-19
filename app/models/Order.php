<?php

class Orders{
    private $ID;
    private $customer;
    private $products;
    protected $database;
    private $quantity;
    private $price;
    private $date;

    function __construct($ID,$customer){
        $this->ID = $ID;
        $this->customer = $customer;
        $this->database = new Database;
        $this->products = array();
        $this->setProducts();
        $result = $this->database->query("SELECT * FROM orders WHERE ID = {$this->ID}");
        $tempOrder = $result-> fetch_assoc();
        $this->quantity = $tempOrder['quantity'];
        $this->price = $tempOrder['orderTotalPrice'];
        $this->date = date("d/m/Y",strtotime($tempOrder['createdAt']));
        
    }

    function getID(){
        return $this->ID;
    }
    function getCustomer(){
        return $this->customer;
    }
    function getQuantity(){
        return $this->quantity;
    }
    function getPrice(){
        return $this->price;
    }
    function getDate(){
        return $this->date;
    }
    function setProducts(){
        $result = $this->database->query("SELECT productID FROM orderitems WHERE orderID = {$this->ID}");
        foreach($result as $product){
            $this->products[] = new Product($product['productID']);
        }
    }
    function getProducts(){
        return $this->products;
    }
    function setID($ID){
        $this->ID = $ID;
    }
    function setCustomer($customer){
        $this->customer = $customer;
    }
}