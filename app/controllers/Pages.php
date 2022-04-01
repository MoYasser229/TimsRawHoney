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
        $viewPath = VIEWSPATH . 'pages/product.php';
        require_once $viewPath;
        $testView = new product($this->getModel(), $this);
        $testView->output();
    }
    public function signin(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $signInModel = $this->getModel();
            $signInModel->setemail($email);
            $signInModel->setpassword($password);
            $result = $signInModel->signin();
            if($result !== false){
                if($row = $result){
                    $session = new Session();
                    $session->setSession("ID",$row['ID']);
                    $session->setSession("email",$row['email']);
                    if($row['userRole'] === "CUSTOMER")
                        redirect("pages/index");
                    else
                        redirect("dashboard/home");
                }
            }
            else{
                echo "<script>alert('Username or password is incorrect')</script>";
            }
        }
        $viewPath = VIEWSPATH . 'pages/signin.php';
        require_once $viewPath;
        $testView = new signin($this->getModel(), $this);
        $testView->output();
    }
    public function signup(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $homeAddress1 = $_POST['homeAddress1'];
            $homeAddress2 = $_POST['homeAddress2'];
            $phoneNumber1 = $_POST['phoneNumber1'];
            $phoneNumber2 = $_POST['phoneNumber2'];
            $signUp = $this->getModel();
            $signUp->setemail($email);
            $signUp->setpassword($password);
            $signUp->setfname($fname);
            $signUp->setlname($lname);
            $signUp->sethomeaddress1($homeAddress1);
            $signUp->sethomeaddress2($homeAddress2);
            $signUp->setphonenumber1($phoneNumber1);
            $signUp->setphonenumber2($phoneNumber2);
            $result = $signUp->register();
            if($result === true){
                redirect("pages/index");
            }
            else{
                echo "<script>alert('error')</script>";
            }
        }
        $viewPath = VIEWSPATH . 'pages/signup.php';
        require_once $viewPath;
        $testView = new signup($this->getModel(), $this);
        $testView->output();
    }
    public function Cart(){
        $viewPath = VIEWSPATH . 'pages/Cart.php';
        require_once $viewPath;
        $testView = new Cart($this->getModel(), $this);
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
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $phone1 = $_POST['phone1'];
                $phone2 = $_POST['phone2'];
                $error = false;
                if(empty($fname) || empty($lname) || empty($phone1) || empty($phone2))
                    $error = true;
                if(!$error){
                    $model = $this->getModel();
                    $result = $model->updatePersonal($_SESSION['ID'],$fname, $lname, $phone1,$phone2);
                    if($result){
                        redirect('pages/profile');
                    }
                    else
                        echo "<script>alert('error')</script>";
                }
            }
            if(isset($_POST['submitSecurity'])){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $error = false;
                $validation = false;

                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $validation = true;
                    echo "<script>alert('Email is invalid')</script>";
                }
                if(empty($email) || empty($password))
                    $error = true;

                if(!$error && !$validation){
                    $result = $model->updateSecurity($_SESSION['ID'],$email,$password);
                    if($result){
                        redirect('pages/profile');
                    }
                }
                else if($error){
                    echo "<script>alert('Email/Password is empty')</script>";
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
        }
        $profilePath = VIEWSPATH . 'pages/profile.php';
        require_once $profilePath;
        $profile = new Profile($this->getModel(), $this);
        $profile->output();
    }
    }
    
