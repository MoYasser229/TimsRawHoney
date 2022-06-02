<?php
require_once"filter.php";
class ShopModel extends model implements filter
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
      public function getProductId(){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['ID'];
      }
      public function getProductName($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productName'];
      }
      public function shop(){
          $result = $this->database->query("SELECT * FROM products");
          return $result;
      }
      public function search($table,$columns,$search){
        $result = $this->database->query("SELECT * FROM $table WHERE ($columns LIKE '%$search%')");
        $this->products = $result;
      }
      public function sort($table,$type,$fitler){
            $result = $this->database->query("SELECT * FROM $table ORDER BY $type $filter");
            $this->products = $result;
    }
}

