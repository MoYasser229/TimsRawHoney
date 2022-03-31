<?php
class order extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class="mainContainer">
                <h1>Orders</h1>
                <hr>
                <div class="gridCards">
                    <div class="cardChild"><h2>TOP CUSTOMER BY ORDERS</h2><h3>Customer Name</h3></div>
                    <div class="cardChild"><h2>NUMBER OF ORDERS</h2><h3>150</h3></div>
                    <div class="cardChild"><h2>PRODUCTS SOLD</h2><h3>50</h4></div>
                </div>
            </div>
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1>
                <hr>
            </div>
            <div class="gridCustomer">
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Number of Products: 5</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Total Price: 130 EGP</h3>
                    <button class="viewButton">View Reciept</button>
                </div>
            
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Number of Products: 5</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Total Price: 130 EGP</h3>
                    <button class="viewButton">View Reciept</button>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Number of Products: 5</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Total Price: 130 EGP</h3>
                    <button class="viewButton">View Reciept</button>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Number of Products: 5</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Total Price: 130 EGP</h3>
                    <button class="viewButton">View Reciept</button>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Number of Products: 5</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Total Price: 130 EGP</h3>
                    <button class="viewButton">View Reciept</button>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Number of Products: 5</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Total Price: 130 EGP</h3>
                    <button class="viewButton">View Reciept</button>
                </div>
                </div>
        <?php
    }
}