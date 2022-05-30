<?php
require_once "filter.php";
require_once "User.php";
class Admin extends User implements Filter{
    private $customers, $products,$regions,$surveys,$orders,$deliveries,$offers;
    protected $database;
    public function __construct($database,$ID){
        $this->database = $database;
        parent::__construct($ID);
        $this->customers = $this->database->query("SELECT * FROM users WHERE userRole = 'CUSTOMER'");
        $this->products = $this->database->query("SELECT * FROM products");
        $this->regions = $this->database->query("SELECT * FROM user_address");
        $this->surveys = $this->database->query("SELECT * FROM survey");
        $this->orders = $this->database->query("SELECT * FROM orders");
        $this->deliveries = $this->database->query("SELECT * FROM deliveries WHERE deliveryStatus = 'PENDING'");
        $this->offers = $this->database->query("SELECT * FROM offers");
    }
    public function update($table){
        $result = $this->database->query("SELECT * FROM $table");
        return $result;
    }
    public function delete($table){
        $result = $this->database->query("DELETE FROM $table");
        return $result;
    }
    public function set($setter,$operation,$table){
        $this->{$setter} = $this->$operation($table);
    }
    public function getCustomers(){
        return $this->customers;
    }
    public function getProducts(){
        return $this->products;
    }
    public function getRegions(){
        return $this->regions;
    }
    public function getSurveys(){
        return $this->surveys;
    }
    public function getOrders(){
        return $this->orders;
    }
    public function getOffers(){
        return $this->offers;
    }
    public function getDeliveries(){
        return $this->deliveries;
    }
    
    public function sort($table,$type,$filter){
        $result = $this->database->query("SELECT * FROM $table ORDER BY $type $filter");
        return $result;
    }
    public function search($table,$columns,$search){
        $col = "";
        foreach($columns as $searchcol){
            $col .= "$searchcol LIKE '%{$search}%' OR ";
        }
        $col = substr($col,0,strlen($col)-3);
        $result = $this->database->query("SELECT * FROM $table WHERE $col");
        return $result;
    }

}