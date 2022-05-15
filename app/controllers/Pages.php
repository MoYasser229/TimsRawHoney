<?php
class Pages extends Controller{
    public function index(){
        $viewPath = VIEWSPATH . 'pages/Index.php';
        require_once $viewPath;
        $indexView = new Index($this->getModel(), $this);
        $indexView->output();
    }
    public function test(){
        $viewPath = VIEWSPATH . 'pages/test.php';
        require_once $viewPath;
        $testView = new Test($this->getModel(), $this);
        $testView->output();
    }
    public function Shop(){
        $viewPath = VIEWSPATH . 'pages/Shop.php';
        require_once $viewPath;
        $testView = new Shop($this->getModel(), $this);
        $testView->output();
    }
    public function Suggested(){
        $viewPath = VIEWSPATH . 'pages/Suggested.php';
        require_once $viewPath;
        $testView = new Suggested($this->getModel(), $this);
        $testView->output();
    }

    public function product(){
        // habd
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            // if(isset($_POST['ShowButton'])){
            //     $product->setButtonShow($_POST['ShowButton']);
            //     $product->setID($_POST['CardID']);
            //     echo($product->button());
            // }
            if(isset($_POST['productid'])){
              
                
                $productname = $_POST['productname'];
                $productimage = $_POST['productimage'];
                $productprice = $_POST['productprice'];
                $productID = $_POST['productid'];
                $productMaterial= $_POST['material'];
                $productsize=$_POST['size'];
                

               $this->addtocart($_SESSION['ID'],$productID,$productname,$productimage,$productprice,1,$productMaterial,$productsize);
               echo '
               <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Item Added into Cart
               </div>
               ';
              

            }
            
           
                 if(isset($_POST['review'])){
                   
                    $productmodel = $this->getModel();
                    $reviewText = $_POST['review'];
                    $stars=$_POST['rating_data'];
                    $productID= $_POST['productID'];
                    $productmodel->writereview($_SESSION['ID'],$productID,$stars,$reviewText);
                    $productmodel->displayReview($productID);
                    
                 }
                

        }else{
            $viewPath = VIEWSPATH . 'pages/product.php';
            require_once $viewPath;
            $testView = new product($this->getModel(), $this);
            $testView->output();
        }
       
    }
    public function signin(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['id']) && $_POST['id'] === 'signin'){
                $email = $_POST['email'];
                $model = $this->getModel();
                $model->setemail($email);
                $result = $model->facebookSignIn();
                if(!$result)
                    echo 'false';
                else
                    if($row = $result){
                        $session = new Session();
                        $session->setSession("ID",$row['ID']);
                        $session->setSession("email",$row['email']);
                          // $cookie = new Cookie($row['ID']);
                        echo ($row['userRole'] === "ADMIN")? URLROOT . "dashboard/home": URLROOT . "pages/index";  
                    }

                return;
            }
            else{
            $email = $_POST['email'];
            $password = $_POST['password'];
            // $password = md5($_POST['password']);
            if(!empty($email) && !empty($password)){
            $signInModel = $this->getModel();
            $signInModel->setemail($email);
            $signInModel->setpassword($password);
            $result = $signInModel->signin();
            if($result !== false){
                if($row = $result){
                    if(!password_verify($password,$row['pswrd'])){
                        echo "<script>alert('password is incorrect')</script>";
                    }
                    else{
                        $session = new Session();
                        echo "<script>alert('donee')</script>";
                        $session->setSession("ID",$row['ID']);
                        $session->setSession("email",$row['email']);
                        if($row['userRole'] === "CUSTOMER")
                            redirect("pages/index");
                        else
                            redirect("dashboard/home");
                    }
                }
            }
            else{
                echo "<script>alert('Email is incorrect')</script>";
            }
            }
            else{
                $this->getModel()->setErrorEmail('*Please enter your email');
                $this->getModel()->setErrorPassword('*Please enter your password');
            }
        }}
        $viewPath = VIEWSPATH . 'pages/signin.php';
        require_once $viewPath;
        $testView = new signin($this->getModel(), $this);
        $testView->output();
    }
    public function signup(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $signUp = $this->getModel();
            
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            // $password = $_POST['password'];
            $confirmNewPassword = $_POST['confirmPassword'];
            $homeAddress1 = $_POST['address1'];
            $homeAddress2 = $_POST['address2'];
            $phoneNumber1 = $_POST['phone1'];
            $phoneNumber2 = $_POST['phone2'];
            $signUp->setConfirmPassword($confirmNewPassword);
            $signUp->setpassword($password);
            $signUp->sethomeaddress1($homeAddress1);
            $signUp->sethomeaddress2($homeAddress2);
            $signUp->setphonenumber1($phoneNumber1);
            $signUp->setphonenumber2($phoneNumber2);
            $error = false;
            // echo "<script>alert('Facebook')</script>";
            if(isset($_POST['submitFacebook'])){
                $fullName = $_POST['myNameFacebook'];
                $email = $_POST['emailFacebook'];
                $signUp->setName($fullName);
                $signUp->setemail($email);
                $error = false;
                if(!$signUp->repeatEmail()){
                    $error = true;
                    redirect('pages/signin');
                }
                if(!$signUp->checkPassword() || empty($password) || empty($confirmNewPassword) || !password_verify($this->model->getConfirmPassword(),$password) || (empty($phoneNumber1) && empty($phoneNumber2)) || (empty($homeAddress1) && empty($homeAddress2))){
                    $error = true;
                    $signUp->setSocialError('*Something wrong with the data given. Please Sign Up Again and check you enter all data needed');
                }
                if(!$error){
                    $result = $signUp->register();
                    if($result === true){
                        redirect("pages/signin");
                    }
                    else{
                        echo "<script>alert('error')</script>";
                    }
                }
            }
            else if(isset($_POST['regular'])){
                $fullName = $_POST['myName'];
                $email = $_POST['email'];
                $signUp->setName($fullName);
                $signUp->setemail($email);
                //Check If email already used
                if(!$signUp->validateEmail()){
                    $error = true;
                    $signUp->setErrorEmail('*Email is invalid');
                }
                if(!$signUp->repeatEmail()){
                    $error = true;
                    $signUp->setErrorEmail('*Email already used. Sign in instead');
                }
                if(empty($email)){
                    $error = true;
                    $signUp->setErrorEmail('*REQUIRED: Please Enter an email');
                }
                if(empty($fullName)){
                    $error = true;
                    $signUp->setErrorName('*REQUIRED: Please enter your name');
                }
                if(!$signUp->checkPassword()){
                    $error = true;
                    $signUp->setErrorPassword('*Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
                }
                if(empty($password)){
                    $error = true;
                    $signUp->setErrorPassword('*REQUIRED: Please enter your password');
                }
                if(empty($confirmNewPassword)){
                    $error = true;
                    $signUp->setErrorConfirmPassword('*REQUIRED: Please confirm your password');
                }
                if(!password_verify($confirmNewPassword, $password)){
                    $error = true;
                    $signUp->setErrorConfirmation("$password and $confirmNewPassword Confirmation of the password is different to the password written");
                }
                if(empty($phoneNumber1) && empty($phoneNumber2)){
                    $error = true;
                    $signUp->setErrorPhone1('*REQUIRED: Please Enter at least one phone Number');
                }
                if(empty($homeAddress1) && empty($homeAddress2)){
                    $error = true;
                    $signUp->setErrorAddress1('*REQUIRED: Please enter at least one address');
                }
                if(!$error){
                    $result = $signUp->register();
                    if($result === true){
                        redirect("pages/signin");
                    }
                    else{
                        echo "<script>alert('error')</script>";
                    }
                }
            }
        }
        $viewPath = VIEWSPATH . 'pages/signup.php';
        require_once $viewPath;
        $testView = new signup($this->getModel(), $this);
        $testView->output();
    }

    public function logout()
    {
        echo 'logout called';
        unset($_SESSION['ID']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('pages/signin');
    }
    public function profile(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $model = $this->getModel();
            
            if(isset($_POST['submitPersonal'])){
                
                $name = $_POST['name'];
                $phone1 = $_POST['phone1'];
                $phone2 = $_POST['phone2'];
                $error = false;
                if(empty($name)){
                    $error = true;
                }
                if((empty($phone1) && empty($phone2))){
                    $error = true;
                }
                
                if(!$error){
                    
                    $model = $this->getModel();
                    $result = $model->updatePersonal($_SESSION['ID'],$name, $phone1,$phone2);
                    if($result){
                        redirect('pages/profile');
                    }
                    else
                        echo "<script>alert('error')</script>";
                }
            }
            if(isset($_POST['submitSecurity'])){
                $email = $_POST['email'];
                $password = ($_POST['password']);
                $newPassword = ($_POST['newPassword']);
                // $confirmPassword = ( $_POST['confirmNewPassword']);
                $error = false;
                $validation = false;
                $confirm = false;
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $validation = true;
                    echo "<script>alert('Email is invalid')</script>";
                }
                if(empty($password) || empty($newPassword)){
                    $pass = $this->model->getOldPassword($_SESSION['ID']);
                    $newPassword = $pass['pswrd'];
                }
                else if($this->model->getOldPassword($_SESSION['ID'])){
                    $error = true;
                }
                else if(!$this->model->checkPassword($newPassword)){
                    $error = true;
                }
                if(empty($email))
                    $error = true;
                if($_POST['newPassword'] != $_POST['confirmNewPassword']){
                    $confirm = true;
                    echo "<script>alert('The confirmation password is incorrect')</script>";
                }
                if(!$error && !$validation && !$confirm){
                    $result = $model->updateSecurity($_SESSION['ID'],$email,$newPassword);
                    if($result){
                        redirect('pages/profile');
                    }
                }
                else if($error){
                    echo "<script>alert('Email/Password is invalid')</script>";
                }
            }
            if(isset($_POST['submitAddress'])){
                $address1 = $_POST['address'];
                $address2 = $_POST['address2'];
                $result = $model->updateAddress($_SESSION['ID'],$address1,$address2);
                if($result)
                    redirect('pages/profile');
            }
            if(isset($_POST['submitDelete'])){
                $model->deleteAccount($_SESSION['ID']);
                unset($_SESSION['ID']);
                unset($_SESSION['email']);
                session_destroy();
                redirect('pages/index');
            }
            if(isset($_POST['q1'])){
                $q1 = $_POST['q1'];
                $q2 = $_POST['q2'];
                $q3 = $_POST['q3'];
                $q4 = $_POST['q4'];
                $q5 = $_POST['q5'];
                $description =isset($_POST['description'])?$_POST['description']:"";
                require_once 'survey.php';
                $surveyEntry = new Survey($_SESSION['ID'],$q1,$q2,$q3,$q4,$q5,$description);
                $model->insertSurvey($surveyEntry);
                echo "Successfully added!";
            }
        }
        else{
            $profilePath = VIEWSPATH . 'pages/profile.php';
            require_once $profilePath;
            $profile = new Profile($this->getModel(), $this);
            $profile->output();
        }
    }

    //habd
    public function Cart(){
   
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
         
 
           
            if(isset($_POST['quantity'])){
            
                $this->updatequantity($_SESSION['ID'],$_POST['productid'],$_POST['quantity']);

            }
            if (isset($_POST['remove'])){
                $this->deletefromcart($_SESSION['ID'],$_POST['productid']);
            
            }
            if (isset($_POST['clear'])){
                $this->clearcart($_SESSION['ID']);
            
            }
            if (isset($_POST['checkout'])){
                $this->checkout($_SESSION['ID']);
            
            }
        }
            
       
    else{
        $viewPath = VIEWSPATH . 'pages/Cart.php';
        require_once $viewPath;
        $testView = new Cart($this->getModel(), $this);
        $testView->output();
    }

    }

