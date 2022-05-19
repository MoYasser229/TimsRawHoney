<?php

class Product{
    private $name;
    private $description;
    // private $cost;
    private $retailCost;
    private $manifacturingCost;
    private $ID;
    private $stock;
    private $size;
    protected $database;
    private $image;

    public function __construct($ID){
        $this->ID = $ID;
        $this->database = new Database;
        $product = $this->setProduct($ID);
        if($prod = $product){
            $this->name = $prod['productName'];
            $this->description = $prod['productDescription'];
            $this->retailCost = $prod['retailCost'];
            $this->manifacturingCost = $prod['manifactureCost'];
            $this->stock = $prod['productStock'];
            $this->image = $prod['productImage'];
        }   
    }

    //GETTERS & SETTERS
    public function setProduct(){
        $result = $this->database->query("SELECT * FROM products WHERE ID = {$this->ID}");
        return $result->fetch_assoc();
    }
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

    public function setManifactureCost($manifacturingCost){
        $this->manifacturingCost = $manifacturingCost;
    }
    public function setRetailCost($retailCost){
        $this->retailCost = $retailCost;
    }

    public function getManifacturingCost(){
        return $this->manifacturingCost;
    }
    public function getRetailCost(){
        return $this->retailCost;
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
    public function getImage(){
        return IMAGEROOT . "product/" . $this->image;
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