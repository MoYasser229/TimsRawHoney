<?php
require "User.php";
class Customer extends User{

private $HomeAddress;
private $cart;
private $orders;
private $ordersData;
private $ID;
public function __construct($ID){
    // $this->HomeAddress = $HomeAddress;
    // $this->cart = $cart;
    // $this->order = $order;
    $this->ID = $ID;
    parent::__construct($ID);
    $this->orders = $this->database->query("SELECT * FROM orders WHERE customerID = {$this->ID}");
    $this->setOrders();

}
public function setOrders(){
    // require_once "Order.php";
    foreach($this->orders as $order){
        $this->ordersData[] = new Orders($order['ID'],$this);
    }
}
public function getNumOrders(){
    return mysqli_num_rows($this->orders);
}
public function getHomeAddress(){
    return $this->HomeAddress;
}
public function setHomeAddress($HomeAddress){
    $this->HomeAddress =  $HomeAddress;
}
public function getCart(){
    return $this->Cart;
}
public function setCart($cart){
    $this->Cart = $this->Cart;
}
public function getorder(){
    return $this->Order;
}
// public function setOrder($order){
//     $this->Order = $this->Order;
// }

}



?>