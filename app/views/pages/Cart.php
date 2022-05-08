<?php 
class Cart extends View{
    public function output(){
        $title = $this->model->title;
    //     $id=$_GET['id'];
    //     $name=$this->model->getName($id);
    //     $Image=$this->model->getimage($id);
    //  $cost=$this->model->getCost($id);
    // $offer =$this->model->getOffer($id);
    // $material= $this->model->getMaterial($id);
    // $size=$this->model->getSize();
        require_once APPROOT . "/views/inc/header.php";
        //         $text = <<<EOT
                
        // EOT;
        //         echo $text . "<a href = '".URLROOT."pages/test'>Click me</a>";
        ?>
        <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="<?php echo URLROOT . 'css/CartStyle.css'; ?>">
                <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
                <title>Tim's Raw Honey</title>
            </head>
            <div class="wrap cf">

  <div class="heading cf">
    <h1>My Cart</h1>
    <a href="#" class="continue">Continue Shopping</a>
  </div>
  <div class="cart">
<!--    <ul class="tableHead">
      <li class="prodHeader">Product</li>
      <li>Quantity</li>
      <li>Total</li>
       <li>Remove</li>
    </ul>-->
    <ul class="cartWrap">
    <?php
    if(isset($_COOKIE["cart".$_SESSION["ID"]]))
    {
     $total = 0;
     $cookie_data = stripslashes($_COOKIE["cart".$_SESSION["ID"]]);
     $cart_data = json_decode($cookie_data, true);
     foreach($cart_data as $keys => $values)
     {
       ?>
    
      <li class="items odd">
        
    <div class="infoWrap"> 
        <div class="cartSection">
        <img src="<?php echo $values["productImage"]; ?>" alt="" class="itemImg" />
          <p class="itemNumber">#QUE-007544-002</p>
          <h3><?php echo $values["productName"]; ?></h3>
        
           <p> <input type="text"  class="qty" placeholder="<?php echo $values["quantity"];?>"/> x <?php echo $values["productPrice"];?></p>
        
          <p class="stockStatus"> In Stock</p>
        </div>  
    
        
        <div class="prodTotal cartSection">
          <p>$ <?php echo number_format($values["quantity"] * $values["productPrice"], 2);?></p>
        </div>
              <div class="cartSection removeWrap">
           <a href="    #" class="remove">x</a>
        </div>
      </div>
      </li>
      <?php
     }
     ?>
     
    </ul>
  </div>
</div>
<script>// Remove Items From Cart
$('a.remove').click(function(){
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );
 
})

// Just for testing, show all items
  $('a.btn.continue').click(function(){
    $('li.items').show(400);
  })
  </script>
            <?php
}
else{
  echo "No data";
}
}
}
?>