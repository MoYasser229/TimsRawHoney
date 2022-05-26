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
    public function search($search){
        $result = $this->database->query("SELECT * FROM products WHERE (productName LIKE '%$search%') OR (productStock LIKE '%$search%')");
        $this->products = $result;
    }
    public function filter($type,$filter){
        $result = $this->database->query("SELECT * FROM products ORDER BY $type $filter");
        $this->products = $result;
    }
    public function getReciept($ID){
        $result = $this->database->query("SELECT *,(quantity * retailCost) as totalPrice FROM stockProducts,reciept,products WHERE reciept.ID = $ID AND reciept.ID = recieptID AND productID = products.ID");
        $quantity = 0;
        $totalPrice = 0;
        $date = $this->database->query("SELECT createdAt FROM reciept WHERE ID = $ID")->fetch_assoc()['createdAt'];
        $formatDate = date("D d F Y  h:m",strtotime($date));
        echo <<<HTML
        <h1>Reciept #{$ID}</h1>
        <hr>
        <h2>PRODUCTS</h2>
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
                $quantity += $reciept['quantity'];
                $totalPrice += $reciept['totalPrice'];

        }
        echo "</div></div>";
        echo <<<HTML
            <p>Quantity: <strong>{$quantity}</strong></p>
            <p>Total Price: <strong>{$totalPrice} EGP</strong></p>
            <p>Date of Issue: <strong>{$formatDate}</strong></p>

        HTML;
    }
    public function insertReciept($products,$quantities){
        $this->database->query("INSERT INTO reciept() VALUES()");
        $result = $this->database->query("SELECT * FROM reciept ORDER BY ID DESC LIMIT 1")->fetch_assoc()['ID'];

        foreach(array_combine($products,$quantities) as $product => $quantity){
            $this->database->query("UPDATE products SET productStock = ((SELECT productStock FROM products WHERE ID = '$product') + $quantity) WHERE ID = '$product'");
            $this->database->query("INSERT INTO stockProducts(recieptID,productID,quantity) VALUES('$result','$product','$quantity') ");
        }
        // redirect("stocks");
    }
    public function getReciepts(){
        $result = $this->database->query("SELECT *,SUM(quantity) as totalQuantity,SUM(quantity * retailCost) as cost FROM reciept,stockproducts,products WHERE reciept.ID = stockproducts.recieptID AND stockproducts.productID = products.ID GROUP BY recieptID;");
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
                $creationDate = date("D d F Y", strtotime($reciept['createdAt']));
                
                echo <<<HTML
                    <div class=recieptClass id=reciept$i>
                        <h1>Reciepts</h1>
                        <hr>
                        {$options}
                        <h3>Reciept Details</h3>
                        <p><strong>Total Cost: {$reciept['cost']} EGP</strong></p>
                        <p><strong>Quantity: {$reciept['totalQuantity']}</strong></p>
                        <p><strong>Date of Issue: $creationDate<strong></p>
                        <button class=viewReciept onclick="viewReciept({$reciept['recieptID']})">VIEW RECIEPT</button>
                        <br>
                        <button class = prevPro onclick='recieptp($i)'><i class="fa-solid fa-angle-left"></i> PREVIOUS RECIEPT</button>
                        <button class = nextPro onclick='recieptn($i)'>NEXT RECIEPT <i class="fa-solid fa-angle-right"></i></button>
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
            echo <<<HTML
                <div class='productCard'>
                <h1>{$product['productName']}</h1>
                    <hr>
                    <span class=stockInfo>Cost per one product: <strong>{$product['retailCost']} EGP </strong></span><br>
                    <span class = stockInfo>Current Stock: <strong>{$product['productStock']}</strong></span>
                    <!-- <p>Stock: <strong>{$product['productStock']}</strong></p> -->
                    <input type=hidden id=curStock{$product['ID']} value={$product['productStock']}>
                    <input type=hidden id = stockCost{$product['ID']} value = "{$product['retailCost']}">
                    <br>
                    <span class=stockInfo id=scost{$product['ID']}></span>
                    <input type = hidden id=currentStock value={$product['productStock']}>
                    <br>
                    <div class="stockChange">
                        <button class = stockUpdate onclick="decreaseStock({$product['ID']})"> <i class="fa-solid fa-minus"></i> </button><input class = stockInput onchange="stockChange(this.value,{$product['ID']})" type="text" value={$product['productStock']} id="productStock{$product['ID']}"><button class = stockUpdate onclick="increaseStock({$product['ID']})"> <i class="fa-solid fa-plus"></i> </button>
                    </div>
                </div>
            HTML;
        }
    }

}