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

  <div class="heading cf" >
    <h1>My Cart</h1>
    <a href="<?php echo URLROOT.'pages/Shop' ?>" class="continue">Continue Shopping</a>
    
  </div>
  <br>
  <?php if(!empty($_COOKIE["cart".$_SESSION["ID"]])){?>
    <div class="addressPick">
      <h1>First, Confirm an address</h1>
      <br>
      <?php
        $this->model->getAddresses($_SESSION['ID']);
      ?>
      <div id="errorAddress"></div>
    </div>
 <?php }?>
  <div class="cart" role="document" id="cartdata">
    <a href="" class="clear" id="clear" value="clear">Clear cart</a>
<!--    <ul class="tableHead">
      <li class="prodHeader">Product</li>
      <li>Quantity</li>
      <li>Total</li>
       <li>Remove</li>
    </ul>-->
    <ul class="cartWrap" >
    <?php
    if(isset($_COOKIE["cart".$_SESSION["ID"]]))
    {
     
     $total = 0;
     $cookie_data = stripslashes($_COOKIE["cart".$_SESSION["ID"]]);
     $cart_data = json_decode($cookie_data, true);
     $str="";
     foreach($cart_data as $keys => $values)
     {
      $maxQuantity=$this->model->getQuantity($values["productID"]);
      $total = $total + ($values["quantity"] * $values["productPrice"]);
       ?>
 
      <li class="items odd"  id="productsection<?php echo $values["productID"];?>">
  
    <div class="infoWrap" > 
        <div class="cartSection">

        <img src="<?php echo $values["productImage"]; ?>" alt="" class="itemImg" />
        <input type="hidden" id="productimage<?php echo $values["productID"];?>" name="productimage<?php echo $values["productID"];?>" value="<?php echo $values["productImage"]; ?>"></input>
          <p class="itemNumber">#QUE-007544-002</p>
          <h3><?php echo $values["productName"];  ?></h3>
          <input type="hidden" id="productname<?php echo $values["productID"];?>"name="productname<?php echo $values["productID"];?>" value="<?php echo $values["productName"]; ?>"></input>
         
          
           <p> <input type="number" name="quantity<?php echo $values["productID"];?>" id="quantity<?php echo $values["productID"];?>" min="1" max="<?php echo  $maxQuantity?>" class="form-control" value="<?php echo $values["quantity"];?>" onchange="updatecart(<?php echo $values['productID'];?>)"> x <?php echo $values["productPrice"];?></p>
           <input type="hidden" id="productprice<?php echo $values["productID"];?>"name="productprice<?php echo $values["productID"];?>" value="<?php echo $values["productPrice"];?>"></input>
          <p class="stockStatus"> In Stock</p>
          
        </div>  
    
        
        <div class="prodTotal cartSection">
          <p>$ <?php echo number_format($values["quantity"] * $values["productPrice"], 2);?></p>
        </div>
              <div class="cartSection removeWrap">
              <a  class="remove" id="remove<?php echo $values["productID"];?>" value="remove" >x</a>
           <input  type="hidden" id="productid<?php echo $values["productID"];?>" type="submit" name="productid" value="<?php echo $values["productID"];?>" ></input>
        </div>
      </div>
 
      </li>
      <script>// Remove Items From Cart

$(document).ready(function(){
$('#remove'+<?php echo $values["productID"];?>).click(()=>{

  productid=$('#productid'+<?php echo $values["productID"];?>).val();
  remove=$('#remove'+<?php echo $values["productID"];?>).val();


  $.ajax({
        type: 'POST',
        url: 'Cart',
        data:{"productid":productid,"remove":remove},
        success: (result)=>{
          $('#cartdata').html(result);
       
          
        }
    })
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );
 
});

$('#clear').click(()=>{

clear=$('#clear').val();


$.ajax({
      type: 'POST',
      url: 'Cart',
      data:{"clear":clear},
      success: (result)=>{
        $('#cartdata').html(result);
     
        
      }
  })
  event.preventDefault();
  $( this ).parent().parent().parent().hide( 400 );

});


});
function PromoCode(){
  promoCode=$('#promo').val();
  total=$('#totalPrice').val();
  $.ajax({
    type: 'POST',
      url: 'Cart',
      data:{"promoCode":promoCode},
      success: function(result){
          // $('#cartdata').html(result);
          if(result=='false'){
            $('#error').css('display', 'block');
            $('#success').css('display', 'none');
          }
          else{
            $('#success').css('display', 'block');
            $('#error').css('display', 'none');
            $('#success').html("You have a "+result+"% discount <a href=Cart>Cancel</a>");
            discountPrice=(parseInt(result)/100)*total;
            afterDiscount=total-discountPrice;
            $('#discount').html("<li class='totalRow final'><span class=label>Discount</span><span class=value> -"+discountPrice+"</span></li><li class='totalRow final'><span class=label>Final price</span><span class=value>"+afterDiscount+"</span></li><input type=hidden name=newTotal id=newTotal value="+afterDiscount+"><input type=hidden name=promoID id=promoID value="+promoCode+">");
            
            
          }
          
        }
  })
}
function updatecart(id){
  productid=$('#productid'+id).val();
  quantity=$('#quantity'+id).val();
  <?php
       echo "var maxQuantity ='$maxQuantity';";
   ?>

  if(quantity==''){
    alert("Number field cannot be empty");
    quantity=1;
  }
  if(quantity > <?php echo $maxQuantity?>){
    alert("Sorry the max quantity is <?php echo $maxQuantity?>");
    quantity=maxQuantity;
  }
  if(quantity<1){
    alert("Sorry the min quantity is 1");
    quantity=1;
  }



 
  $.ajax({
    type: 'POST',
      url: 'Cart',
      data:{"productid":productid,"quantity":quantity},
      success: function(result){
          $('#cartdata').html(result);
          
        }
  })
}
address = ""
  function pickAddress(ID,counter){
    address =  ID;
    inverse = (counter == 1)?0:1;
    $(".addressPick #addr"+counter).css({
      'background-color':"white",
      "color":"black"
    })
    $(".addressPick #addr"+inverse).css({
      'background-color':"transparent",
      "color":"gray"
    })
  }

  function chosenAddress(){
    return address;
  }
function checkout(){
checkout=$('#checkout').val();
newTotal="";
if($('#newTotal').val()){
newTotal= $('#newTotal').val(); 

}
promoCode1="";
if($('#promoID').val()){
promoCode1= $('#promoID').val(); 

}

if(chosenAddress() == ""){
      // error = true
      location.reload();
      alert('Please Pick an address to proceed');
      
    
    }
    else{
      // alert("hena")
      $.ajax({
            type: 'POST',
            url: 'Cart',
            data:{"checkout":checkout,"newTotal":newTotal,"promoCode1":promoCode1,"address":chosenAddress()},
            success: (result)=>{
              // alert(result)
               $('#cartdata').html(result);
                $('#exampleModal').modal('show');
              $(".addressPick").html("")
              
            }
        })
      event.preventDefault();
      $( this ).parent().parent().parent().hide( 400 );
    }

}
</script>

      <?php
      $quantity=$values["quantity"];
      
       $productname=$values["productName"];

       
       $productprice=$values["productPrice"];
       $str.=$productname." (".$quantity.") ,";
       
     }
     $finaltotal=number_format($total, 2);
     ?>
    
     
    </ul>
    <div class="promoCode"><label for="promo">Have A Promo Code?   <div id="result"><div class=errorclass id=error style="display:none"> the promo code is either expired or inactive</div>
  <div class=successclass id=success style="display:none"> </div>
    </div></label><input type="text" id="promo" name="promo" placholder="Enter Code" />
  <a onclick="PromoCode()" class="btn"></a></div>
  <input type="hidden" id="totalPrice" value=<?php echo $total?> >

  <div class="subtotal cf" id="total">
    <ul>

            <li class="totalRow final"><span class="label">Total</span><span class="value">$<?php echo number_format($total, 2);?></span></li>
            <div id=discount>

    </div>
      <li class="totalRow"><a class="greenButton btn continue" name="checkout" onclick="checkout()" id="checkout" value=checkout>Checkout</a></li>
    </ul>
  </div>
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
  echo "";
}
    }
  }