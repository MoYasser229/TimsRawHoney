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
      <hr class= "header">
        <di class="row">
          <div class="col-md-3 col-sm-6">
            <div class="product-grid">
              <div class="product-image">
                <a href="#" class="image">
                    <img src="<?php echo IMAGEROOT ."jar3.jpg"; ?>"class ="model">
                </a>
                <span class="product-discount-label">-10%</span>
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
                <img src="<?php echo IMAGEROOT . "jar3.jpg"; ?>"class ="model">
              </a>
              <span class="product-discount-label">-31%</span>
              <ul class="product-links">
                <li><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-random"></i></a></li>
              </ul>
              <a href="" class="add-to-cart">Add to Cart</a>
            </div>
          <div class="product-content">
            <h3 class="title"><a href="#">Acacia Honey</a></h3>
            <div class="price">$75.55<span>$100.00</span></div>
          </div>
          </div>
        </div>  
      </div>


      <br<br><br>
      <hr/>


      <di class="row">
          <div class="col-md-3 col-sm-6">
            <div class="product-grid">
              <div class="product-image">
                <a href="#" class="image">
                    <img src="<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">
                </a>
                <span class="product-discount-label">-50%</span>
                <ul class="product-links">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-random"></i></a></li>
                </ul>
                <a href="" class="add-to-cart">Add to Cart</a>
              </div>
              <div class="product-content">
                <h3 class="title"><a href="#">Clover honey</a></h3>
                <div class="price">$20.00 <span>$40.88</span></div>
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
            <h3 class="title"><a href="#">Wildflower honey</a></h3>
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
            <h3 class="title"><a href="#">Dandelion honey</a></h3>
            <div class="price">$75.55</div>
          </div>
          </div>
        </div>  
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
                <h3 class="title"><a href="#">Orange blossom honey</a></h3>
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
              <span class="product-discount-label">-19%</span>
              <ul class="product-links">
                <li><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-random"></i></a></li>
              </ul>
              <a href="" class="add-to-cart">Add to Cart</a>
            </div>
          <div class="product-content">
            <h3 class="title"><a href="#">Linden honey</a></h3>
            <div class="price">$52.50s<span>$68.88</span></div>
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
            <h3 class="title"><a href="#">Manuka honey</a></h3>
            <div class="price">$60.33</div>
          </div>
          </div>
        </div>  
      </div>


      <di class="row">
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
                <h3 class="title"><a href="#"> Buckwheat honey</a></h3>
                <div class="price">$33.55</div>
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
            <h3 class="title"><a href="#">Eucalyptus honey</a></h3>
            <div class="price">$20.55</div>
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
              <span class="product-discount-label">-20%</span>
              <ul class="product-links">
                <li><a href="#"><i class="fa fa-search"></i></a></li>
                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                <li><a href="#"><i class="fa fa-random"></i></a></li>
              </ul>
              <a href="" class="add-to-cart">Add to Cart</a>
            </div>
          <div class="product-content">
            <h3 class="title"><a href="#">ASTER HONEY</a></h3>
            <div class="price">$75.55<span>$100.88</span></div>
          </div>
          </div>
        </div>  
      </div>


      <di class="row">
          <div class="col-md-3 col-sm-6">
            <div class="product-grid">
              <div class="product-image">
                <a href="#" class="image">
                    <img src="<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">
                </a>
                <span class="product-discount-label">-48%</span>
                <ul class="product-links">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                    <li><a href="#"><i class="fa fa-random"></i></a></li>
                </ul>
                <a href="" class="add-to-cart">Add to Cart</a>
              </div>
              <div class="product-content">
                <h3 class="title"><a href="#">IRONBARK HONEY</a></h3>
                <div class="price">$120.55 <span>$220.88</span></div>
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
            <h3 class="title"><a href="#">AVOCADO HONEY</a></h3>
            <div class="price">$80.55</div>
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
            <h3 class="title"><a href="#">Macadamia honey</a></h3>
            <div class="price">$50.51</div>
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