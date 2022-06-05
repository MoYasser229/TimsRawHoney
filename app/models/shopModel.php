<?php
require_once"filter.php";
class ShopModel extends model implements filter
{
     public $title = "Tim's Raw Honey";
     public function getimage($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return IMAGEROOT . $result -> fetch_assoc()['productImage'];
      }
      public function getCost($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productCost'];
      }
      public function getOffer($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productCost']*90/100;
      }
      public function getProductId(){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['ID'];
      }
      public function getProductName($ID){
          $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
          return $result -> fetch_assoc()['productName'];
      }
      public function shop(){
          $result = $this->database->query("SELECT * FROM products");
          return $result;
      }
      public function getProducts($products){

          foreach($products as $product){
              $valueOne=IMAGEROOT."product/".$product["productImage"];
              $valueTwo=URLROOT.'pages/Cart';
              $valueThree=URLROOT.'pages/signup';
              $valueFour=URLROOT.'pages/product';
              $valueFive= "<a href='{$valueThree}'</a>";


              if(isset($_SESSION['ID'])){
                $valueFive= "<a href='{$valueTwo}?id= {$product['ID']}' class='add-to-cart'></a>";
                }

              echo<<<HTML
                <div class="col-md-3 col-sm-6">
                    <div class="product-grid">
                        <div class="product-image">
                            <a class = "image" type="hidden" name="hidden_name" href="{$valueFour}?id={$product['ID']}"><img src="{$valueOne}" class="model" width="300px" height = "300px"/></a><br/>
                            </div>
                            <div class="product-content">
                                <!-- <h3 class="title"><a href="#">Sage Honey</a></h3> -->
                                <h4 class="title">{$product["productName"]} </h4>
                                <!-- <div class="price">$53.55 <span>$68.88</span></div> -->
                                <div class="price"> {$product["retailCost"]}  EGP </div>
                            </div>
                            </div>
                        </div>
              HTML;
          }  
      }
      public function search($table,$columns,$search){
        $result = $this->database->query("SELECT * FROM $table WHERE ($columns LIKE '%$search%')");
        return $result;
      }
      public function sort($table,$type,$fitler){
            $result = $this->database->query("SELECT * FROM $table ORDER BY $type $filter");
            $this->products = $result;
    }
}