// public function shop(){

// }
    //habd
    public function ajax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //  print_r($_POST);
            // $search = $_POST['searchData'];
             $model = $_POST['modelData'];
             $model = $model . "Model";
            require_once APPROOT . "/models/$model.php";
            $mod = new $model();
            // $mod->setCustomers($search);
            // $mod->viewCustomers();
            
        }
        $ajaxPath = VIEWSPATH . 'ajax/review.php';
        require_once $ajaxPath;
        // $surveyView = new ajax($this->getModel(), $this);
        // $surveyView->output();  
    }
    public function addtocart($customerID,$productID,$productname,$productimage,$productprice,$quantity,$material,$size){
      

        if(isset($_COOKIE["cart$customerID"]))
        {
         $cookie_data = stripslashes($_COOKIE["cart$customerID"]);
       
         $cart_data = json_decode($cookie_data, true);
        }
        else
        {
         $cart_data = array();
        }
       
        $item_id_list = array_column($cart_data, 'productID');
       
        if(in_array($productID, $item_id_list))
        {
         foreach($cart_data as $keys => $values)
         {
          if($cart_data[$keys]["productID"] == $productID)
          {
              if( $cart_data[$keys]["quantity"] + $quantity >0){
           $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + $quantity;
              }
              
          }
         }
        }
        else
        {
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

           public function deletefromcart($customerID,$productID){
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
    $cartmodel = $this->getModel();
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
qty=$('#quantity'+<?php echo $values["productID"];?>).val();
$.ajax({
    type: 'POST',
    url: 'Cart',
    data:{"productid":productid,"remove":remove,"qty":qty},
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
if(quantity> <?php echo $maxQuantity?>){
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
    <div class="promoCode"><label for="promo">Have A Promo Code?</label><input type="text" name="promo" placholder="Enter Code" />
  <a href="#" class="btn"></a></div>
  
  <div class="subtotal cf">
    <ul>
            <li class="totalRow final"><span class="label">Total</span><span class="value">$<?php echo number_format($total, 2);?></span></li>
            <li class="totalRow"><a href="" class="btn continue" name="checkout" onclick="checkout()" id="checkout" value=checkout>Checkout</a></li>
    </ul>
  </div>
</div>
    </div>
  
</div>
    <?php
 
}

           }
           public function updatequantity($customerID,$productID,$quantity){
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
        $cartmodel = $this->getModel();
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
  if(quantity> <?php echo $maxQuantity?>){
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
    <div class="promoCode"><label for="promo">Have A Promo Code?</label><input type="text" name="promo" placholder="Enter Code" />
  <a href="#" class="btn"></a></div>
  
  <div class="subtotal cf">
    <ul>
            <li class="totalRow final"><span class="label">Total</span><span class="value">$<?php echo number_format($total, 2);?></span></li>
            <li class="totalRow"><a href="" class="btn continue" name="checkout" onclick="checkout()" id="checkout" value=checkout>Checkout</a></li>
    </ul>
  </div>
</div>
    </div>
  
</div>
                <?php
        
           }
           public function clearcart($customerID){
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
          public function checkout($customerID){
            
            if(isset($_COOKIE["cart".$_SESSION["ID"]]))
            {
                $cartmodel = $this->getModel();
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
                  
                      $cartmodel->order($_SESSION["ID"],$str,$total);
                      
                     
                
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

        }
