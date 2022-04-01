<?php

class shop extends View{
    public function output(){
        $title = $this->model->title;
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

        <di class="row">
          <div class="col-md-3 col-sm-6">
            <div class="product-grid">
              <div class="product-image">
                <a href="#" class="image">
                    <img src="<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">
                </a>
                <span class="product-discount-label">-23%</span>
                <ul class="product-links">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-random"></i></a></li>
                </ul>
                <a href="" class="add-to-cart">Add to Cart</a>
              </div>
              <div class="product-content">
                <h3 class="title"><a href="#">Sage Honey</a></h3>
                <div class="price">$53.55 <span>$68.88</span></div>
              </div>
            </div>
          </div>


        <div class="col-md-3 col-sm-6">
          <div class="product-grid">
            <div class="product-image">
              <a href="#" class="image">
                <img src="<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">
              </a>
              <ul class="product-links">
                <li><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-random"></i></a></li>
              </ul>
              <a href="" class="add-to-cart">Add to Cart</a>
            </div>
          <div class="product-content">
            <h3 class="title"><a href="#">Sourwood Honey</a></h3>
            <div class="price">$75.55</div>
          </div>
          </div>
        </div>  


      <div class="col-md-3 col-sm-6">
          <div class="product-grid">
            <div class="product-image">
              <a href="#" class="image">
                <img src="<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">
              </a>
              <ul class="product-links">
                <li><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-random"></i></a></li>
              </ul>
              <a href="" class="add-to-cart">Add to Cart</a>
            </div>
          <div class="product-content">
            <h3 class="title"><a href="#">Tupelo Honey</a></h3>
            <div class="price">$75.55</div>
          </div>
          </div>
        </div>  
      </div>

      
      <div class="col-md-3 col-sm-6">
          <div class="product-grid">
            <div class="product-image">
              <a href="#" class="image">
                <img src="<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">
              </a>
              <ul class="product-links">
                <li><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-random"></i></a></li>
              </ul>
              <a href="" class="add-to-cart">Add to Cart</a>
            </div>
          <div class="product-content">
            <h3 class="title"><a href="#">Acacia Honey</a></h3>
            <div class="price">$75.55</div>
          </div>
          </div>
        </div>  
      </div>
      </body>
      </html>
      <?php
    }
}
?>  