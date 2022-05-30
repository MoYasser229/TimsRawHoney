<?php
require_once "Customer.php";
require_once "Product.php";
require_once "Order.php";
// require_once "";
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
        $result = $this->database->query("SELECT *,orders.ID as orderID FROM ORDERS,users WHERE users.ID = customerID ORDER BY COUNT(customerID) DESC LIMIT 1;");
        $row = $result->fetch_assoc();
        $order = new Orders($row['orderID'],new Customer($row['customerID']));
        $topCustomer = $order->getCustomer();
        return $topCustomer;
    }
    public function numOrders(){
        return $this->topCustomer()->getNumOrders();
    }
    public function numProducts(){
        $result = $this->database->query("SELECT SUM(quantity) as orderquantity FROM orderitems")->fetch_assoc();
        return $result['orderquantity'];
    }
    public function databaseOrders(){
        $result =  $this->database->query("SELECT * FROM orders,orderitems,users WHERE orders.ID = orderItems.orderID AND users.ID = orderItems.customerID GROUP BY orderitems.orderID");
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