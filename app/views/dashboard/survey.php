<?php

class Survey extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class="mainContainer">
                <h1>Survey</h1>
                <hr>
                <div class="gridTable">
                    <div class="cardTable">
                        <h1>140</h1>
                        <h2>Number of Surveys Done</h2>
                    </div>
                    <div class="cardTable">
                        <h1>50%</h1>
                        <h2>Customer Satistisfaction Rate</h2>
                    </div>
                </div>
            </div>
            <div class="searchContainer">
            <h1>Search and Sort</h1>
            <hr>
        </div>
        <div class="surveyGrid">
            <div class="surveyCard">
                <h1>Customer Name</h1>
                <hr>
                <h3>Customer Satisfaction: 15%</h3>
                <h3>Customer ID: 12wq23423</h3>
                <h3>Customer Phone Number: +2012343455</h3>
            </div>
            <div class="surveyCard">
                <h1>Customer Name</h1>
                <hr>
                <h3>Customer Satisfaction: 15%</h3>
                <h3>Customer ID: 12wq23423</h3>
                <h3>Customer Phone Number: +2012343455</h3>
            </div>
            <div class="surveyCard">
                <h1>Customer Name</h1>
                <hr>
                <h3>Customer Satisfaction: 15%</h3>
                <h3>Customer ID: 12wq23423</h3>
                <h3>Customer Phone Number: +2012343455</h3>
            </div>
            <div class="surveyCard">
                <h1>Customer Name</h1>
                <hr>
                <h3>Customer Satisfaction: 15%</h3>
                <h3>Customer ID: 12wq23423</h3>
                <h3>Customer Phone Number: +2012343455</h3>
            </div>
            <div class="surveyCard">
                <h1>Customer Name</h1>
                <hr>
                <h3>Customer Satisfaction: 15%</h3>
                <h3>Customer ID: 12wq23423</h3>
                <h3>Customer Phone Number: +2012343455</h3>
            </div>
            <div class="surveyCard">
                <h1>Customer Name</h1>
                <hr>
                <h3>Customer Satisfaction: 15%</h3>
                <h3>Customer ID: 12wq23423</h3>
                <h3>Customer Phone Number: +2012343455</h3>
            </div>
        </div>

        <?php
    }
}