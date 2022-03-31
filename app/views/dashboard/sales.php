<?php

class sales extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <div class="mainContainer">
            <h1>Sales</h1>
            <hr>
            <div class="gridContainer">
                <div class="gridChild">
                    <h1>Net Profit</h1>
                    <h2>50%</h2>
                </div>
                <div class="gridChild">
                    <h1>Best region</h1>
                    <h2>Cairo</h2>
                </div>
            </div>
        </div>
        <div class="searchContainer">
            <h1>Search and Sort</h1>
            <hr>
        </div>
        <div class="regionGrid">
            <div class="regionCard">
                <h1>Region Name</h1>
                <hr>
                <h3>Sales Revenue: 300 EGP</h3>
                <h3>Number of Products Sold: 10</h3>


            </div>
            <div class="regionCard">
                <h1>Region Name</h1>
                <hr>
                <h3>Sales Revenue: 300 EGP</h3>
                <h3>Number of Products Sold: 10</h3>
                

            </div>
            <div class="regionCard">
                <h1>Region Name</h1>
                <hr>
                <h3>Sales Revenue: 300 EGP</h3>
                <h3>Number of Products Sold: 10</h3>
                

            </div>
            <div class="regionCard">
                <h1>Region Name</h1>
                <hr>
                <h3>Sales Revenue: 300 EGP</h3>
                <h3>Number of Products Sold: 10</h3>
                

            </div>
            <div class="regionCard">
                <h1>Region Name</h1>
                <hr>
                <h3>Sales Revenue: 300 EGP</h3>
                <h3>Number of Products Sold: 10</h3>
                

            </div>
            <div class="regionCard">
                <h1>Region Name</h1>
                <hr>
                <h3>Sales Revenue: 300 EGP</h3>
                <h3>Number of Products Sold: 10</h3>
                

            </div>
        </div>
        <?php
    }
}