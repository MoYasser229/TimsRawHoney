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
    public function checkProducts(){
        if(mysqli_num_rows($this->products) == 0){
            return 0;
        }
        return 1;
    }
    private $stockWarning;
    public function getStockWarning(){
        return $this->stockWarning;
    }
    public function setStockWarning($stockWarning){
        $this->stockWarning = $stockWarning;
    }
    public function checkStock(){
        $check = false;
        $this->databaseProducts();
        foreach($this->products as $product){
            $availableStock = $product['productStock'] - $this->getStock($product);
            if($check == false){
                if($availableStock == 0){
                    $check = true;
                    $this->setStockWarning("error");
                }
                else if($availableStock <= 5){
                    $check = true;
                    $this->setStockWarning('half');
                }
            }
        }
        if($check == false){
            $this->setStockWarning("none");
        }
    }
    public function checkProfit(){
        $check = false;
        $this->databaseProducts();
        foreach($this->products as $product){
            $profit = ceil((($product['retailCost'] - $product['manifactureCost'])/$product['manifactureCost'])*100);
            if($profit < 0){
                return true;
            }
        }
        return false;
    }
    public function getBestSeller(){
        $result = $this->database->query("SELECT productID,productName,COUNT(*) as quantity FROM products,orderitems WHERE orderitems.productID = ID GROUP BY ID ORDER BY quantity DESC LIMIT 1");
        return $result->fetch_assoc();
    }
    public function getZeroSeller(){
        $result = $this->database->query("SELECT *,COUNT(orderID) as numOrders FROM `products` LEFT JOIN orderitems ON products.ID = productID GROUP BY ID ORDER BY numOrders,manifactureCost ASC LIMIT 1");
        return $result->fetch_assoc();
    }
    public function deleteProduct($id){
        $this->database->query("DELETE FROM products WHERE id = $id");
    }
    public function editProduct($id,$name,$rcost,$mcost,$image){
        $this->database->query("UPDATE products SET productName = '$name',retailCost = '$rcost',manifactureCost = '$mcost', productImage = '{$image}' WHERE id = $id");
    }
    public function getEditInfo($ID){
        $edit = $this->database->query("SELECT * FROM products WHERE id = $ID")->fetch_assoc();
        
        echo "<br>
        <button class = closeForm onclick='dismiss()'>CANCEL</button>

        <h1>EDITING PRODUCT " . strtoupper($edit["productName"]). " </h1> 
        <hr>
        <span>Product Name:</span> <input type=text name=productName id=productName value='".$edit["productName"]."'><br>
        <span>Retail Cost:</span> <input type=text name=retailCost id=retailCost value={$edit["retailCost"]}><br>
        <span>Manifacture Cost:</span> <input type=text name=manifactureCost id=manifactureCost value={$edit["manifactureCost"]}><br>
        <br><br>
        <div class='file-input2'>
                    <input name=productImage type='file' id='file2' class='file2' value={$edit["productImage"]} accept='image/*'>
                    <input id=imageName type=hidden name=existingImage value={$edit['productImage']}>
                    <label for='file2'>
                    <i class='fa-solid fa-upload'></i>&nbsp; Upload Image
                        
                    </label>
                    <p id='file-name2'></p>
                    </div>
        Description: <textarea name=description id=description value={$edit["productDescription"]}>{$edit["productDescription"]}</textarea>
        <button id = submitEdit name = submitEdit onclick='submitEdit()' value='{$edit['ID']}'>EDIT PRODUCT</button>
        <div id=errorMessage></div>
        ";
    }
    public function getProducts(){
        if($this->checkProducts() == 0){
            echo "<div class='emptyList'>
                <i class='fa-solid fa-triangle-exclamation'></i>
                <p>Nothing Found. Please check that the product searched is an actual product or add a new product. </p>
            </div>";
            
        }
        else{
            $check = false;
            echo "<div class='gridProduct'>";
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
                <div class='productCard' id=edit{$product['ID']}>
                            <button id=deleteButton onclick='deleteProduct(this.value)' class ='deleteProduct' value = '{$product['ID']}'>DELETE PRODUCT</button>
                            <div class='smallGrid2'>
                                
                                <img src='".IMAGEROOT."product/".$product['productImage']."'> 
                                 
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
                            <h1>PRODUCT DESCRIPTION</h1>
                            <h4 class = descProduct>{$product['productDescription']}</h4>
                            <button onclick='editProduct(this.value)' value='{$product['ID']}'  class ='productButtons2'>EDIT PRODUCT</button>
                            
                        </div>
                ";

            }
            
            echo "</div>";
        }
        
    }
    public function searchProduct($search){
        $result = $this->database->query("SELECT * FROM products WHERE (productName LIKE '%$search%')");
        $this->products = $result;
    }
    public function sortProducts($type,$filter){
        if($type == 'stock'){
            $result = $this->database->query("SELECT *,sum(productStock - quantity) FROM (SELECT * FROM (SELECT  COUNT(*) as quantity,productID FROM products LEFT JOIN orderitems ON orderitems.productID = ID GROUP BY productID) as livestock RIGHT JOIN products ON livestock.productID = products.ID) as stock GROUP BY ID ORDER BY `sum(productStock - quantity)` $filter");
            $this->products = $result;
        }
        else{
            $result = $this->database->query("SELECT * FROM products ORDER BY $type $filter");
            $this->products = $result;
        }
        
    }

}