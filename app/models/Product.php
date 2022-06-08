<?php

class Product{
    private $name;
    private $description;
    // private $cost;
    private $retailCost;
    private $manifacturingCost;
    private $ID;
    private $stock;
    private $size;
    protected $database;
    private $image;

    public function __construct($ID){
        $this->ID = $ID;
        $this->database = new Database;
        $product = $this->setProduct($ID);
        if($prod = $product){
            $this->name = $prod['productName'];
            $this->description = $prod['productDescription'];
            $this->retailCost = $prod['retailCost'];
            $this->manifacturingCost = $prod['manifactureCost'];
            $this->stock = $prod['productStock'];
            $this->image = $prod['productImage'];
        }   
    }

    //GETTERS & SETTERS
    public function setProduct(){
        $result = $this->database->query("SELECT * FROM products WHERE ID = {$this->ID}");
        return $result->fetch_assoc();
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }

    public function setManifactureCost($manifacturingCost){
        $this->manifacturingCost = $manifacturingCost;
    }
    public function setRetailCost($retailCost){
        $this->retailCost = $retailCost;
    }

    public function getManifacturingCost(){
        return $this->manifacturingCost;
    }
    public function getRetailCost(){
        return $this->retailCost;
    }

    public function getID(){
        return $this->ID;
    }
    public function setID($ID){
        $this->ID = $ID;
    }

    public function getStock(){
        return $this->stock;
    }
    public function getImage(){
        return IMAGEROOT . "product/" . $this->image;
    }
    public function setStock($stock){
        $this->stock = $stock;
    }

    public function getSize(){
        return $this->size;
    }
    public function setSize($size) {
        $this->size = $size;
    }
    public function addtocart($customerID,$productID,$productname,$productimage,$productprice,$quantity,$material,$size){
      

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
              
          }
         }
        }
        else
        {
         $item_array = array(
          'productID'   => $productID,
          'productImage'=>$productimage,
          'productName' => $productname,
          'productPrice'=> $productprice,
          'quantity'  => $quantity,
          'material' => $material,
          'size' => $size
         );
         $cart_data[] = $item_array;
        }
       
        
        $item_data = json_encode($cart_data);
        setcookie("cart$customerID", $item_data, time() + 2678400);
           }

}