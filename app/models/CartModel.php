<?php
class CartModel extends model
{
     public $title = "Tim's Raw Honey";
     private $total;
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
      public function order($ID,$data,$total,$promo,$address){
          if(empty($promo)){
              $promo=NULL;
          }
        $this->database->query("INSERT INTO orders(customerID,orderDetails,orderTotalPrice,promocodeid,addressID) VALUES('$ID','$data','$total',(SELECT promoID FROM promocodes WHERE promoCode='$promo'),'$address')");
    }
    public function orderItems($orderID,$ID,$productID,$quantity){
        $this->database->query("INSERT INTO orderitems(orderID,customerID,productID,quantity) VALUES('$orderID','$ID','$productID','$quantity')");
    }
    public function delivery($ID){
        $this->database->query("INSERT INTO deliveries(orderID,deliveryStatus) VALUES('$ID','PENDING')");
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
    public function getAddresses($ID){
        $result = $this->database->query("SELECT * FROM user_address WHERE customerID = $ID");
        $i = 0;
        foreach($result as $address){
            echo <<<HTML
                <!-- <input type="hidden" id="$i" value="<?php echo>" -->
                <button id="addr$i" onclick="pickAddress({$address['AddressID']},$i)">{$address['street']}, {$address['district']}, {$address['landmark']}, {$address['region']}, {$address['buildingNumber']}, {$address['appNumber']}</button>
            HTML;
            $i++;
        }

    }
    public function getOrder($ID){
    $result = $this->database->query("SELECT * FROM orders,orderitems,products WHERE orders.ID = orderitems.orderID AND orderitems.productID = products.ID AND orders.ID = $ID");
    return $result;
    }
    public function setTotal($total){
        $this->total = $total;
    }
    public function getTotal(){
        return $this->total;
    }
}
