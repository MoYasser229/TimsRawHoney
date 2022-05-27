<?php
class salesModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/salesStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    public function topRegion(){
        $result = $this->database->query("SELECT region FROM user_address WHERE addressID = (SELECT addressID FROM orders GROUP BY addressID ORDER BY SUM(orderTotalPrice) DESC LIMIT 1)")->fetch_assoc()['region'];
        return $result;
    }
    public function activeRegions(){
        $result = $this->database->query("SELECT COUNT(addressID) as regions FROM orders GROUP BY addressID LIMIT 1;")->fetch_assoc()['regions'];
        return $result;
    }
    public function search($search){
        $result = $this->database->query("SELECT region,quantity,SUM(quantity) as totproduct,SUM(orderTotalPrice) as regiontotPrice FROM orders,orderitems,products,user_address WHERE user_address.AddressID = orders.addressID AND user_address.customerID = orders.customerID AND orders.ID = orderitems.orderID AND orderitems.productID = products.ID AND region LIKE '%$search%' GROUP BY orders.addressID;");
        foreach($result as $region){
            echo <<<HTML
                <div class="regionCard">
                <h1>{$region['region']}</h1>
                <hr>
                <h3>Sales Revenue: {$region['regiontotPrice']} EGP</h3>
                <h3>Number of Products Sold: {$region['totproduct']}</h3>
                </div>
            HTML;
        }
    }
    public function filter($filter,$type){
        $result = $this->database->query("SELECT region,quantity,SUM(quantity) as totproduct,SUM(orderTotalPrice) as regiontotPrice FROM orders,orderitems,products,user_address WHERE user_address.AddressID = orders.addressID AND user_address.customerID = orders.customerID AND orders.ID = orderitems.orderID AND orderitems.productID = products.ID GROUP BY orders.addressID ORDER BY $type $filter");
        foreach($result as $region){
            echo <<<HTML
                <div class="regionCard">
                <h1>{$region['region']}</h1>
                <hr>
                <h3>Sales Revenue: {$region['regiontotPrice']} EGP</h3>
                <h3>Number of Products Sold: {$region['totproduct']}</h3>
                </div>
            HTML;
        }
    }
    public function viewRegions(){
        $result = $this->database->query("SELECT region,quantity,SUM(quantity) as totproduct,SUM(orderTotalPrice) as regiontotPrice FROM orders,orderitems,products,user_address WHERE user_address.AddressID = orders.addressID AND user_address.customerID = orders.customerID AND orders.ID = orderitems.orderID AND orderitems.productID = products.ID GROUP BY orders.addressID;");
        foreach($result as $region){
            echo <<<HTML
                <div class="regionCard">
                <h1>{$region['region']}</h1>
                <hr>
                <h3>Sales Revenue: {$region['regiontotPrice']} EGP</h3>
                <h3>Number of Products Sold: {$region['totproduct']}</h3>
                </div>
            HTML;
        }
    }
}