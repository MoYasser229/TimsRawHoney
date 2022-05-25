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
      public function order($ID,$data,$total,$promo){
          if(empty($promo)){
              $promo=NULL;
          }
        $this->database->query("INSERT INTO orders(customerID,orderDetails,orderTotalPrice,promocodeid) VALUES('$ID','$data','$total',(SELECT promoID FROM promocodes WHERE promoCode='$promo'))");
    }
    public function orderItems($orderID,$ID,$productID,$quantity){
        $this->database->query("INSERT INTO orderitems(orderID,customerID,productID,quantity) VALUES('$orderID','$ID','$productID','$quantity')");
    }
    public function getUserData($ID){
        $result = $this->database->query("SELECT * FROM users WHERE ID = '$ID'");
        return $result;

    }
    public function getOrderID(){

        $result = $this->database->query("SELECT ID FROM orders ORDER BY ID desc limit 1");
        if($row= $result-> fetch_assoc()){
        return $row['ID'];
        }

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
    public function promoCode($promo){
        $result = $this->database->query("SELECT * FROM promocodes WHERE promoCode= '$promo' AND active='1' AND TIMESTAMPDIFF(DAY,createdAt,CURRENT_TIMESTAMP)<=promoLength");
        if(mysqli_num_rows($result) == 0){
            return false;
        }
        return $result->fetch_assoc()['promoValue'];
    }
    
  
  }
