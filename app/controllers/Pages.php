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
        redirect('pages/siginin');
    }

    }
    
