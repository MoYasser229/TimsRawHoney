<?php

class dashboard extends Controller{
    public function home(){
        $dashboardPath = VIEWSPATH . 'dashboard/home.php';
        require_once $dashboardPath;
        $dashboardView = new home($this->getModel(), $this);
        $dashboardView->output();
    }
    public function productDashboard(){
        $productPath = VIEWSPATH . 'dashboard/productDashboard.php';
        require_once $productPath;
        $productView = new productDashboard($this->getModel(), $this);
        $productView->output();
    }
    public function sales(){
        $salesPath = VIEWSPATH . 'dashboard/sales.php';
        require_once $salesPath;
        $salesView  = new Sales($this->getModel(), $this);
        $salesView->output();
    }
    public function customer(){
        $customerPath = VIEWSPATH . 'dashboard/customer.php';
        require_once $customerPath;
        $customerView = new Customer($this->getModel(), $this);
        $customerView->output();
    }
    public function delivery(){
        $deliveryPath = VIEWSPATH . 'dashboard/delivery.php';
        require_once $deliveryPath;
        $deliveryView = new delivery($this->getModel(), $this);
        $deliveryView->output();

    }
    public function order(){
        $orderPath = VIEWSPATH . 'dashboard/order.php';
        require_once $orderPath;
        $orderView = new order($this->getModel(), $this);
        $orderView->output();
    }
    public function stocks(){
        $stocksPath = VIEWSPATH . 'dashboard/stocks.php';
        require_once $stocksPath;
        $stocksView = new stocks($this->getModel(), $this);
        $stocksView->output();
    }
    public function survey(){
        $surveyPath = VIEWSPATH . 'dashboard/survey.php';
        require_once $surveyPath;
        $surveyView = new Survey($this->getModel(), $this);
        $surveyView->output();  
    }
}