<?php 

 class deliveryModel extends Model{
     public $title = "Tim's Raw Honey";
     public $icon = IMAGEROOT . "icon/";
     public $css = URLROOT . "css/dashboard/deliveryStyles.css";
     public $headercss = URLROOT . "css/dashboard/headerStyles.css";
     public function getPending(){
         $result = $this->database->query("SELECT * FROM deliveries WHERE deliveryStatus = 'PENDING'");
        return (mysqli_num_rows($result) == 0)?"NONE":mysqli_num_rows($result);
     }
     public function getMostDaysPending(){
         $result = $this->database->query("SELECT createdAt FROM deliveries,orders WHERE orders.ID = deliveries.orderID AND deliveryStatus = 'PENDING' ORDER BY createdAt ASC LIMIT 1;");
         if(mysqli_num_rows($result) != 0){
             $result = $result->fetch_assoc()['createdAt'];
         $date = new DateTime(Date("Y-m-d",strtotime($result)));
         $curr = new DateTime(Date("Y-m-d"));
         $date = $curr->diff($date);
         return $date->format('%a days');}


     }
     public function viewCustomer(){
        $result = $this->database->query("SELECT * FROM deliveries,orders,users WHERE deliveryStatus = 'PENDING' AND orders.ID = deliveries.orderID AND orders.customerID = users.ID;");
        foreach($result as $customer){
            $this->displayCard($customer);
        }
     }
     public function search($search){
         $result = $this->database->query("SELECT * FROM deliveries,orders,users WHERE deliveryStatus = 'PENDING' AND orders.ID = deliveries.orderID AND orders.customerID = users.ID AND fullName LIKE '%$search%'");
         foreach($result as $customer){
             $this->displayCard($customer);
         }
     }
     public function filter($filter,$type){
         $result = $this->database->query("SELECT * FROM deliveries,orders,users WHERE deliveryStatus = 'PENDING' AND orders.ID = deliveries.orderID AND orders.customerID = users.ID ORDER BY $type $filter ");
         foreach($result as $customer){
             $this->displayCard($customer);
         }
     }
     public function updateDelivery($ID){
         $result = $this->database->query("UPDATE deliveries SET deliveryStatus = 'DELIVERED' WHERE orderID = '$ID'");
         
     }
     public function displayCard($customer){
        echo <<<HTML
            <div class="orderCard">
                <h2>{$customer['fullName']}</h2>
                <hr>
                <h3>Order Serial: {$customer['orderID']}</h3>
                <h3>Total Price: {$customer['orderTotalPrice']} EGP</h3>
                <button class = "deliveryLink" onclick="confirmDelivery({$customer['orderID']})">Confirm Delivery</button>
            </div>
        HTML;
     }
 }