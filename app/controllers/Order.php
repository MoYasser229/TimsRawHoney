<?php

class Order{
    private $ID;
    private $cart;
    private $customer;

    function __construct($ID, $cart, $customer){
        $this->ID = $ID;
        $this->cart = $cart;
        $this->customer = $customer;
    }

    function getID(){
        return $this->ID;
    }
    function getCart(){
        return $this->cart;
    }
    function getCustomer(){
        return $this->customer;
    }

    function setID($ID){
        $this->ID = $ID;
    }
    function setCart($cart){
        $this->cart = $cart;
    }
    function setCustomer($customer){
        $this->customer = $customer;
    }
}