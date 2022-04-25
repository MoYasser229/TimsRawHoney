<?php

class customerModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/customerStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    public function getTopCustomer(){
        $result = $this->database->query("SELECT * FROM orders");
        $max = 0;
        $count = 0;
        $topCustomer = 0;
        $customerID = 0;
        while ($row = $result->fetch_assoc()) {
            if($row['customerID'] == $customerID){
                $count++;
                if($count > $max){
                    $max = $count;
                    $topCustomer  = $row['customerID'];
                }
            }
            $customerID = $row['customerID'];
        }
        $result = $this->database->query("SELECT * FROM users WHERE ID = $topCustomer");
        if($row = $result->fetch_assoc()) {
            $topCustomer = $row['fullName'];
        }
        return $topCustomer;
    }
    public function getTotalCustomers(){
        $result = $this->database->query("SELECT * FROM `users`");
        // return $result;
        return mysqli_num_rows($result);
    }
    public function getActiveCustomers(){
        return "50";
    }
    private $customers;
    public function getCustomers(){
        $result = $this->database->query("SELECT * FROM `users`");
        $this->customers = $result;
        return $result;
        // return mysqli_num_rows($result);
    }
    public function getOrders($customerID){
        $result = $this->database->query("SELECT * FROM orders WHERE customerID = '$customerID'");
        return mysqli_num_rows($result);
    }
    public function setCustomers($search){

        $result = $this->database->query("SELECT * FROM users WHERE (fullName LIKE '%$search%'
            OR email LIKE '%$search%'
            OR phoneNumber1 LIKE '%$search%'
            OR phoneNumber2 LIKE '%$search%'
            OR homeAddress1 LIKE '%$search%'
            OR homeAddress2 LIKE '%$search%')"
            );
        $this->customers = $result;
        return $result;
    }
    public function viewCustomers(){
        foreach ($this->customers as $customer){
            $orders = $this->getOrders($customer['ID']);
            $fullName = $customer['fullName'];
            $phone1 = $customer['phoneNumber1'];
            $phone2 = (empty($customer['phoneNumber2']))?"Not specified":$customer['phoneNumber2'];
            $homeAddress = $customer['homeAddress1'];
            echo "<div class='customerCard'>";
            echo "<h2>{$fullName}</h2>";
            echo "<hr>";
            echo "<div class = 'tableData'>
            <h2 class = 'tableHeader'><i class='fas fa-phone'></i><br><br>Phone Numbers</h2>
            <h3 class='data'> {$phone1} and $phone2 </h3>
            <hr>
            </div>";
            echo "<div class = 'tableData'>
            <h2 class = 'tableHeader'><i class='fas fa-home'></i><br><br>Home Address</h2>
            <h3 class='data'> {$homeAddress} </h3>
            <hr>
            </div>";
            echo "<div class = 'tableData'>
            <h2 class = 'tableHeader'><i class='fas fa-file-invoice-dollar'></i>&nbsp;&nbsp;Number of Orders</h2>
            <h1 class='data'> {$orders} </h1>
            </div>";
            // echo "<h3 class = 'tableData'>Phone Numbers <span class='data'> {$phone1} and $phone2 </span> </h3>";
            // echo "<h3 class = 'tableData'>Home Address <span class='data'> {$homeAddress} </span></h3>";
            // echo "<h3 class = 'tableData'>Number of Orders <span class='data'> {$orders} </span></h3>";
            echo "</div>";
        }
    }
}