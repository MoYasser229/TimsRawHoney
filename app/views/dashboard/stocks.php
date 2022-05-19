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
            <p>All information related to the stock is avaialable here. Want to update the stock of a specific
                product? Below is a list of the products where you can update the stock.
            </p>
            <div class="infoGrid">
                <div class="infoChild">
                    <h2><?php echo $this->model->getSold()['sold']; ?></h2>
                    <h3>PRODUCTS SOLD</h3>
                </div>
                <div class="infoChild">
                    <h2><?php echo $this->model->getLeastStock()['productName']?></h2>
                    <h3>The Least Stock</h3>
                </div>
            </div>
        </div>
        <div class="searchContainer">
            <h1>SEARCH AND SORT</h1>
            <hr>
        </div>
        <div class="productGrid">
            <?php
                $this->model->setProducts();
                $this->model->display();
            ?>
        </div>

        <?php

    }
}