<?php

class customerModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/customerStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    public function getTopCustomer(){
        $result = $this->database->query("SELECT customerID,COUNT(customerID) FROM orders GROUP BY customerID ORDER BY COUNT(customerID) DESC LIMIT 1");
        if($row = $result->fetch_assoc()){
            $customerName = $this->database->query("SELECT fullName FROM users WHERE ID = {$row['customerID']}");
            return $customerName->fetch_assoc()['fullName'];
        }
    }
    public function getTotalCustomers(){
        $result = $this->database->query("SELECT * FROM `users` WHERE userRole = 'CUSTOMER'");
        // return $result;
        return mysqli_num_rows($result);
        // return 90
    }
    public function getActiveCustomers(){
        $result = $this->database->query("SELECT DISTINCT users.ID FROM users INNER JOIN orders ON users.ID = orders.customerID");
        return mysqli_num_rows($result);
    }
    public function getCustomerRatio(){
        if($this->getTotalCustomers() != 0)
            return round(($this->getActiveCustomers() / $this->getTotalCustomers())*100);
    }
    public function getPromoCodes(){
        $result = $this->database->query("SELECT * FROM promocodes");
        return mysqli_num_rows($result);
    }
    public function getPromoCodesRatio(){
        $result = $this->database->query("SELECT DISTINCT * FROM promocodes,orders WHERE promocodes.promoID = orders.promocodeid");
        $all = $this->database->query("SELECT * FROM promocodes");
        if(mysqli_num_rows($all) != 0)
        return round((mysqli_num_rows($result)/mysqli_num_rows($all))*100);

    }
    private $promoError;
    public function getPromoError(){
        return $this->promoError;
    }
    public function setPromoError($error){
        $this->promoError = $error;
    }
    public function insertPromo($promoCode,$discount,$length){
        $result = $this->database->query("INSERT INTO promocodes(promoCode,promoValue,promoLength,active) VALUES('$promoCode','$discount','$length','1')");
    }
    private $promo;
    public function getPromo(){
        $result = $this->database->query("SELECT * FROM promocodes WHERE active = '1'");
        $this->promo = $result;
        return $result;
    }
    public function deletePromo($id){
        $this->database->query("UPDATE promocodes SET active='0' WHERE promoID='$id'");
        $result = $this->database->query("SELECT * FROM promocodes WHERE active='1'");
        $this->promo = $result;
    }
    public function extendPromo($id,$promoLength){
        $promoLength += 15;
        $this->database->query("UPDATE promocodes SET promoLength='$promoLength' WHERE promoID='$id'");
        $result = $this->database->query("SELECT * FROM promocodes WHERE active='1'");
        $this->promo = $result;
    }
    public function sortPromo($type,$filter){
        $result = $this->database->query("SELECT * from promocodes ORDER BY $type $filter");
        // $result = $this->database->query("SELECT * from promocodes ORDER BY promoLength DESC");
        $this->promo = $result;
    }
    public function viewPromo(){
        foreach($this->promo as $promo){
            $dateDiff = floor((strtotime($promo['createdAt'] . "+ {$promo['promoLength']} days") - strtotime(date('Y-m-d')))/(86400));
            // $dateDiff = $dateDiff - strtotime("2022-29-4");
            echo "<div class='promoCard'>
            <h2><i class='fa-solid fa-percent'></i> DISCOUNT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$promo['promoValue']}%</h2>
            <hr>
            <h3>CODE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$promo['promoCode']}</h3>
            <h3>PROMO CODE EXPIRES IN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$dateDiff} days</h3>
            
            <button onclick='ondelete(value)' value = '{$promo['promoID']}'>DEACTIVATE PROMOCODE</button>
            <button  onclick='onextend(value,{$promo['promoLength']})' class = extendPromo value = '{$promo['promoID']}'>EXTEND PROMOCODE</button>
            <br><label><i class='fa-solid fa-circle-info'></i> Extending the promo code will add 15 days</label>
            </div>";
        }
    }

    private $customers;
    public function getCustomers(){
        $result = $this->database->query("SELECT * FROM `users` WHERE userRole = 'CUSTOMER'");
        $this->customers = $result;
        return $result;
        // return mysqli_num_rows($result);
    }
    public function getOrders($customerID){
        $result = $this->database->query("SELECT * FROM orders WHERE customerID = '$customerID'");
        return mysqli_num_rows($result);
    }
    public function setCustomers($search,$type,$filter){
        if($type == "sales"){
            $result = $this->database->query("SELECT * FROM users WHERE userRole = 'CUSTOMER'");
            $customerList = [];
            foreach($result as $row){
                $customerList += [$row["ID"] => $this->getOrders($row["ID"])];
            }
            if($filter == "ASC")
                asort($customerList);
            else if($filter == "DESC")
                arsort($customerList);
            $keys = array_keys($customerList);
            $this->customers = array();
            for($i = 0;$i < count(array_keys($customerList));$i++){
                $key = $keys[$i];
                $result = $this->database->query("SELECT * FROM USERS WHERE ID = '$key' AND userRole = 'CUSTOMER'");
                array_push($this->customers, $result->fetch_assoc());
            }
        }
        else{
            $result = $this->database->query("SELECT * FROM users WHERE (fullName LIKE '%$search%'
                OR email LIKE '%$search%'
                OR phoneNumber1 LIKE '%$search%'
                OR phoneNumber2 LIKE '%$search%') AND userRole = 'CUSTOMER' ORDER BY $type $filter"
                );
            $this->customers = $result;
        }
        return $result;
    }
    public function viewCustomers(){
        
        foreach ($this->customers as $customer){
            $orders = $this->getOrders($customer['ID']);
            $fullName = $customer['fullName'];
            $phone1 = $customer['phoneNumber1'];
            $phone2 = (empty($customer['phoneNumber2']))?"Not specified":$customer['phoneNumber2'];
            $result = $this->database->query("SELECT * FROM user_address WHERE customerID = {$customer['ID']}")->fetch_assoc()['AddressID'];
            require_once "address.php";
            $address = Address::createAddress($result);
            $homeAddress = $address->toString();
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