<?php

class home extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;

        
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
            <div class = "topContainer">
                <div class="personalInformation">
                    <h1>Welcome <?php echo $this->model->getAdmin()->getName() ?></h1>
                    <p>Welcome to your dashboard. In here, you can manage the product cycle, stocks, sales, customers, and way more.</p>
                    <div class="fastMenu">
                        <p>A quick menu for your convenience. To access the full menu click on the left slider.</p>
                        <button style = "background-color: #FBAB7E;color: white;" onclick="window.location.replace('productDashboard')" >Products Dashboard</button>
                        <button style = "background-color: #FBAB7E;color: white;" onclick="window.location.replace('customer')" >Customers Dashboard</button>
                        <button style = "background-color: #FBAB7E;color: white;" onclick="window.location.replace('order')" >Orders Dashboard</button>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="generalGrid">
                    <div class="generalChild">
                        <h3>&nbsp;&nbsp;&nbsp;Customers</h3>
                        <hr>
                        <h2><?php echo $this->model->getAdmin()->numCustomers(); ?></h2>
                    </div>
                    <div class="generalChild">
                        <h3>&nbsp;&nbsp;&nbsp;Customer Satisfaction</h3>
                        <hr>
                        <h2><?php echo $this->model->getAdmin()->getAverageSurvey(); ?>%</h2>
                    </div>
                    <div class="generalChild">
                        <h3>&nbsp;&nbsp;&nbsp;Top Region</h3>
                        <hr>
                        <h2><?php echo $this->model->getAdmin()->getTopRegion(); ?></h2>
                    </div>
                    <div class="generalChild">
                        <h3>&nbsp;&nbsp;&nbsp;Stocks health</h3>
                        <?php
                            if($this->model->getAdmin()->checkStock() == 0){
                                echo <<<HTML
                                    <hr style = "outline: none;border: none;height: 2px;background-color: red">
                                    <span style="text-align: center" style="color: red"><i class="fa-solid fa-circle-exclamation"></i><br>Some products need to be restored</span>
                                HTML;
                            }
                            if($this->model->getAdmin()->checkStock() == 1){
                                echo <<<HTML
                                    <hr style = "outline: none;border: none;height: 2px;background-color: orange">
                                    <span style="text-align: center" style="color: orange"><i class="fa-solid fa-circle-exclamation"></i><br>Some products are about to be empty</span>
                                HTML;
                            }
                            if($this->model->getAdmin()->checkStock() == 2){
                                echo <<<HTML
                                    <hr style = "outline: none;border: none;height: 2px;background-color: green">
                                    <div><i class="fa-solid fa-circle-check" style="color: green"></i><br>Nothing to worry about. All products are available.</div>
                                HTML;
                            }
                        ?>
                    </div>
                </div>
                
                <h1 class="topHeader">PRODUCTS</h1>
                <hr>
                <div class="grid-buttons">
                    <div class="productInfo">
                        <h2>Number of Products</h2>
                        <hr>
                        <h4 class = "numProd"><?php echo $this->model->getAdmin()->numProducts(); ?></h4>
                    </div>
                    <div class="productInfo">
                        <h2>Monthly Stock Reciepts</h2>
                        <hr>
                        <p>Month: <?php echo Date("F") ?></p>
                        <h4 class = "monthReport"><strong><?php echo $this->model->getAdmin()->monthlyStockReciepts(); ?></strong>EGP</h4>
                    </div>
                    <button onclick="window.location.replace('stocks')" class="bn39"><span class="bn39span home btn vertical"><span>VIEW STOCK DASHBOARD</span></span></button>
                    <button onclick="window.location.replace('productDashboard')" class="bn39"><span class="bn39span home btn vertical"><span>VIEW PRODUCT DASHBOARD</span></span></button>
                </div>
                <div class="proInformation">
                    <div class="proChild">
                        <h2>Reciepts History</h2>
                    <ul class="chart">
                        <?php
                        $reciepts = $this->model->getAdmin()->recieptHistory();
                        $maximum = $this->model->getAdmin()->getMax($reciepts,"monthReciept");
                            foreach($reciepts as $reciept){
                                $percentage = ($reciept['monthReciept']/($maximum + 100))*100;
                                $month = Date("F",strtotime($reciept['recieptCreation']));
                                echo <<<HTML
                                    <li>
                                        {$reciept['monthReciept']}EGP<span style="height:{$percentage}%" title="{$month}"></span>
                                    </li>
                                HTML;
                            }
                        ?>
                    
                        </ul>  
                    </div>
                    
                            <?php 
                            $bestSeller = $this->model->getAdmin()->bestSeller();
                            if(mysqli_num_rows($bestSeller) == 0){
                                echo <<<HTML
                                <div class="warningChild">
                                    <h2 class=warningClass><i class="fa-solid fa-circle-info"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please note that there might be no orders to decide the best seller.</h2>
                                </div>
                                HTML;
                            } 
                            else{
                                $bestSeller = $bestSeller->fetch_assoc();
                                $prodImage = IMAGEROOT . "product/" . $bestSeller['productImage'];
                                echo <<<HTML
                                    <div class="bestChild">
                                        <h1>BEST SELLER</h1>
                                        <hr>
                                        <div class="bestContainer">
                                            <img src="{$prodImage}" width=200 height=200>
                                            <div class="bestContainerChild">
                                                <h2>{$bestSeller['productName']}</h2>
                                                <p>Quantity sold: <strong>{$bestSeller['productQuantity']}</strong></p>
                                                <p>Product revenue: <strong>{$bestSeller['revenue']}EGP</strong></p>
                                                <p>Current Stock: <strong>{$bestSeller['productStock']}</strong></p>
                                            </div>    
                                        
                                        </div>
                                        
                                    </div>
                                HTML;
                            }
                            ?>
                    
                </div>
                <h1 class="topHeader">FINANCIALS</h1>
                <hr>
                <?php
                    $report = $this->model->getAdmin()->monthlyReport();
                    
                   
                    if(mysqli_num_rows($report) != 0){
                        $reportMonth = $report->fetch_assoc()['createdAt'];
                        $reportMonth = Date("F",strtotime($reportMonth));
                        echo <<<HTML
                            <p class=monthReport id=financialReports>Monthly report for <strong>{$reportMonth}</strong></p>
                        HTML;
                    }

                ?>
                <div class="financeGrid">
                    <?php 
                    $this->model->getAdmin()->updateFinance();
                    $finance = $this->model->getAdmin()->getFinance();
                    if(mysqli_num_rows($finance) == 0){
                        $this->model->getAdmin()->setFinance();
                    }
                    
                    ?>
                    
                        <?php
                            $report = $this->model->getAdmin()->monthlyReport();
                            if(mysqli_num_rows($report) != 0){
                                $report = $report->fetch_assoc();
                                $gross = ceil($report['profit']);
                                $container = <<<HTML
                                    <div class="financeChild">
                                        <h2>Gross Profit</h2>
                                        <span><strong>%</strong></span>
                                        <p><strong>$gross</strong></p>
                                        <div class=normalRevenue><i class="fa-solid fa-angles-up"></i></div>

                                    </div>
                                HTML;
                                if($report['profit'] < 0){
                                    $container = <<<HTML
                                    <div class="financeChildError">
                                        <h2>Gross Profit</h2>
                                        <span><strong>%</strong></span>
                                        <p><strong>$gross</strong></p>
                                        <div class=errorGross><i class="fa-solid fa-angles-down"></i></div>

                                    </div>
                                    HTML;
                                }
                            $prevReport = $this->model->getAdmin()->prevMonthlyReport();
                            $previousPercent = "";
                            $rev = "";
                            $cog = "";
                            if(mysqli_num_rows($prevReport) == 0){
                                $previousPercent = "No Previous Reports";
                                echo <<<HTML
                                    <script>
                                        $("#financialReports").html('{$previousPercent}');
                                    </script>
                                HTML;
                            }
                            else{
                                
                                $prevReport = $prevReport->fetch_assoc();
                                $cog = "";
                                $rev = "";
                                if($report['revenue'] == 0 || $report['expenses'] == 0){
                                    $rev = "Sales are still empty";
                                    $cog = "Sales are still empty";
                                }
                                else{
                                    //$report['revenue'] - $prevReport['revenue'])/
                                $rev = ceil((1-($prevReport['revenue']/$report['revenue']))*100);
                                $cog = ceil((1-($prevReport['expenses']/$report['expenses']))*100);
                                // $rev .= "%";
                                // $cog .= "%";
                                if($rev > 0)
                                    $rev = <<<HTML
                                        <div class="normalRevenue">
                                        <i class="fa-solid fa-angles-up"></i>
                                        <br>
                                            $rev%
                                        </div>
                                    HTML;
                                else{
                                    $rev = <<<HTML
                                        <div class="errorRevenue">
                                        <i class="fa-solid fa-angles-down"></i>
                                        <br>
                                            $rev%
                                        </div>
                                    HTML;
                                }
                                if($cog > 0)
                                    $cog = <<<HTML
                                        <div class="normalRevenue">
                                        <i class="fa-solid fa-angles-up"></i>
                                        <br>
                                            $cog%
                                        </div>
                                    HTML;
                                else{
                                    $cog = <<<HTML
                                        <div class="errorRevenue">
                                        <i class="fa-solid fa-angles-down"></i>
                                        <br>
                                            <strong>$cog%<strong>
                                        </div>
                                    HTML;
                                }
                            }
                            
                            echo <<<HTML
                                
                                <div class="financeChild">
                                    <h2>Revenue</h2>
                                    
                                    <span><strong>EGP</strong></span>
                                    <p class=resultFinance><strong>{$report['revenue']}</strong></p>
                                    <p>$previousPercent $rev</p>
                                </div>
                                <div class="financeChild">
                                
                                    <h2>Cost of Goods</h2>
                                    
                                    <span><strong>EGP</strong></span>
                                    <p class=resultFinance><strong>{$report['expenses']}</strong></p>
                                    <p>$previousPercent $cog</p>
                                    
                                </div>
                                $container
                                
                            HTML;}}
                            else{
                                echo <<<HTML
                                    <div class="emptyContainer">
                                        <h1>Nothing To Show Here...</h1>
                                        <p>There is no sales data to be shown.</p>
                                    </div>
                                HTML;
                            }
                        ?>
                        

                    
                </div>
            </div>

            </body>
            
            </html>

        <?php
    }
}
?>