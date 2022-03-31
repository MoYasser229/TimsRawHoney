<?php 
class stocks extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <div class="mainContainer">
            <h1>Stock</h1>
            <hr>
        </div>
        <div class="searchContainer">
            <h1>SEARCH AND SORT</h1>
            <hr>
        </div>
        <div class="productGrid">
            <div class="productCard">
                <h1>Product Name</h1>
                <hr>
                <h3>Stock: 150</h3>
                <h3>Refresh Stock Cost: 1400 EGP</h3>
                <h3>Stock Limit: 200</h3>
                <button class="update">Update Stock</button>
            </div>
            <div class="productCard">
            <h1>Product Name</h1>
                <hr>
                <h3>Stock: 150</h3>
                <h3>Update Stock Cost: 1400 EGP</h3>
                <h3>Stock Limit: 200</h3>
                <button class="update">Update Stock</button>
            </div>
            <div class="productCard">
            <h1>Product Name</h1>
                <hr>
                <h3>Stock: 150</h3>
                <h3>Update Stock Cost: 1400 EGP</h3>
                <h3>Stock Limit: 200</h3>
                <button class="update">Update Stock</button>
            </div>
            <div class="productCard">
            <h1>Product Name</h1>
                <hr>
                <h3>Stock: 150</h3>
                <h3>Update Stock Cost: 1400 EGP</h3>
                <h3>Stock Limit: 200</h3>
                <button class="update">Update Stock</button>
            </div>
            <div class="productCard">
            <h1>Product Name</h1>
                <hr>
                <h3>Stock: 150</h3>
                <h3>Update Stock Cost: 1400 EGP</h3>
                <h3>Stock Limit: 200</h3>
                <button class="update">Update Stock</button>
            </div>
            <div class="productCard">
            <h1>Product Name</h1>
                <hr>
                <h3>Stock: 150</h3>
                <h3>Update Stock Cost: 1400 EGP</h3>
                <h3>Stock Limit: 200</h3>
                <button class="update">Update Stock</button>
            </div>
        </div>

        <?php

    }
}