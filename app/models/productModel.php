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
    public function getProductDescription($ID){
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productDescription'];
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
    public function getStock($ID){
        $result = $this->database->query("SELECT * FROM products WHERE ID= $ID");
        return $result -> fetch_assoc()['productStock'];
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
        $result=$this->database->query("SELECT * FROM review WHERE customerID = $ID");

        if(mysqli_num_rows($result)<1){
        $this->database->query("INSERT INTO review(customerID,productID,stars,reviewText) VALUES('$ID','$productID','$stars','$reviewText')");
    }
    else{
        echo '<script>alert("error, You already reviewed this product")</script>';
   }

}
    public function displayReview($productID){
        $result=$this->database->query("SELECT * FROM review,users where productID = $productID AND review.customerID = users.ID ");
        $average_rating = 0;
        $total_user_rating = 0;
        $total_review = 0;
       
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
        $total_review++;
        $total_user_rating = $total_user_rating + $product["stars"];
        
        }
    
    
        // if($total_review>0)
        // $average_rating = $total_user_rating / $total_review;
        // $output = array(
        //     'average_rating'    =>  number_format($average_rating, 1)
        // );
        // echo json_encode($output);

    }
    public function getAvgRat(){
        $result = $this->database->query("SELECT AVG(stars) as averageStars FROM `review` LIMIT 1")->fetch_assoc();
        
        return number_format($result['averageStars'], 1);

    }
    public function addtocart($customerID,$productID,$productname,$productimage,$productprice,$quantity,$material,$size){
        if(isset($_COOKIE["cart$customerID"])){
            $cookie_data = stripslashes($_COOKIE["cart$customerID"]);
            $cart_data = json_decode($cookie_data, true);
        }
        else
            $cart_data = array();
       
        $item_id_list = array_column($cart_data, 'productID');
       
        if(in_array($productID, $item_id_list)){
            foreach($cart_data as $keys => $values){
                if($cart_data[$keys]["productID"] == $productID)
                    if( $cart_data[$keys]["quantity"] + $quantity >0)
                        $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $quantity;
            }
        }
        else{
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



?>