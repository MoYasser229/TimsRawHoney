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
    
}