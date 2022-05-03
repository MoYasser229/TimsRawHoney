<?php

class shop extends View{
    public function output(){
        $title = $this->model->title;
        $shop=$this->model->shop();

        require_once APPROOT . "/views/inc/header.php";
        ?>
        <html lang>
        <head>
        <title>Shop</title>
        <link rel="stylesheet" href="<?php echo URLROOT. "css/shopStyle.css" ?>">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        </head>
        <body>
        <div class="search__container">
             <input class="search__input" type="text" placeholder="Search">
        </div>
        <div class="container">
        <h2>best selling</h2>      
      </div>
      <hr class= "header">
        <div class="row">
          <?php
          foreach($shop as $row)
          {
         ?>
          <div class="col-md-3 col-sm-6">
            <div class="product-grid">
           
              <div class="product-image">
              <a class = "image" type="hidden" name="hidden_name" href="<?php echo URLROOT.'pages/product' ?>?id=<?php echo $row['ID']; ?>"><img src="<?php echo IMAGEROOT.$row["productImage"]; ?>" class="model" /></a><br />
                
              <!-- <span class="product-discount-label">-10%</span>
                <ul class="product-links">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-random"></i></a></li>
                </ul> -->

                <a href="" class="add-to-cart">Add to Cart</a>
              </div>
              <div class="product-content">
                <!-- <h3 class="title"><a href="#">Sage Honey</a></h3> -->
                <h4 class="title"><?php echo $row["productName"]; ?></h4>
                <!-- <div class="price">$53.55 <span>$68.88</span></div> -->
                <div class="price">$ <?php echo $row["retailCost"]; ?></div>
              </div>
            </div>
          </div>
          <?php
          }
          ?>
     
      </body>
      </html>
      <?php
    }
}
?>  