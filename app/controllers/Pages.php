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
      $Shop = $this->getModel();   
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
             if(isset($_POST['shopSearch'])){
              $result = $Shop->search("products","productName",$_POST['shopSearch']);
              $Shop->getProducts($result);
          } 
          if(isset($_POST['filter'])){
              $result = $Shop->sort("products",$_POST['type'],$_POST['filter']);
              $Shop->getProducts($result);
          }
        }
        else{
          $viewPath = VIEWSPATH . 'pages/Shop.php';
          require_once $viewPath;
          $testView = new Shop($this->getModel(), $this);
          $testView->output();
        }
        
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
            require_once APPROOT."/models/Product.php";
            $product = new Product($_POST['productid']);

            if(isset($_POST['productid'])){
              
                
                $productname = $_POST['productname'];
                $productimage = $_POST['productimage'];
                $productprice = $_POST['productprice'];
                $productID = $_POST['productid'];
                $productMaterial= $_POST['material'];
                $productsize=$_POST['size'];
                
              
               $product->addtocart($_SESSION['ID'],$productID,$productname,$productimage,$productprice,1,$productMaterial,$productsize);
               echo '
               <div class="itemadded" style="margin-top:-60px;">
               <div class="alert alert-success alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  Item Added into Cart
               </div>
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
                          if($row['userRole'] === "ADMIN"){
                            
                            // $this->$model->setAdmin($admin); 
                            echo URLROOT . "dashboard/home";
                            // print_r($admin);
                          }
                          else
                            echo URLROOT . "pages/index";  
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
                        // echo "<script>alert('donee')</script>";
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
            require_once APPROOT."/models/address.php";
            require_once APPROOT."/models/Users.php";
            $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
            // $password = $_POST['password'];
            $confirmNewPassword = $_POST['confirmPassword'];
            // $homeAddress1 = $_POST['address1'];
            // $homeAddress2 = $_POST['address2'];
            $street = $_POST['street'];
            $region = $_POST['region'];
            $district = $_POST['district'];
            $landmark = $_POST['landmark'];
            $building = $_POST['building'];
            $appNumber = $_POST['appNumber'];
            $address = new Address($street,$district,$region,$appNumber,$building,$landmark);
            $phoneNumber1 = $_POST['phone1'];
            $phoneNumber2 = $_POST['phone2'];
            $signUp->setConfirmPassword($confirmNewPassword);
            $signUp->setpassword($password);
            // $signUp->sethomeaddress1($homeAddress1);
            // $signUp->sethomeaddress2($homeAddress2);
            $signUp->setphonenumber1($phoneNumber1);
            $signUp->setphonenumber2($phoneNumber2);
            $error = false;
            // echo "<script>alert('Facebook')</script>";
            if(isset($_POST['submitFacebook'])){
                $fullName = $_POST['myNameFacebook'];
                $email = $_POST['emailFacebook'];
                $signUp->setName($fullName);
                $signUp->setemail($email);
                $signUp->setAddress($address);
                $error = false;
                if(!$signUp->repeatEmail()){
                    $error = true;
                    redirect('pages/signin');
                }
                if(!$signUp->checkPassword() || empty($password) || empty($confirmNewPassword) || !password_verify($this->model->getConfirmPassword(),$password) || (empty($phoneNumber1) && empty($phoneNumber2)) || $address->validate() === false){
                    $error = true;
                    $signUp->setSocialError('*Something wrong with the data given. Please Sign Up Again and check you enter all data needed');
                }
                if(!$error){
                    $result = $signUp->register();
                    $this->model->getAddress()->insertDB();
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
                if($address->validate() === false){
                  $error = true;
                  $signUp->setErrorAddress1("*Some fields are empty in address fields");
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
                    $signUp->setErrorConfirmation("Confirmation of the password is different to the password written");
                }
                if(empty($phoneNumber1) && empty($phoneNumber2)){
                    $error = true;
                    $signUp->setErrorPhone1('*REQUIRED: Please Enter at least one phone Number');
                }
                if(!$error){
                    $result = $signUp->register();
                    $address->insertDB();
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
                else if(!$this->model->getOldPassword($_SESSION['ID'])){
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
                    echo "<script>alert('Password is invalid')</script>";
                }
            }
            if(isset($_POST['orderID'])){
              echo($this->model->myOrder($_POST['orderID']));
            }
            if(isset($_POST['addressID'])){
              $address = $_POST['addressID'];
              $this->model->getAddress($address);
            }
            if(isset($_POST['deleteAddressID'])){
              $delete = $_POST['deleteAddressID'];
              $this->model->deleteAddress($delete);
              $addresses = $this->model->getAddresses($_SESSION['ID']);
              $this->model->viewAddresses($addresses);
            }
            if(isset($_POST['editAddressID'])){
              $street = $_POST['street'];
              $region = $_POST['region'];
              $landmark = $_POST['landmark'];
              $building = $_POST['building'];
              $district = $_POST['district'];
              $appNumber = $_POST['appNumber'];
              $this->model->updateAddressDB($_POST['editAddressID'],$street,$region,$landmark,$building,$district,$appNumber);
              $this->model->getAddress($_POST['editAddressID']);
            }
            if(isset($_POST['submitAddress'])){
                $address1 = $_POST['address'];
                $address2 = $_POST['address2'];
                $result = $model->updateAddress($_SESSION['ID'],$address1,$address2);
                if($result)
                    redirect('pages/profile');
            }
            if(isset($_POST['addID'])){
              $street = $_POST['street'];
              $region = $_POST['region'];
              $landmark = $_POST['landmark'];
              $building = $_POST['building'];
              $district = $_POST['district'];
              $appNumber = $_POST['appNumber'];
              $this->model->addAddress($_SESSION['ID'],$street,$region,$landmark,$building,$district,$appNumber);
              $addresses = $this->model->getAddresses($_SESSION['ID']);
              $this->model->viewAddresses($addresses);
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
                require_once APPROOT.'/models/survey.php';
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
        require_once APPROOT."/models/Cart.php";
        $Cart = new Carts;
        $cartmodel = $this->getModel();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
         
 
           
            if(isset($_POST['quantity'])){
                $Cart->updatequantity($_SESSION['ID'],$_POST['productid'],$_POST['quantity'],$cartmodel);
                // $this->viewCart();
            }
            if (isset($_POST['remove'])){

                $Cart->deletefromcart($_SESSION['ID'],$_POST['productid'],$cartmodel);
            
            }
            if (isset($_POST['clear'])){
                $Cart->clearcart($_SESSION['ID'],$cartmodel);
            
            }
            if (isset($_POST['checkout'])){
                $Cart->checkout($_SESSION['ID'],$cartmodel);
            }
            if (isset($_POST['promoCode'])){
              
             $promo=$this->model->promoCode($_POST['promoCode']);
             if($promo===false){  
            echo "false";
             }
             
             echo $promo;
             
          
          }

        }
    else{
        $viewPath = VIEWSPATH . 'pages/Cart.php';
        require_once $viewPath;
        $testView = new Cart($this->getModel(), $this);
        $testView->output();
    }

    }

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
  
}
