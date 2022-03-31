<?php

class home extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;

        //SUMMARY
        $numOfProducts = $this->model->getProducts();
        $revenue = $this->model->getRevenue();
        $order = $this->model->getOrders();
        $sold = $this->model->getSold();

        //PRODUCTS
        $products = $this->model->getThreeProducts();
        $stock = $this->model->getLeastStock();
        $bestSeller = $this->model->getBestSeller();

        //CUSTOMER
        $customers = $this->model->getCustomers();
        $activeCustomers = $this->model->getActiveCustomers();

        //FINANCIALS
        $expenses = $this->model->getExpenses();
        $profit = $this->model->getProfit();
        $recordedDate = $this->model->getRecordedDate();
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class = "topContainer">
                <h1 class = "topHeader">DASHBOARD</h1>
                <hr>
                <div class = "grid-cards">
                    <div class="card">
                            <h1><?php echo $sold; ?><br> <p> PRODUCTS SOLD</p> </h1>
                    </div>
                    <div class="card">
                        <h1><?php echo 'CAIRO'; ?><br> <p> BEST SALES BY REGION</p> </h1>
                    </div>
                    <div class="card">
                        <h1><?php echo $revenue; ?> EGP<br> <p> REVENUE</p> </h1>
                    </div>
                    <div class="card">
                        <h1><?php echo $order; ?><br> <p> ORDERS</p> </h1>
                    </div>
                </div>
                
                <h1 class="topHeader">PRODUCTS</h1>
                <hr>
                <div class="grid-buttons">
                    <button class="bn39" href="/"><span class="bn39span home btn vertical"><i class="fa-solid fa-file icon"></i> <br>  <span>VIEW ALL PRODUCTS</span> </span></button>
                    <button class="bn39 " href="/"><span class="bn39span home btn vertical"><i class="fa-solid fa-plus btnIcon icon"></i> <br> <span>ADD PRODUCT</span> </span></button> 
                </div>
                <div class="grid-table">
                <table>
                    
                    <thead>
                        <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Stock</th>
                        <th scope="col">Product Price</th>
                        <th scope="col">Product Size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td data-label="Product Name">Immune Honey</td>
                        <td data-label="Product Stock">25</td>
                        <td data-label="Product Price">150 EGP</td>
                        <td data-label="Product Size">2.5 kg</td>
                        </tr>
                        <tr>
                        <td data-label="Product Name">Immune Honey</td>
                        <td data-label="Product Stock">25</td>
                        <td data-label="Product Price">150 EGP</td>
                        <td data-label="Product Size">2.5 kg</td>
                        </tr>
                        <tr>
                        <td data-label="Product Name">Immune Honey</td>
                        <td data-label="Product Stock">25</td>
                        <td data-label="Product Price">150 EGP</td>
                        <td data-label="Product Size">2.5 kg</td>
                        </tr>
                    </tbody>
                    </table>

                    <div class="card">
                        <h1><?php echo $stock[1][0]; ?><br> <p> <?php echo strtoupper($stock[0][0]); ?> STOCK</p> </h1>
                    </div>
                    <div class="card">
                        <h1>IMMUNE HONEY<br> <p> BEST SELLER</p> </h1>
                    </div>
                
                </div>
                <h1 class = "topHeader">CUSTOMERS</h1>
                <hr>
                <button class="bn39 customerButton" href="/"><span class="bn39span home btn vertical"><i class="fa-solid fa-file icon"></i> <br>  <span>VIEW ALL CUSTOMERS</span> </span></button>
                <div class="grid-cards">
                
                    <div class="card"><h1><?php echo $customers; ?> <br> <p>CUSTOMERS</p></h1></div>
                    <div class="card"><h1><?php echo $activeCustomers; ?> <br> <p>ACTIVE CUSTOMERS</p></h1></div>
                </div>
                
                <h1 class="topHeader">FINANCIALS</h1>
                <hr>
                <div class="grid-cards">
                    <div class="card"><h1><?php echo $revenue; ?> EGP <br> <p>REVENUE</p> </h1></div>
                    <div class="card"><h1><?php echo $expenses; ?> EGP <br> <p>EXPENSES</p></h1></div>
                    <div class="card"><h1><?php echo $profit; ?> EGP <br> <p>PROFIT</p></h1></div>
                    <div class="card"><h1><?php echo $recordedDate; ?> DAYS <br> <p>DATA RECORDED FROM</p></h1></div>
                </div>
            </div>

            </body>
            
            </html>

        <?php
    }
}
?>