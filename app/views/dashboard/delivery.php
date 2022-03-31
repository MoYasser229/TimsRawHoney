<?php

class delivery extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class="mainContainer">
                <h1>Customer Delivery</h1>
                <hr>
            </div>
            <div class="searchContainer">
                <h1>Search and Sort</h1>
                <hr>
            </div>
            <div class="pendingContainer">
                <h1>Pending Orders</h1>
            </div>
            <div class="orderGrid">
                <div class="orderCard">
                <h2>Customer Name</h2>
                <hr>
                <h3>Order Serial: 1a2b3c4p</h3>
                <h3>Total Price: 130 EGP</h3>
                <button class = "deliveryLink">Send Bosta Link</button>
                </div>
                <div class="orderCard">
                <h2>Customer Name</h2>
                <hr>
                <h3>Order Serial: 1a2b3c4p</h3>
                <h3>Total Price: 130 EGP</h3>
                <button class = "deliveryLink">Send Bosta Link</button></div>
                <div class="orderCard">
                <h2>Customer Name</h2>
                <hr>
                <h3>Order Serial: 1a2b3c4p</h3>
                <h3>Total Price: 130 EGP</h3>
                <button class = "deliveryLink">Send Bosta Link</button>
                </div>
            </div>
        <?php
    }
}