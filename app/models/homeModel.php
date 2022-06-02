<?php
class homeModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/dashboardStyle.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $admin;
    // require_once APPROOT . "/models/admin.php";
    public function setAdmin($admin){
        $this->admin = $admin;
    }
    public function getAdmin() {
        return $this->admin;
    }
    public function getProducts(){
        // require_once APPROOT . "/models/admin.php";
        // $admin = new Admin($this->getDatabase(),$_SESSION['ID']);
        //DATABASE CALL
        return 30;
    }
    public function getSold(){
        return 150;
    }
    public function getRevenue(){
        return 2000;
    }
    public function getOrders(){
        return 30;
    }
    public function getThreeProducts(){
        return array(["Immune Honey",25,150,2.5],["Immune Honey",25,150,2.5],["Immune Honey",25,150,2.5]);
    }
    public function getLeastStock(){
        return array(["Immune Honey"],[5]);
    }
    public function getBestSeller(){
        return "Immune Honey";
    }
    public function getCustomers(){
        return 150;
    }
    public function getActiveCustomers(){
        return 30;
    }
    public function getExpenses(){
        return 1500;
    }
    public function getProfit(){
        return $this->getRevenue() - $this->getExpenses();
    }
    public function getRecordedDate(){
        return 25;
    }
    public function getDatabase(){
        return $this->database;
    }
}