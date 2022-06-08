<?php
require_once "Customer.php";
require_once "Product.php";
require_once "Order.php";

// require_once "";
class orderModel extends Model implements filter{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/orderStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $orders;
    public function search($table,$columns,$search){
        $result = $this->database->query("SELECT * FROM $table WHERE $columns");s
        $this->orders = $result; 
    }
    public function sort($table,$type,$filter){
        $result = $this->database->query("SELECT * FROM $table ORDER BY $type $filter");
        return $result;
    }
    public function getOrders(){
        return $this->orders;
    }
    public function setOrders($orders){
        $this->orders = $orders;
    }
    public function topCustomer(){
        $result = $this->database->query("SELECT orders.ID as orderID,SUM(orderTotalPrice) as customerTotalPrice,customerID FROM ORDERS GROUP BY customerID ORDER BY customerTotalPrice DESC LIMIT 1;");
        if(mysqli_num_rows($result) != 0){
            $row = $result->fetch_assoc();
            return new Customer($row['customerID']);
        }
        return false;
    }
    public function numOrders(){
        $result = $this->database->query("SELECT COUNT(orderID) as ordernum FROM orders as o, deliveries as d WHERE d.orderID=o.ID and d.deliveryStatus='DELIVERED'");
        if(mysqli_num_rows($result) == 0){
            return "NONE";
        }
        return $result->fetch_assoc()['ordernum'];
    }
    public function numProducts(){
        $result = $this->database->query("SELECT SUM(quantity) as orderquantity FROM orderitems");
        if(mysqli_num_rows($result) == 0){
            return "NONE";
        }
        return $result->fetch_assoc()['orderquantity'];
    }
    public function databaseOrders(){
        $result =  $this->database->query("SELECT * FROM orders,orderitems,users,deliveries WHERE orders.ID = orderItems.orderID AND users.ID = orderItems.customerID and orders.ID=deliveries.orderID and deliveries.deliveryStatus='DELIVERED' GROUP BY orderitems.orderID");
        $this->orders = $result;
    }
    public function display(){
        // require_once "Order.php";
        if(mysqli_num_rows($this->orders) == 0){
            echo "&nbsp";
            echo "<div class = emptyContainer>Nothing Was Found. Please try again.</div>";
        }
        foreach($this->orders as $order){
            $orderList = new Orders($order['orderID'],new Customer($order['customerID']));
            echo "
            <div class=customerCard>
                <h2>{$orderList->getID()}. {$orderList->getCustomer()->getName()}</h2>
                <h4>Date of Purchase &nbsp;&nbsp; {$orderList->getDate()}</h4>
                <hr>
                
                <div class='orderGrid'>
                    <div class='orderChild'>
                        <h2>Quantity</h2>
                        <h3> {$orderList->getQuantity()}</h3>
                    </div>
                    <div class='orderChild'>
                        <h2>Total Price</h2>
                        <h3> {$orderList->getPrice()}</h3>
                    </div>
                    
                </div>
                <div class='customerChild'>
                    <h2>Home Address</h2>
                    <h3>{$orderList->getCustomer()->getAddress1()->toString()}</h3>
                </div>
                
                <button onclick='viewOrder(this.value,{$orderList->getCustomer()->getID()})' class=viewButton value='".$orderList->getID()."'>VIEW ORDERS DETAIL</button>
            </div>
            ";
        }
    }
    // public function displayOrder($order){
        
    // }
}