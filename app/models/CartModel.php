<?php
class CartModel extends model
{
     public $title = "Tim's Raw Honey";
     
    public function getName($ID){
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productName'];
    }
     public function getimage($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return IMAGEROOT . $result -> fetch_assoc()['productImage'];
      }
      public function getCost($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['retailCost'];
      }
      public function getOffer($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['retailCost']*90/100;
      }
      public function getMaterial(){
      return "Glass";
      }
      public function getSize(){
          return "Small";
      }
 
  
  }
