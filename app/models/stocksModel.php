<?php
class stocksModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/stocksStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $products;
    public function setProducts(){
        $result = $this->database->query("SELECT * FROM products");
        $this->products = $result;
    }
    public function getLeastStock(){
        $result = $this->database->query("SELECT * FROM products ORDER BY productStock ASC LIMIT 1")->fetch_assoc();
        return $result;
    }
    
    public function getSold(){
        $result = $this->database->query("SELECT *,COUNT(products.ID) as sold FROM orderitems,products WHERE products.ID = orderitems.productID GROUP BY products.ID");
        return $result -> fetch_assoc();
    }
    public function display(){
        foreach($this->products as $product){
            echo "
                <div class='productCard'>
                <h1>{$product['productName']}</h1>
                    <hr>
                    <h3>Stock: {$product['productStock']}</h3>
                    <h3 id = stockCost></h3>
                    <button class='update'>Update Stock</button>
                </div>
            ";
        }
    }

}