<?php
class customer extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <div class="mainContainer">
                <h1>Customers</h1>
                <hr>
                <div class="gridCards">
                    <div class="cardChild"><h2>TOP CUSTOMER</h2><h3>Customer Name</h3></div>
                    <div class="cardChild"><h2>NUMBER OF CUSTOMERS</h2><h3>150</h3></div>
                    <div class="cardChild"><h2>ACTIVE CUSTOMERS</h2><h3>50</h4></div>
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
                    <h3>Phone Numbers:<br> 11111111 and 11111111</h3>
                    <h3>Home Address: Location.</h3>
                    <h3>Number of Orders: 30</h3>
                </div>
            
            <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Phone Numbers:<br> 11111111 and 11111111</h3>
                    <h3>Home Address:<br> Location.</h3>
                    <h3>Number of Orders: 30</h3>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Phone Numbers:<br> 11111111 and 11111111</h3>
                    <h3>Home Address:<br> Location.</h3>
                    <h3>Number of Orders: 30</h3>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Phone Numbers:<br> 11111111 and 11111111</h3>
                    <h3>Home Address:<br> Location.</h3>
                    <h3>Number of Orders: 30</h3>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Phone Numbers: <br> 11111111 and 11111111</h3>
                    <h3>Home Address:<br> Location.</h3>
                    <h3>Number of Orders: 30</h3>
                </div>
                <div class="customerCard">
                    <h2>Customer Name</h2>
                    <hr>
                    <h3>Phone Numbers:<br> 11111111 and 11111111</h3>
                    <h3>Home Address:<br> Location.</h3>
                    <h3>Number of Orders: 30</h3>
                </div>
                </div>
        <?php
    }
}