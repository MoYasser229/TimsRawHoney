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
                    <div class="cardChild"><h2>TOP CUSTOMER BY ORDERS</h2><h3><?php echo $this->model->topCustomer()->getName(); ?></h3></div>
                    <div class="cardChild"><h2>NUMBER OF ORDERS</h2><h3><?php echo $this->model->numOrders(); ?></h3></div>
                    <div class="cardChild"><h2>PRODUCTS SOLD</h2><h3><?php echo $this->model->numProducts(); ?></h4></div>
                </div>
            </div>
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1>
                <hr>
                <input type="text" name=search id=search placeholder="Search Here">
                <button onclick="searchButton()" id=searchButton>SEARCH</button>
                <select id=type>
                    <option value = "orderID">ID</option>
                    <option value = "fullName">Customer Name</option>
                    <option value = "orderTotalPrice">Purchase price</option>
                    <option value = "quantity">Order Quantity</option>
                    <option value = "createdAt">Date of Purchase</option>
                </select>
                <select id="filter">
                    <option value="DESC">Descending</option>
                    <option value=ASC>Ascending</option>
                </select>
            </div>
            <div class="gridCustomer">
                <?php
                    $this->model->databaseOrders();
                    $this->model->display();
                ?>
                </div>
                <script>
                    function searchButton() {
                        search = $("#search").val();
                        $.ajax({
                            type: "POST",
                            url: "order",
                            data: {search: search},
                            success: (result) => {
                                $(".gridCustomer").html(result);
                                // console.log(result);
                            }
                        })
                    }
                </script>
        <?php
    }
}