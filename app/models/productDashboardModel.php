<?php

class productDashboardModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/productStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $products;

    public function setProducts($products){
        $this->products = $products;
    }
    public function databaseProducts(){
        $result = $this->database->query("SELECT * FROM products");
        $this->setProducts($result);
    }
    public function getStock($product){
        $result = $this->database->query("SELECT COUNT(*) as quantity,productID FROM orderitems,products WHERE products.ID = orderitems.productID AND products.ID = {$product['ID']}");
        // if($row = $result)
            return $result->fetch_assoc()['quantity'];
    }
    public function insertProduct($name,$rcost,$mcost,$stock,$image,$desc){
        $this->database->query("INSERT INTO products(productName,retailCost,manifactureCost,productStock,productImage,productDescription) VALUES('$name','$rcost','$mcost','$stock','$image','$desc')");

    }
    public function getProducts(){
        foreach($this->products as $product){
            $profit = ceil((($product['retailCost'] - $product['manifactureCost'])/$product['manifactureCost'])*100);
            $text = "profit";
            $color = "#fab137";
            if($profit < 0){
                $text = "Loss";
                $profit = abs($profit);
                $color = "red";
            }
            $availableStock = $product['productStock'] - $this->getStock($product);
            $stockRatio = ceil(($availableStock / $product['productStock'])*100);
        echo "
        <div class='productCard'>
                    <div class='smallGrid2'>
                        <img src='".IMAGEROOT."{$product['productImage']}'>  
                        
                        <div class='smallGridChild2'>
                                <h2>".strtoUpper($product['productName'])."</h2>
                                <hr>
                                <h4>Retail Price &nbsp;&nbsp;&nbsp; <span>{$product['retailCost']} EGP</span></h4>
                                <h4>Manifacture Cost &nbsp;&nbsp;&nbsp; <span>{$product['manifactureCost']} EGP</span></h4>
                                <h4>Available stock &nbsp;&nbsp;&nbsp; <span>{$availableStock}</span></h4>
                                
                        </div>
                    </div>
                    
                    <br>
                    <h1>PRODUCT STATISTICS</h1>
                    <div class='smallGrid'>
                        <div class='childPie'>
                            <div class='pie' style='--p:$profit;--c:$color;--f:$color'>$text<br> $profit%</div>
                        </div>
                        <div class='childPie'>
                        <div class='pie' style='--p:$stockRatio;--c:#FBAB7E;--f:#FBAB7E'>STOCK<br> $stockRatio%</div>
                        </div>
                        
                            
                            
                    </div>
                    <br>
                    <button class ='productButtons2'>EDIT PRODUCT</button>
                </div>
        
        ";
    }
    }


}