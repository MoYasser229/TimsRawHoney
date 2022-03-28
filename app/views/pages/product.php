<?php
class product extends View{

public function output(){
    $title = $this->model->title;
    // require_once APPROOT . "/views/inc/header.php";

?>
<html>
<head>   
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . 'css/productstyle.css'; ?>">
    <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
    <title>Tim's Raw Honey</title>
</head>
<body>


<div class="container">
<img src = "<?php echo IMAGEROOT . 'jarr3.png' ; ?>" class="product-pic"/>
    <div class="product-details">
    <header>
      <h1 class="title">Immune Formula</h1>
      <!-- <span class="colorCat">mint green</span> -->
      <div class="price">
        <span class="before">$150</span>
        <span class="current">$144.99</span>
      </div>
      <div class="rate">
        <a href="#!" class="active">★</a>
        <a href="#!" class="active">★</a>
        <a href="#!" class="active">★</a>
        <a href="#!">★</a>
        <a href="#!">★</a>
      </div>
    </header>
    <article>
      <h5>Description</h5>
      <p>Propolis mixed honey
An immunity booster formula.
Delicious natural and healthy.
Propolis is a natural compount that bees produce from the sap on needle-leaved trees, trees and/or evergreens. Bees mix Sap mixed with their secreations and beeswax forming a sticky, greenish-brown product used as a coating and blocking cracks in the hive and many more in-hive usage.
Our ancestors used propolis for its medicinal properties. Every ancient civilization used propolis for its beneficial, it was proven to treat abscesses, wounds and tumors, fights infection and help the healing process. Furthermore, old Egyptians used it to embalm mummies.
Propolis, like all natural products, vary according to type of producers (bees), and location. Where the trees, herbs and floweres vary from a region to another which bees has the access to. What I meanis that propolis from Europe won’t have the same charactaristics as propolis from Brazil, and will differ from propolis from the middle Easter or Iran. Although, the general features of propolis prevails.</p>
    </article>
    <div class="controls">
      <div class="color">
       
        <ul>
          <li><a href="#!" class="colors color-bdot1 active"></a></li>
          <!-- <li><a href="#!" class="colors color-bdot2"></a></li>
          <li><a href="#!" class="colors color-bdot3"></a></li>
          <li><a href="#!" class="colors color-bdot4"></a></li>
          <li><a href="#!" class="colors color-bdot5"></a></li> -->
        </ul>
        <h5>In stock (Over 100 units), ready to be shipped</h5>
      </div>
      
      <div class="qty">
        <h5>qty</h5>
        <a href="#!" class="option">(1)</a>
      </div>
    </div>
    <div class="footer">
      <button type="button">
        <img src="http://co0kie.github.io/codepen/nike-product-page/cart.png" alt="">
        <span>add to cart</span>
      </button>
       <a href="#!"><img src="http://co0kie.github.io/codepen/nike-product-page/share.png" alt=""></a>
    </div>
  </div>
  
</div>
<div>
<h3 class ="review">Reviews</h3>
</div>

</body>

</html>
<?php

}


}
?>