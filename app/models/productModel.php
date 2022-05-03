<?php
class productModel extends Model{

    public $title = "Tim's Raw Honey";

    // public function getProductId($ID){
    //     $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
    //     return $result -> fetch_assoc()['ID'];
    // }
    public function getProductName($ID){
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productName'];
    }
    public function getimage($ID){
        // return IMAGEROOT . 'jarr3.png' ;
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productImage'];
    }
    public function getCost($ID){
        // return 90;
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['retailCost'];
    }
    public function getOffer(){
        return 75;
    }
    public function getMaterial(){
    return array(["Glass","Plastic"]);
    }
    public function getSize(){
        return array(["Small","Medium","Large","XLarge"]);
    }
    public function getName($ID){
        
        $result = $this->database->query("SELECT * FROM users WHERE ID= $ID");
        return $result -> fetch_assoc()['fullName'];
    }

}



?>