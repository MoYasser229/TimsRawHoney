<?php

class cookie{
    public function __construct($ID){
    setcookie("cart$ID", "", time()+2678400);
    }
    
    public function destroyCookie($ID){
        setcookie("cart$ID", "", time() - 2678400);
    }

    public function emptyCookie($ID){
        $_COOKIE["cart$ID"]="";
    }

    public function addtocart($customerID,$productID,$quantity){
      

 if(isset($_COOKIE["cart$customerID"]))
 {
  $cookie_data = stripslashes($_COOKIE["cart$customerID"]);

  $cart_data = json_decode($cookie_data, true);
 }
 else
 {
  $cart_data = array();
 }

 $item_id_list = array_column($cart_data, 'productID');

 if(in_array($productID, $item_id_list))
 {
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]["productID"] == $productID)
   {
       if( $cart_data[$keys]["quantity"] + $quantity >0){
    $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $quantity;
       }
       else{
        unset($cart_data[$keys]);
       }
   }
  }
 }
 else
 {
  $item_array = array(
   'productID'   => $_POST["hidden_id"],
   'quantity'  => $_POST["quantity"]
  );
  $cart_data[] = $item_array;
 }

 
 $item_data = json_encode($cart_data);
 setcookie("cart$customerID", $item_data, time() + 2678400);
    }

    public function deleteProduct($productID,$customerID){
  
  $cookie_data = stripslashes($_COOKIE["cart$customerID"]);
  $cart_data = json_decode($cookie_data, true);
  foreach($cart_data as $keys => $values)
  {
   if($cart_data[$keys]['productID'] == $productID)
   {
    unset($cart_data[$keys]);
    $item_data = json_encode($cart_data);
    setcookie("cart$customerID", $item_data, time() + 2678400);
    }
}