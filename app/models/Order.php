<?php

class Orders{
    private $ID;
    private $customer;
    private $products;
    protected $database;
    private $quantity;
    private $price;
    private $date;
    protected $productQuantities = array();
    function __construct($ID,$customer){
        $this->ID = $ID;
        $this->customer = $customer;
        $this->database = new Database;
        $this->products = array();
        $this->setProducts();
        $result = $this->database->query("SELECT * FROM orders WHERE ID = '{$this->ID}'");
        $tempOrder = $result-> fetch_assoc();
        $result2 = $this->database->query("SELECT SUM(quantity) as orderquantity FROM orderitems WHERE orderID = '{$this->ID}'")->fetch_assoc();
        $this->quantity = $result2['orderquantity'];
        $this->price = $tempOrder['orderTotalPrice'];
        $this->date = date("d/m/Y",strtotime($tempOrder['createdAt']));
        
    }
    function addQuantity($prodID,$quantity){
        $this->productQuantities["$prodID"] =  $quantity;
    }
    function getID(){
        return $this->ID;
    }
    function getCustomer(){
        return $this->customer;
    }
    function getQuantity(){
        return $this->quantity;
    }
    function getPrice(){
        return $this->price;
    }
    function getDate(){
        return $this->date;
    }
    function setProducts(){
        $result = $this->database->query("SELECT productID,COUNT(productID) as productQuantity FROM orderitems WHERE orderID = {$this->ID} GROUP BY productID");
        foreach($result as $product){
            $this->products[] = new Product($product['productID']);
            $this->addQuantity($product['productID'],$product['productQuantity']);
        }
    }
    function viewOrder(){
        echo "<h1 class = headerClass >Order ID {$this->ID}<button class=closeButton onclick='closeView()'><i class='fa-solid fa-xmark'></i></button><br><hr></h1>";
        
        echo <<<EOT
        <div class = "informationGrid">
        <p><strong>Customer Name</strong><br><br> {$this->getCustomer()->getName()}</p>
        <p><strong>Customer phone number</strong><br><br> {$this->getCustomer()->getPhone1()}</p>
        </div>
        <p class = informationText><strong>Customer Address</strong> <br><br>{$this->getCustomer()->getAddress1()}</p>
        <div class = "informationGrid">
            <p><strong>Quantity</strong> <br><br>{$this->quantity}</p>
            <p><strong>Total Price</strong><br><br> {$this->price} EGP</p>
        </div>
        EOT;
        echo <<<HTML
            <div class="table">
                <div class="table-header">
                    <div class="header__item"><span id="name" class="filter__link">Name</span></div>
                    <div class="header__item"><span id="price" class="filter__link">Price</span></div>
                    <div class="header__item"><span id="quantity" class="filter__link">Quantity</span></div>
                    <div class="header__item"><span id="material" class="filter__link">Material</span></div>
                    <div class="header__item"><span id="size" class="filter__link">Size</span></div>
                </div>
            </div>
            <div class="table-content">
                
         HTML;
        foreach($this->products as $product){
            echo <<<EOT
            <div class='table-row'>
                    <div class='table-data'>{$product->getName()}</div>
                    <div class='table-data'>{$product->getRetailCost()} EGP</div>
                    <div class='table-data'>{$this->productQuantities[$product->getID()]}</div>
                    <div class='table-data'>3</div>
                    <div class='table-data'>4</div>
            </div>
            EOT;
        }
         echo "</div>";
    //     <div class="table">
	// 	<div class="table-header">
	// 		<div class="header__item"><a id="name" class="filter__link" href="#">Name</a></div>
	// 		<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">Wins</a></div>
	// 		<div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">Draws</a></div>
	// 		<div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">Losses</a></div>
	// 		<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Total</a></div>
	// 	</div>
	// 	<div class="table-content">	
	// 		<div class="table-row">		
	// 			<div class="table-data">Tom</div>
	// 			<div class="table-data">2</div>
	// 			<div class="table-data">0</div>
	// 			<div class="table-data">1</div>
	// 			<div class="table-data">5</div>
	// 		</div>
	// 		<div class="table-row">
	// 			<div class="table-data">Dick</div>
	// 			<div class="table-data">1</div>
	// 			<div class="table-data">1</div>
	// 			<div class="table-data">2</div>
	// 			<div class="table-data">3</div>
	// 		</div>
	// 		<div class="table-row">
	// 			<div class="table-data">Harry</div>
	// 			<div class="table-data">0</div>
	// 			<div class="table-data">2</div>
	// 			<div class="table-data">2</div>
	// 			<div class="table-data">2</div>
	// 		</div>
	// 	</div>	
	// </div>
        
    //     EOT;
    }
    function getProducts(){
        return $this->products;
    }
    function setID($ID){
        $this->ID = $ID;
    }
    function setCustomer($customer){
        $this->customer = $customer;
    }
}