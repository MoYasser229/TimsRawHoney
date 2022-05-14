<?php
class productModel extends Model{

    public $title = "Tim's Raw Honey";

    // public function getProductId($ID){
    //     $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
    //     return $result -> fetch_assoc()['ID'];
    // }
    public function getProductName($ID){
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productName'];
    }
    public function getimage($ID){
        // return IMAGEROOT . 'jarr3.png' ;
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productImage'];
    }
    public function getCost($ID){
        // return 90;
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['retailCost'];
    }
    public function getOffer(){
        return 75;
    }
    public function getMaterial(){
    return array(["Glass","Plastic"]);
    }
    public function getSize(){
        return array(["Small","Medium","Large","XLarge"]);
    }
    public function getName($ID){
        
        $result = $this->database->query("SELECT * FROM users WHERE ID= $ID");
        return $result -> fetch_assoc()['fullName'];
    }
    public function writereview($ID,$productID,$stars,$reviewText){
        $this->database->query("INSERT INTO review(customerID,productID,stars,reviewText) VALUES('$ID','$productID','$stars','$reviewText')");
    }
    public function displayReview($productID){
        $result=$this->database->query("SELECT * FROM review,users where productID = $productID AND review.customerID = users.ID ");
        foreach($result as $product){
            ?>
            <div class='content'>
            <span class='name'><?php echo $product['fullName'];?></span>
            <span class='stars'>
            <?php for($i=0;$i<$product['stars'];$i++){?>
            <i class='fa fa-star fa-2x text-warning'></i>
           
            <?php 
            }

          for($i=0;$i<(5-$product['stars']);$i++){?>
            <i class='fa fa-star fa-2x star-light'></i>
        <?php  
        }
        echo $product['stars'];
        ?>
            </span>
            <p class='review_text'><?php echo $product['reviewText'];?></p>
            <hr>
            <!-- <p class='fullReview'><a href='#'>View Full Review</a></p> -->
            
          </div>
          <?php

        }
    }

}



?>