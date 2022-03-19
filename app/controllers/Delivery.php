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
  public function setOrder(){
     $this->OrderID=$OrderID;
  }

  public function getCustomer(){
      return $this->CustomerID;
  }
  public function setCustomer(){
     $this->CustomerID=$CustomerID;
  }

  public function getCustomerAddress(){
      return $this->CustomerAddress;
  }
  public function setCustomerAddress(){
     $this->CustomerAddress= $CustomerAddress;
  }

  public function getDeliveryStatus(){
    return $this->DeliveryStatus;
    }
  public function setDeliveryStatus(){
    $this->DeliveryStatus= $DeliveryStatus;   
  }

  public getDeliveryPrice(){
      return $this->DeliveryPrice;
  }
 public setDeliveryPrice(){
     this->DeliveryPrice= $DeliveryPrice;
 }
}


>