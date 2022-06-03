<?php
class Carts{
    private $ID;
    private $products;
    private $price;
    private $quantity;

    public function __construct(){
       
    }

    public function getID(){
        return $this->ID;
    }

    public function getProducts(){
        return $this->products;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setID($ID){
        $this->ID = $ID;
    }

    public function setProducts($products){
        $this->products = $products;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    //cart product Operations  
    public function deletefromcart($customerID,$productID,$cartmodel){
        ?>
        <a href="" class="clear" id="clear" value="clear">Clear cart</a>
        <ul class="cartWrap" >
        <?php

       $cookie_data = stripslashes($_COOKIE['cart'.$customerID]);
$cart_data = json_decode($cookie_data, true);
$count=0;
foreach($cart_data as $keys => $values)
{
if($cart_data[$keys]['productID'] == $productID)
{
unset($cart_data[$keys]);
}
$item_data = json_encode($cart_data);
setcookie("cart$customerID", $item_data, time() + 2678400);
$count++;

?>

           <?php

} 

$cookie_data = stripslashes($_COOKIE['cart'.$customerID]);
$cart_data = json_decode($cookie_data, true);
if($count==1){
setcookie("cart".$customerID, "", time() - 2678400);
}


else
{

$str="";
$total = 0;
$cookie_data = stripslashes($_COOKIE["cart".$_SESSION["ID"]]);
$cart_data = json_decode($cookie_data, true);
foreach($cart_data as $keys => $values)
{
if($_POST['productid']==$values['productID']){

}
else{
   $quantity=$values["quantity"];
$total = $total + ($quantity * $values["productPrice"]); 

$maxQuantity=$cartmodel->getQuantity($values["productID"]);

?>

<li class="items odd"  id="productsection<?php echo $values["productID"];?>">

<div class="infoWrap" > 
<div class="cartSection">

<img src="<?php echo $values["productImage"]; ?>" alt="" class="itemImg" />
<input type="hidden" id="productimage<?php echo $values["productID"];?>" name="productimage<?php echo $values["productID"];?>" value="<?php echo $values["productImage"]; ?>"></input>
 <p class="itemNumber">#QUE-007544-002</p>
 <h3><?php echo $values["productName"]; ?></h3>
 <input type="hidden" id="productname<?php echo $values["productID"];?>"name="productname<?php echo $values["productID"];?>" value="<?php echo $values["productName"]; ?>"></input>

  <p> <input type="text" name="quantity<?php echo $values["productID"];?>" id="quantity<?php echo $values["productID"];?>" class="form-control" value="<?php echo $quantity?>" onchange="updatecart(<?php echo $values['productID'];?>)"></input> x <?php echo $values["productPrice"];?></p>
 
  <input type="hidden" id="productprice<?php echo $values["productID"];?>"name="productprice<?php echo $values["productID"];?>" value="<?php echo $values["productPrice"];?>"></input>
 <p class="stockStatus"> In Stock</p>
</div>  


<div class="prodTotal cartSection">
 <p>$ <?php echo number_format($quantity * $values["productPrice"], 2);?></p>
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
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header border-bottom-0">
                  
                 </div>
                 <div class="modal-body text-start text-black p-4">
                   <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel"><?php echo $profileData['fullName']; ?></h5>
                   <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                   <p class="mb-0" style="color: #35558a;">Payment summary</p>
                   <hr class="mt-2 mb-4"
                     style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
   
                   <div class="d-flex justify-content-between">
                     <p class="fw-bold mb-0"><?php echo $str?></p>
                     <p class="text-muted mb-0">$<?php echo $finaltotal?></p>
                   </div>
   
                   <!-- <div class="d-flex justify-content-between">
                     <p class="small mb-0">Shipping</p>
                     <p class="small mb-0">$175.00</p>
                   </div>
   
                   <div class="d-flex justify-content-between pb-1">
                     <p class="small">Tax</p>
                     <p class="small">$200.00</p>
                   </div> -->
   
                   <div class="d-flex justify-content-between">
                     <p class="fw-bold">Total</p>
                     <p class="fw-bold" style="color: #35558a;">$<?php echo $finaltotal?></p>
                   </div>
   
                 </div>
                 <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                   <button type="button" class="btn btn-primary btn-lg mb-1" style="background-color: #35558a;">
                     Track your order
                   </button>
                 </div>
               </div>
             </div>
           </div>
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
<?php

}

      }
      public function updatequantity($customerID,$productID,$quantity,$cartmodel){
        ?>
        <a href="" class="clear" id="clear" value="clear">Clear cart</a>
        <ul class="cartWrap" >
            <?php
        $cookie_data = stripslashes($_COOKIE['cart'.$customerID]);
$cart_data = json_decode($cookie_data, true);
foreach($cart_data as $keys => $values)
{
if($cart_data[$keys]['productID'] == $productID)
{

    $cart_data[$keys]["quantity"] = $quantity;
       
$item_data = json_encode($cart_data);
setcookie("cart$customerID", $item_data, time() + 2678400);
}
}

if(isset($_COOKIE["cart".$_SESSION["ID"]]))
{
$str="";
 $total = 0;
 $cookie_data = stripslashes($_COOKIE["cart".$_SESSION["ID"]]);
 $cart_data = json_decode($cookie_data, true);
 foreach($cart_data as $keys => $values)
 {
    if($_POST['productid']==$values['productID']){
        $quantity=$_POST["quantity"];
    }
    else{
        $quantity=$values["quantity"];
    }
    
    $maxQuantity=$cartmodel->getQuantity($values["productID"]);

    $total = $total + ($quantity * $values["productPrice"]); 

   ?>

  <li class="items odd"  id="productsection<?php echo $values["productID"];?>">

<div class="infoWrap" > 
    <div class="cartSection">

    <img src="<?php echo $values["productImage"]; ?>" alt="" class="itemImg" />
    <input type="hidden" id="productimage<?php echo $values["productID"];?>" name="productimage<?php echo $values["productID"];?>" value="<?php echo $values["productImage"]; ?>"></input>
      <p class="itemNumber">#QUE-007544-002</p>
      <h3><?php echo $values["productName"]; ?></h3>
      <input type="hidden" id="productname<?php echo $values["productID"];?>"name="productname<?php echo $values["productID"];?>" value="<?php echo $values["productName"]; ?>"></input>
   
       <p> <input type="number" name="quantity<?php echo $values["productID"];?>" id="quantity<?php echo $values["productID"];?>"min="1" max="<?php echo  $maxQuantity?>" class="form-control" value="<?php echo $quantity?>" onchange="updatecart(<?php echo $values['productID'];?>)"></input> x <?php echo $values["productPrice"];?></p>
      
       <input type="hidden" id="productprice<?php echo $values["productID"];?>"name="productprice<?php echo $values["productID"];?>" value="<?php echo $values["productPrice"];?>"></input>
      <p class="stockStatus"> In Stock</p>
    </div>  

    
    <div class="prodTotal cartSection">
      <p>$ <?php echo number_format($quantity * $values["productPrice"], 2);?></p>
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
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0">
                   
                  </div>
                  <div class="modal-body text-start text-black p-4">
                    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel"><?php echo $profileData['fullName']; ?></h5>
                    <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                    <p class="mb-0" style="color: #35558a;">Payment summary</p>
                    <hr class="mt-2 mb-4"
                      style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
    
                    <div class="d-flex justify-content-between">
                      <p class="fw-bold mb-0"><?php echo $str?></p>
                      <p class="text-muted mb-0">$<?php echo $finaltotal?></p>
                    </div>
    
                    <!-- <div class="d-flex justify-content-between">
                      <p class="small mb-0">Shipping</p>
                      <p class="small mb-0">$175.00</p>
                    </div>
    
                    <div class="d-flex justify-content-between pb-1">
                      <p class="small">Tax</p>
                      <p class="small">$200.00</p>
                    </div> -->
    
                    <div class="d-flex justify-content-between">
                      <p class="fw-bold">Total</p>
                      <p class="fw-bold" style="color: #35558a;">$<?php echo $finaltotal?></p>
                    </div>
    
                  </div>
                  <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                    <button type="button" class="btn btn-primary btn-lg mb-1" style="background-color: #35558a;">
                      Track your order
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <?php
}
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
            <?php
    
       }
       public function checkout($customerID,$cartmodel){
          
        if(isset($_COOKIE["cart".$_SESSION["ID"]]))
        {
            
            $profileData = $cartmodel->getUserData($_SESSION['ID']);
            foreach($profileData as $profile){
                $profileData = $profile;
                break;
            }

            $cookie_data = stripslashes($_COOKIE["cart".$_SESSION["ID"]]); //to decode data before using it 
            $cart_data = json_decode($cookie_data, true);
            $total = 0;
            $str="";
            foreach($cart_data as $keys => $values)
              {
                if(isset($_POST['productid'])){
                    $quantity=$_POST["quantity"];
                }
                else{
                    $quantity=$values["quantity"];
                }
                ?>
                <script>
                function checkout(){


checkout=$('#checkout').val();


$.ajax({
  type: 'POST',
  url: 'Cart',
  data:{"checkout":checkout},
  success: (result)=>{
    
    $('#cartdata').html(result);
    $('#exampleModal').modal('show');
 
    
  }
})
event.preventDefault();
$( this ).parent().parent().parent().hide( 400 );

}
</script>
                <!-- Modal -->
  
    <?php
                $total = $total + ($quantity * $values["productPrice"]); 
                  $productname=$values["productName"];

                  $quantity=$values["quantity"];
                  $productprice=$values["productPrice"];
                  $str.=$productname." (".$quantity.") ,";
         
                  
                  $cartmodel->updateStock($values["productID"],$quantity);
                
          
              }
              $finaltotal=number_format($total, 2);
              ?>
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
              aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header border-bottom-0">
                   
                  </div>
                  <div class="modal-body text-start text-black p-4">
                    <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel"><?php echo $profileData['fullName']; ?></h5>
                    <h4 class="mb-5" style="color: #35558a;">Thanks for your order</h4>
                    <p class="mb-0" style="color: #35558a;">Payment summary</p>
                    <hr class="mt-2 mb-4"
                      style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
    
                    <div class="d-flex justify-content-between">
                      <p class="fw-bold mb-0"><?php echo $str?></p>
                      <p class="text-muted mb-0">$<?php echo $finaltotal?></p>
                    
                    </div>
    
                    <!-- <div class="d-flex justify-content-between">
                      <p class="small mb-0">Shipping</p>
                      <p class="small mb-0">$175.00</p>
                    </div>
    
                    <div class="d-flex justify-content-between pb-1">
                      <p class="small">Tax</p>
                      <p class="small">$200.00</p>
                    </div> -->
    
                    <div class="d-flex justify-content-between">
                      <p class="fw-bold">Total</p>
                      <p class="fw-bold" style="color: #35558a;">$<?php echo $finaltotal?></p>
                    </div>
                    <?php
                    
                    if(!empty($_POST['newTotal'])){
                      $finaltotal=$_POST['newTotal'];
                    ?>
                    <div class="d-flex justify-content-between">
                      <p class="fw-bold">Final Price</p>
                      <p class="fw-bold" style="color: #35558a;">$<?php echo number_format($_POST['newTotal'], 2)?></p>
                    </div>
                    <?php
                    }
                    ?>
    
                  </div>
              
                </div>
              </div>
            </div>
            <?php
            // if(!empty($_POST['newTotal'])){
            //   $cartmodel->order($_SESSION["ID"],$str,$_POST['newTotal']);
            // }
             
                  $cartmodel->order($_SESSION["ID"],$str,$finaltotal,$_POST['promoCode1'],$_POST['address']);
                  $orderID=$cartmodel->getOrderID();
                  $cartmodel->delivery($orderID);
                  foreach($cart_data as $keys => $values)
              {
                  $cartmodel->orderItems($orderID,$_SESSION["ID"],$values['productID'],$values['quantity']);
                  
              } 
                 
            
          ?>
 <a href="" class="clear" id="clear" value="clear">Clear cart</a>
          <ul class="cartWrap" >
        
               


    


            <?php
             
   
          
           ?>
           
          </ul>
   
      
                      <?php
        }
        setcookie("cart".$customerID, "", time() - 2678400);
      }

      public function clearcart($customerID,$cartmodel){
        setcookie("cart".$customerID, "", time() - 3600);
      
            
            
          ?>
 <a href="" class="clear" id="clear" value="clear">Clear cart</a>
          <ul class="cartWrap" >
        
               
            <script>// Remove Items From Cart
      
      $(document).ready(function(){
      
      
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
      
      </script>
            <?php
             
   
          
           ?>
           
          </ul>
   
      
                      <?php
        
      }
     
    //Cost Operations

    //Cart cookies operations

}