<?php
class Delivery
{
private $OrderID;    
private $CustomerID;
private $CustomerAddress;
private $DeliveryStatus; 
private $DeliveryPrice;

function __construct($OrderID,$CustomerID,$CustomerAddress,$DeliveryStatus,$DeliveryPrice) {
    $this->OrderID = $OrderID;
    $this->CustomerID = $CustomerID;
    $this->CustomerAddress = $CustomerAddress;
    $this->DeliveryStatus = $DeliveryStatus;
    $this->DeliveryPrice = $DeliveryPrice;
  }
  public function getOrder(){
      return $this->OrderID;
  }
  public function setOrder($OrderID){
     $this->OrderID=$OrderID;
  }

  public function getCustomer(){
      return $this->CustomerID;
  }
  public function setCustomer($CustomerID){
     $this->CustomerID=$CustomerID;
  }

  public function getCustomerAddress(){
      return $this->CustomerAddress;
  }
  public function setCustomerAddress($CustomerAddress){
     $this->CustomerAddress= $CustomerAddress;
  }

  public function getDeliveryStatus(){
    return $this->DeliveryStatus;
    }
  public function setDeliveryStatus($DeliveryStatus){
    $this->DeliveryStatus= $DeliveryStatus;   
  }

  public function getDeliveryPrice(){
      return $this->DeliveryPrice;
  }
 public function setDeliveryPrice($DeliveryPrice){
     $this->DeliveryPrice= $DeliveryPrice;
 }
}


