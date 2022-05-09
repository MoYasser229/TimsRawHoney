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
                
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
                <title>Tim's Raw Honey</title>
            </head>
            <div class="wrap cf">

  <div class="heading cf">
    <h1>My Cart</h1>
    <a href="<?php echo URLROOT.'pages/Shop' ?>" class="continue">Continue Shopping</a>
  </div>
  <div class="cart" role="document">
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
      
      <li class="items odd"  id="productsection<?php echo $values["productID"];?>">
        
    <div class="infoWrap" > 
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
           
           <input  class="remove" id="productid<?php echo $values["productID"];?>" type="submit" name="productid" value="<?php echo $values["productID"];?>" ></input>
        </div>
      </div>
      </li>
      <script>// Remove Items From Cart

$(document).ready(function(){
$('#productid'+<?php echo $values["productID"];?>).click(()=>{

  productid=$('#productid'+<?php echo $values["productID"];?>).val();
  

  $.ajax({
        type: 'POST',
        url: 'Cart',
        data:{"productid":productid},
        success: (result)=>{
          $('#productsection'+<?php echo $values["productID"];?>).remove();
          
        }
    })
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );
 
});
});
</script>
      <?php
      
     }
     ?>
     
    </ul>
  </div>
  <div class="promoCode"><label for="promo">Have A Promo Code?</label><input type="text" name="promo" placholder="Enter Code" />
  <a href="#" class="btn"></a></div>
  
  <div class="subtotal cf">
    <ul>
      <li class="totalRow"><span class="label">Subtotal</span><span class="value">$35.00</span></li>
      
          <li class="totalRow"><span class="label">Shipping</span><span class="value">$5.00</span></li>
      
            <li class="totalRow"><span class="label">Tax</span><span class="value">$4.00</span></li>
            <li class="totalRow final"><span class="label">Total</span><span class="value">$44.00</span></li>
      <li class="totalRow"><a href="#" class="btn continue">Checkout</a></li>
    </ul>
  </div>
</div>
</div>


<script>
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