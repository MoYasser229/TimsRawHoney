<?php

class dashboard extends Controller{
    public function home(){
        $dashboardPath = VIEWSPATH . 'dashboard/home.php';
        require_once $dashboardPath;
        $dashboardView = new home($this->getModel(), $this);
        $dashboardView->output();
    }
    public function productDashboard(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['type'])){
                $type = $_POST['type'];
                $filter = $_POST['filter'];
                $this->model->sortProducts($type, $filter);
                $this->model->getProducts();
            }
            if(isset($_POST['edit'])){
                $this->model->getEditInfo($_POST['edit']);
            }
            if(isset($_POST['submitEdit'])){
                $productName = $_POST['productName'];
                $retail = $_POST['retailCost'];
                $manifactureCost = $_POST['manifactureCost'];
                $productImage = isset($_POST['productImage'])?$_POST['productImage'] : $_FILES['productImage'];
                $fullFile = isset($_POST['productImage'])?$_POST['productImage'] : $_FILES['productImage'];
                if(isset($_FILES['productImage'])){
                    $file = $_FILES['productImage']['name'];
                    $explodeFile = explode(".",$file);
                    $fileName = md5($explodeFile[0]);
                    $extension = $explodeFile[1];
                    $fullFile = $fileName."." . $extension;
                    $target_dir = "../public" . "/images/product/$fullFile";
                    move_uploaded_file($_FILES["productImage"]["tmp_name"],$target_dir);
                }
                $this->model->editProduct($_POST['submitEdit'],$productName,$retail,$manifactureCost,$fullFile);
                $this->model->databaseProducts();
                $this->model->getProducts();
            }
            if(isset($_POST['delete'])){
                $delete = $_POST['delete'];
                $this->model->deleteProduct($delete);
                $this->model->databaseProducts();
                $this->model->getProducts();
            }
            if(isset($_POST['search'])){
                $this->model->searchProduct($_POST['search']);
                $this->model->getProducts();
                // add_to_cart($_POST['productID'],$_SESSION['ID']);
            }
            if(isset($_POST['addProduct'])){
                $file = $_FILES['productImage']['name'];
                $productName = $_POST['productName'];
                $retailCost = $_POST['retailCost'];
                $manifactureCost = $_POST['manifactureCost'];
                $productStock = $_POST['productStock'];
                $description = $_POST['description'];
                $explodeFile = explode(".",$file);
                $fileName = md5($explodeFile[0]);
                $extension = $explodeFile[1];
                $fullFile = $fileName."." . $extension;
                $this->model->insertProduct($productName,$retailCost,$manifactureCost,$productStock,$fullFile,$description);
                $this->model->databaseProducts();
                $this->model->getProducts();

                
                $target_dir = "../public" . "/images/product/$fullFile";
                move_uploaded_file($_FILES["productImage"]["tmp_name"],$target_dir);
            }
            
        }
        else{
            $productPath = VIEWSPATH . 'dashboard/productDashboard.php';
            require_once $productPath;
            $productView = new productDashboard($this->getModel(), $this);
            $productView->output();
        }
    }
    public function sales(){
        $salesPath = VIEWSPATH . 'dashboard/sales.php';
        require_once $salesPath;
        $salesView  = new Sales($this->getModel(), $this);
        $salesView->output();
    }
    public function customer(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            if(isset($_POST['promoCode'])){
                $promoCode = $_POST['promoCode'];
                $discount = $_POST['discount'];
                $length = $_POST['length'];
                $error = true;
                if(empty($discount) || $discount > 100){
                    echo "falseDiscount";
                    $error = false;
                }
                if (empty($promoCode)){
                    echo "falsePromo";
                    $error = false;
                }
                if($error){
                    $this->model->insertPromo($promoCode, $discount,$length);
                    $this->model->getPromo();
                    $this->model->viewPromo();
                }
            }
            if(isset($_POST['deleteid'])){
                $id = $_POST['deleteid'];
                $this->model->deletePromo($id);
                $this->model->viewPromo();
                
            }
            if(isset($_POST['extendid'])){
                $id = $_POST['extendid'];
                $length = $_POST['length'];
                $this->model->extendPromo($id,$length);
                $this->model->viewPromo();
            }
            if(isset($_POST['type'])){
                $type = $_POST['type'];
                $filter = $_POST['filter'];
                $this->model->sortPromo($type,$filter);
                $this->model->viewPromo();
            }
            // print_r( $_POST);
        }
        else{
            $customerPath = VIEWSPATH . 'dashboard/customer.php';
        require_once $customerPath;
        $customerView = new Customer($this->getModel(), $this);
        $customerView->output();
        }
        
    }
    public function delivery(){
        $deliveryPath = VIEWSPATH . 'dashboard/delivery.php';
        require_once $deliveryPath;
        $deliveryView = new delivery($this->getModel(), $this);
        $deliveryView->output();

    }
    public function order(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            require_once APPROOT."\models\sort.php";
            $sort = new Sort('orders,users,orderItems',array('fullName','orders.ID'));
            if(isset($_POST['search'])){
                $sort->setSearch($_POST['search']);
                // print_r($sort->search("GROUP BY orders.customerID"));
                $this->model->setOrders($sort->search("GROUP BY orderitems.orderID"));
                $this->model->display();
            }
            if(isset($_POST['filter'])){
                $sort = new Sort('orders,users');
                $sort->setSort($_POST['type'],$_POST['filter']);
                $this->model->setOrders($sort->filter("*,orders.ID as orderID","GROUP BY orders.ID","WHERE orders.customerID = users.ID"));
                $this->model->display();
            }
            if(isset($_POST['products'])){
                require_once APPROOT . "\models\Order.php";
                $orders = new Orders($_POST['products'],new Customer($_POST['customer']));
                // echo "<button onclick='closeView()'>Close</button>
                // <h1>Order</h1>" . $orders->getID();
                $orders->viewOrder();

            }
        }
        else{
            $orderPath = VIEWSPATH . 'dashboard/order.php';
            require_once $orderPath;
            $orderView = new order($this->getModel(), $this);
            $orderView->output();
        }
    }
    public function stocks(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['recieptID'])){
                $ID = $_POST['recieptID'];
                $this->model->getReciept($ID);
            }
        }
        else{$stocksPath = VIEWSPATH . 'dashboard/stocks.php';
        require_once $stocksPath;
        $stocksView = new stocks($this->getModel(), $this);
        $stocksView->output();}
    }
    public function survey(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['search'])){
                $search = $_POST['search'];
                $this->model->searchSurvey($search);
                $this->model->display();
            }
            if(isset($_POST['type'])){
                $type = $_POST['type'];
                $filter = $_POST['filter'];
                $this->model->filterSurveys($type, $filter);
                $this->model->display();
            }
        }
        else{
            $surveyPath = VIEWSPATH . 'dashboard/survey.php';
            require_once $surveyPath;
            $surveyView = new Survey($this->getModel(), $this);
            $surveyView->output();  
        }
    }
    public function ajax(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $model = $_POST['modelData'];
            $model = $model . "Model";
            require_once APPROOT . "/models/$model.php";
            $mod = new $model();
            if(isset($_POST['searchData'])){
                $type = $_POST['typeData'];
                $filter = $_POST['filterData'];
                $search = $_POST['searchData'];
                $mod->setCustomers($search,$type,$filter);
                
            }
            $mod->viewCustomers();
            
            
        }
        
    }
}