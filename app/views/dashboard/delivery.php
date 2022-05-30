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
                <div class="infoGrid">
                    <div class="infoChild">
                        <h1>Number of Pending Products</h1>
                        <h2><?php echo $this->model->getPending(); ?></h2>
                    </div>
                    <div class="infoChild">
                        <h1>Maximum Pending Interval</h1>
                        <h2><?php echo $this->model->getMostDaysPending(); ?></h2>
                    </div>
                </div>
            </div>
            <div class="searchContainer">
                <h1>Search and Sort</h1>
                <hr>
                <input type="text" name=search id=search placeholder="Search Here">
                <button onclick="searchButton()" id=searchButton><i class="fa-solid fa-magnifying-glass"></i></button>
                <select id=type>
                    <option value = "fullName">Customer Name</option>
                    <option value = "orderID">Order ID</option>
                    <option value = "orderTotalPrice">Total Price</option>
                </select>
                <select id="filter">
                    <option value="DESC">Descending</option>
                    <option value=ASC>Ascending</option>
                </select>
            </div>
            <div class="orderGrid">
                <?php $this->model->viewCustomer(); ?>
            </div>
            <div class="confirmDel">
                
            </div>
            <script>
            function searchButton(){
                search = $("#search").val();
                $.ajax({
                    type: "POST",
                    url: "delivery",
                    data:{search:search},
                    success: (result) => {
                        $(".orderGrid").html(result);
                    }
                })
            }
            $("#filter, #type").change(() => {
                filter = $("#filter").val();
                type = $("#type").val();
                $.ajax({
                    type: "POST",
                    url: "delivery",
                    data:{filter: filter,type:type},
                    success: (result) => {
                        $(".orderGrid").html(result);
                    }
                })
            })
            function confirmDelivery(id) {
                $(".confirmDel").css("display","block")
                $(".confirmDel").html("<p>Click yes to confirm the delivery status. Otherwise, click cancel.</p><div class=centeredButtons><button id='confirm' onclick='updateDelivery("+id+")'>Confirm</button><button id='cancel' onclick='location.reload()'>Cancel</button></div>")
            }
            function updateDelivery(id){
                $.ajax({
                    type: 'POST',
                    url: 'delivery',
                    data: {editID:id},
                    success: (result) => {
                        $(".orderGrid").html(result)
                    }
                })
            }
        </script>
        <?php
    }
}