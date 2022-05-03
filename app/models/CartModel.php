<?php
class CartModel extends model
{
     public $title = "Tim's Raw Honey";
     
  
     public function getimage($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return IMAGEROOT . $result -> fetch_assoc()['productImage'];
      }
      public function getCost($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productCost'];
      }
      public function getOffer($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productCost']*90/100;
      }
      public function getMaterial(){
      return "Glass";
      }
      public function getSize(){
          return "Small";
      }
 
  
  }
}