<?php
class product extends View{

public function output(){
    $title = $this->model->title;
     require_once APPROOT . "/views/inc/header.php";
    $Image=$this->model->getimage();
    $cost=$this->model->getCost();
    $offer =$this->model->getOffer();
    $material= $this->model->getMaterial();
    $size=$this->model->getSize();
?>
<html>
<head>   
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . 'css/productstyle.css'; ?>">
    <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    <title>Tim Raw Honey</title>
</head>
<body>
  <div id="wrap">
    <div id="product_layout_1">
      <div class="top">
      <div class="product_images">
        <div class="product_image_1">
        <img src = "<?php echo $Image ; ?>" /> 
        </div>
        <div class="product_image_small">
          <div class="product_image_2">
          <img src = "<?php echo $Image ; ?>" /> 
          </div>
                    <div class="product_image_3">
                    <img src = "<?php echo $Image ; ?>" /> 
          </div>
                    <div class="product_image_4">
                    <img src = "<?php echo $Image ; ?>" /> 
          </div>
        </div>
        </div>
        <div class="product_info">
          <h1>Immune Formula</h1>
          <div class="price">
          <h2 class="original_price"><?php echo $cost?></h2>
          <h2 class="sale_price"><?php echo $offer?></h2>
          </div>
          <div class="rating">
            <i class="fa fa-star fa-3x"></i><i class="fa fa-star fa-3x"></i><i class="fa fa-star fa-3x"></i><i class="fa fa-star-half-o fa-3x"></i><i class="fa fa-star-o fa-3x"></i>
          </div>
          <div class="product_description">
          <p>An immunity booster formula.
Delicious natural and healthy.
Propolis is a natural compount that bees produce from the sap on needle-leaved trees, trees and/or evergreens. Bees mix Sap mixed with their secreations and beeswax forming a sticky, greenish-brown product used as a coating and blocking cracks in the hive and many more in-hive usage.</p>
          </div>
         <div class="related_info">
           <span class="sku">SKU:1234567</span><span class="quantity">QTY:85</span>
         </div>
         <div class="options">
         <div class="buying_options">
         
                 <div class="select">
                 <select id="color">
                   <option value = "1"><?php echo $material[0][0] ?></option>
                   <option value = "2"><?php echo $material[0][1] ?></option>
                   
                 </select>
                 </div>
                 <div class="select">
                 <select id="size">
                   <option value = "1"><?php echo $size[0][0]?></option>
                   <option value = "2"><?php echo $size[0][1]?></option>
                   <option value = "3"><?php echo $size[0][2]?></option>
                   <option value = "4"><?php echo $size[0][3]?>e</option>
                 </select>
                 </div>
          </div>
          <div class="buying">
                 <div class="quantity">
                   <label for="quantity">QTY:</label>
                   <input type="text">
                 </div>
                 <div class="cart">
                   <a href="#" class="add">Add to Cart <i class="fa fa-shopping-cart fa-lg"></i></a>
                 </div>
          </div>
          </div>
                 <div class="social">
                   <span class="share">Share This:</span><span class="buttons"><img src="https://i.imgur.com/M8D8rr8.jpg"/></span>
           </div>
          </div>
        </div>
        <div class="bottom">
        <div class="reviews">
          <div class="head">
            <h2>Reviews</h2>
          </div>
            <div class="content">
              <span class="name">Marty McFly</span><span class="stars"><i class="fa fa-star fa-2x"></i><i class="fa fa-star fa-2x"></i><i class="fa fa-star fa-2x"></i><i class="fa fa-star-half-o fa-2x"></i><i class="fa fa-star-o fa-2x"></i></span>
              <p class="review_text">"Check out that four by four. That is hot. Someday, Jennifer, someday. Wouldn't it be great to take that truck up to the lake. Throw a couple of sleeping bags in the back. Whoa, wait, Doc. Here you go, lady. There's a quarter. Well, it will just happen. Like the way I met your father..."</p>
              <p class="fullReview"><a href="#">View Full Review</a></p>
              <span class="writeReview"><a href="#">Write your Own Review</a></span>
            </div>
          </div>
      
</body>

</html>
<?php

}


}
?>