<?php
class salesModel extends Model{
    public $title = "Tim's Raw Honey";
    public $icon = IMAGEROOT . "icon/";
    public $css = URLROOT . "css/dashboard/salesStyles.css";
    public $headercss = URLROOT . "css/dashboard/headerStyles.css";
    public function topRegion(){
        $result = $this->database->query("SELECT region FROM user_address WHERE addressID = (SELECT addressID FROM orders GROUP BY addressID ORDER BY SUM(orderTotalPrice) DESC LIMIT 1)");
        if(mysqli_num_rows($result) != 0)
            return $result->fetch_assoc()['region'];
        return "NONE";
    }
    public function activeRegions(){
        $result = $this->database->query("SELECT COUNT(DISTINCT ua.region) as regions from user_address as ua, users as u, orders as o where u.ID = ua.customerID and o.addressID=ua.AddressID LIMIT 1;");
        if(mysqli_num_rows($result) != 0)
            return $result->fetch_assoc()['regions'] . " region(s)";
        return "NONE";
    }
    public function search($search){
        $result = $this->database->query("SELECT *,SUM(ordertotalprice) as regiontotPrice FROM orders,user_address WHERE user_address.AddressID = orders.addressID AND region LIKE '%$search%' GROUP BY region;");
        foreach($result as $region){
            echo <<<HTML
                <div class="regionCard">
                <h1>{$region['region']}</h1>
                <hr>
                <h3>Sales Revenue: {$region['regiontotPrice']} EGP</h3>
                </div>
            HTML;
        }
    }
    public function filter($filter,$type){
        $result = $this->database->query("SELECT *,SUM(ordertotalprice) as regiontotPrice FROM orders,user_address WHERE user_address.AddressID = orders.addressID GROUP BY region ORDER BY $type $filter");
        foreach($result as $region){
            echo <<<HTML
                <div class="regionCard">
                <h1>{$region['region']}</h1>
                <hr>
                <h3>Sales Revenue: {$region['regiontotPrice']} EGP</h3>
                </div>
            HTML;
        }
    }
    public function viewRegions(){
        $result = $this->database->query("SELECT *,SUM(ordertotalprice) as regiontotPrice FROM orders,user_address WHERE user_address.AddressID = orders.addressID GROUP BY region;");
        if(mysqli_num_rows($result) == 0){
            echo <<<HTML
                <div class="emptyClass">
                <h1><i class="fa-solid fa-circle-info"></i></h1>
                <h1>Something Went Wrong...</h1>
                <h3>1) There are no orders created to view the regions of sales</h3>
                <h3>2) Searched Item is unavailable. Try searching again</h3>
                </div>
            HTML;
            return;
        }
        echo "<div class='regionGrid'>";
        foreach($result as $region){
            
            echo <<<HTML
                <div class="regionCard">
                <h1>{$region['region']}</h1>
                <hr>
                <h3>Sales Revenue: {$region['regiontotPrice']} EGP</h3>
                </div>
            HTML;
        }
        echo "</div>";
    }
}