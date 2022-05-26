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
    public function getReciept($ID){
        $result = $this->database->query("SELECT *,(quantity * retailCost) as totalPrice FROM stockProducts,reciept,products WHERE reciept.ID = $ID AND reciept.ID = recieptID AND productID = products.ID");
        $oneTime = 0;
        echo <<<HTML
        <div class="table">
        <div class="table-header">
            <div class="header__item"><span class="filter__link" href="#">Product Name</span></div>
            <div class="header__item"><span class="filter__link filter__link--number" href="#">Quantity</span></div>
            <div class="header__item"><span class="filter__link filter__link--number" href="#">Product Price</span></div>
            <div class="header__item"><span class="filter__link filter__link--number" href="#">Total Price</span></div>
        </div>
        <div class="table-content">
        HTML;
        foreach($result as $reciept){
                echo <<<HTML
                    <div class="table-row">
                        <div class="table-data">{$reciept['productName']}</div>
                        <div class="table-data">{$reciept['quantity']}</div>
                        <div class="table-data">{$reciept['retailCost']}</div>
                        <div class="table-data">{$reciept['totalPrice']}</div>
                    </div>
                HTML;
        }
        echo "</div>";
    }
    public function getReciepts(){
        $result = $this->database->query("SELECT *,SUM(quantity) as totalQuantity,(products.manifactureCost * quantity) as cost FROM reciept,stockProducts,products WHERE products.ID = productID AND stockProducts.recieptID = reciept.ID GROUP BY recieptID");
        if(mysqli_num_rows($result) == 0){
            echo <<<HTML
                <div class="emptyClass">
                    <i class="fa-solid fa-circle-info"></i>
                    <h3>No stock reciepts were created</h3>
                </div>
            HTML;
        }
        else{
            $i = 0;
            $options = "";
            $j = 0;
            foreach($result as $reciept){
                $month = date("d F h:m",strtotime($reciept['createdAt']));
                $options .= "<option id=month$j value='$j'>Reciept: $month</option>";
                $j+=1;
            }
            $options =  "
                <select onChange='searchDate(this.value)' id=datesearch>
                    {$options}
                </select>
            ";
            echo "<input type='hidden' id='recieptCount' value=".mysqli_num_rows($result).">";
            foreach($result as $reciept){
                $creationDate = date("d/m/Y", strtotime($reciept['createdAt']));
                
                echo <<<HTML
                    <div class=recieptClass id=reciept$i>
                        
                        <h1>Reciepts</h1>
                        <hr>
                        {$options}
                        <p>{$reciept['cost']} EGP</p>
                        <p>{$reciept['totalQuantity']}</p>
                        <p>$creationDate</p>
                        <button onclick="viewReciept({$reciept['recieptID']})">view reciept</button>
                        <br>
                        <button class = prevPro onclick='recieptp($i)'><i class="fa-solid fa-angle-left"></i> PREVIOUS PRODUCT</button>
                        <button class = nextPro onclick='recieptn($i)'>NEXT PRODUCT <i class="fa-solid fa-angle-right"></i></button>
                    </div>
                HTML;
                $i+=1;
            }
        }
    }
    public function displayRecieptsPrices(){
        $result = $this->database->query("SELECT *,SUM(quantity) as totalQuantity,(products.manifactureCost * SUM(quantity)) as stockPrice FROM stockProducts,products WHERE stockproducts.productID = products.ID GROUP BY productName");
        if(mysqli_num_rows($result) == 0){
            echo <<<HTML
                <div class="emptyClass">
                    <i class="fa-solid fa-circle-info"></i>
                    <h3>No stock reciepts were created</h3>
                </div>
            HTML;
        }
        else{
            $i = 0;
            echo "<input type='hidden' id=stockRecieptCount value=".mysqli_num_rows($result).">";
            foreach($result as $stock){
                
                echo <<<EOS
                    <div class="dataClass" id=stock{$i}>
                        <h1>Stock Products Costs</h1>
                        <hr>
                        <h3>{$stock['productName']}</h3>
                        <p>The total cost paid to this product <strong>{$stock['stockPrice']} EGP</strong> </p>
                        <p>Quantity: &nbsp;&nbsp;<strong>{$stock['totalQuantity']}</strong></p>
                        <button class = prevPro onclick='recieptPrev($i)'><i class="fa-solid fa-angle-left"></i> PREVIOUS PRODUCT</button>
                        <button class = nextPro onclick='recieptNext($i)'>NEXT PRODUCT <i class="fa-solid fa-angle-right"></i></button>

                    </div>
                EOS;
                $i+=1;
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