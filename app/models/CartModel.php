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
      public function order($ID,$data,$total){
        $this->database->query("INSERT INTO orders(customerID,quantity,orderTotalPrice) VALUES('$ID','$data','$total')");
    }
    public function getUserData($ID){
        $result = $this->database->query("SELECT * FROM users WHERE ID = '$ID'");
        return $result;

    }
    public function getQuantity($ID){
        // return 90;
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productStock'];
    }
    public function updateStock($ID,$quantity){
        // return 90;
        $result = $this->database->query("UPDATE products set productStock=productStock-$quantity  WHERE ID= $ID");
    }
 
  
  }
