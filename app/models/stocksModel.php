<?php
class stocksModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/stocksStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $products;
    public function getProducts(){
        return $this->products;
    }
    public function setProducts(){
        $result = $this->database->query("SELECT * FROM products");
        $this->products = $result;
    }
    public function getLeastStock(){
        $result = $this->database->query("SELECT * FROM products ORDER BY productStock ASC LIMIT 1")->fetch_assoc();
        return $result;
    }
    
    public function getSold(){
        $result = $this->database->query("SELECT SUM(quantity) as sold FROM orderitems");
        return $result -> fetch_assoc();
    }
    public function getManifacturingCost(){
        $result = $this->database->query("SELECT * FROM products ORDER BY manifactureCost DESC LIMIT 1");
        return $result->fetch_assoc();
    }
    public function displayRecieptsPrices(){
        $result = $this->database->query("SELECT * FROM stockProducts GROUP BY createdAt");
        if(mysqli_num_rows($result) == 0){
            echo <<<HTML
                <div class="emptyClass">
                    <i class="fa-solid fa-circle-info"></i>
                    <h3>No stock reciepts were created</h3>
                </div>
            HTML;
        }
        else{
            foreach($result as $stock){
                echo <<<EOS
                    <div class="dataClass">
                        <h1>Stock Reciepts Costs
                    </div>
                EOS;
            }
        }
    }
    public function display(){
        foreach($this->products as $product){
            echo <<<EOT
                <div class='productCard'>
                <h1>{$product['productName']}</h1>
                    <hr>
                    <h3>Stock: {$product['productStock']}</h3>
                    <h3 id = stockCost></h3>
                    <input type = hidden id=currentStock value={$product['productStock']}>
                    <button onclick="decreaseStock({$product['ID']})"> <i class="fa-solid fa-minus"></i> </button><input type="text" value={$product['productStock']} id='productStock{$product['ID']}'><button onclick="increaseStock({$product['ID']})"> <i class="fa-solid fa-plus"></i> </button>
                </div>
            EOT;
        }
    }

}