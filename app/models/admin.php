<?php
require_once "filter.php";
require_once "Users.php";
class Admin extends User implements Filter{
    private $customers, $products,$regions,$surveys,$orders,$deliveries,$offers;
    protected $database;
    public function __construct($database,$ID){
        $this->database = $database;
        parent::__construct($ID);
        $this->customers = $this->database->query("SELECT * FROM users WHERE userRole = 'CUSTOMER'");
        $this->products = $this->database->query("SELECT * FROM products");
        $this->regions = $this->database->query("SELECT * FROM user_address");
        $this->surveys = $this->database->query("SELECT *,((AVG((questionOne+questionTwo + questionThree + questionFour + questionFive)/5))/5)*100 as averageSurvey FROM survey GROUP BY surveyID");
        $this->orders = $this->database->query("SELECT * FROM orders");
        $this->deliveries = $this->database->query("SELECT * FROM deliveries WHERE deliveryStatus = 'PENDING'");
        $this->offers = $this->database->query("SELECT * FROM offers");
    }
    public function numCustomers(){
        return mysqli_num_rows($this->customers);
    }
    public function getAverageSurvey(){
        if(mysqli_num_rows($this->surveys) > 0)
            return number_format($this->surveys->fetch_assoc()['averageSurvey'],2);
        return 0;
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
    public function getTopRegion(){
        $result = $this->database->query("SELECT region FROM user_address WHERE addressID = (SELECT addressID FROM orders GROUP BY addressID ORDER BY SUM(orderTotalPrice) DESC LIMIT 1)");
        if(mysqli_num_rows($result) != 0)
            return $result->fetch_assoc()['region'];
        return "No Sales Available";
    }
    public function checkStock(){
        $check = false;
        foreach($this->products as $product){
            $available = $product['productStock'];
            if($available == 0)
                return 0;
            else if($available <= 5)
                return 1;
        }
        return 2;
    }
    public function numProducts(){
        return mysqli_num_rows($this->products);
    }
    public function monthlyStockReciepts(){
        $result = $this->database->query("SELECT reciept.createdAt,(manifactureCost * quantity) as totalReciept FROM reciept,stockproducts,products WHERE reciept.ID = stockproducts.recieptID AND products.ID = stockproducts.productID");
        $sum = 0;
        foreach($result as $reciept){
            $monthDb = Date("F",strtotime($reciept['createdAt']));
            $currMonth = Date("F");
            if($monthDb === $currMonth){
                $sum += $reciept['totalReciept'];
            }
        }
        return $sum;
    }
    public function recieptHistory(){
        $result = $this->database->query("SELECT (reciept.createdAt) as recieptCreation,SUM(products.manifactureCost * stockproducts.quantity) as monthReciept FROM reciept,stockproducts,products WHERE reciept.ID = recieptID AND stockproducts.productID = products.ID GROUP BY MONTH(reciept.createdAt) ORDER BY MONTH(reciept.createdAt) ASC LIMIT 4");
        
        return $result;

    }
    public function getMax($result,$entry){
        $max = 0;
        foreach($result as $object){
            if($object[$entry] > $max){
                $max = $object[$entry];
            }
        }
        return $max;
    }
    public function bestSeller(){
        $result = $this->database->query("SELECT *,SUM(quantity) as productQuantity,(SUM(orderitems.quantity) * retailCost) as revenue FROM orderitems,orders,products WHERE orders.ID = orderitems.orderID AND products.ID = orderitems.productID GROUP BY productID ORDER BY productQuantity DESC LIMIT 1;");
        return $result;
    }
    public function getFinance(){
        $result = $this->database->query("SELECT *,MONTH(createdAt) as financeMonth FROM finance");
        return $result;
    }
    public function updateFinance(){
        $result = $this->database->query("SELECT * FROM finance WHERE MONTH(createdAt) = MONTH(CURRENT_TIMESTAMP)");
        if(mysqli_num_rows($result) == 0){
            $this->setFinance();
        }
    }
    public function updateExpenses($expenses){
        $this->database->query("UPDATE finance SET expenses = '$expenses' WHERE MONTH(createdAt) = MONTH(CURRENT_TIMESTAMP)");
    }
    public function currentExpenses(){
        $expenses = $this->database->query("SELECT expenses FROM finance WHERE MONTH(createdAt) = MONTH(CURRENT_TIMESTAMP)")->fetch_assoc()['expenses'];
        return $expenses;

    }
    public function monthlyReport(){
        $result = $this->database->query("SELECT *,(((revenue-expenses)/revenue)*100) as profit FROM finance WHERE MONTH(createdAt) = MONTH(CURRENT_TIMESTAMP)");
        return $result;
    }
    public function prevMonthlyReport(){
        $result = $this->database->query("SELECT * FROM finance WHERE MONTH(createdAt) = (MONTH(CURRENT_TIMESTAMP) - 1)");
        return $result;
    }
    public function setFinance(){
        $revenue = $this->database->query("SELECT (SUM(quantity) * products.retailCost) as myRevenue FROM orderitems,products WHERE products.ID = orderitems.productID")->fetch_assoc()['myRevenue'];
        $cog = $this->database->query("SELECT (SUM(quantity) * products.retailCost) as cog FROM stockProducts,products WHERE products.ID = stockproducts.productID")->fetch_assoc()['cog'];
        // $gross = "No sales found";
        if($revenue != 0){
            $this->database->query("INSERT into finance(revenue,expenses) VALUES('$revenue','$cog')");
        }
    }

}