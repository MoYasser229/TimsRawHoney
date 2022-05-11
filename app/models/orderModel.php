<?php

class orderModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/orderStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    private $orders;
    public function getOrders(){
        return $this->orders;
    }
    public function setOrders($orders){
        $this->orders = $orders;
    }
    public function topCustomer(){
        $result = $this->database->query("SELECT fullName FROM ORDERS,users WHERE users.ID = customerID ORDER BY COUNT(customerID) DESC LIMIT 1;");
        return $result->fetch_assoc();
    }
    public function numOrders(){
        $result = $this->database->query("SELECT * FROM ORDERS");
        return mysqli_num_rows($result);
    }
    public function numProducts(){
        $result = $this->database->query("SELECT DISTINCT productID FROM orderitems");
        return mysqli_num_rows($result);
    }
    public function databaseOrders(){
        $result =  $this->database->query("SELECT * FROM orders,orderitems,users WHERE orders.ID = orderItems.orderID AND users.ID = orderItems.customerID GROUP BY orders.customerID");
        $this->orders = $result;
    }
    public function display(){
        foreach($this->orders as $order){
            echo "
            <div class=customerCard>
                <h2>{$order['fullName']}</h2>
                <hr>
                <h3>Number of products: {$order['quantity']}</h3>
                <h3>Home Address: {$order['homeAddress1']}</h3>
                <h3>Total Price: {$order['orderTotalPrice']}</h3>
                <button onclick='viewOrder(this.value)' class=viewButton value={$order['orderID']}>VIEW ORDERS DETAIL</button>
            </div>
            ";
        }
    }
}