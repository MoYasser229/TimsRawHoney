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
                <div class="infoChild">
                    <?php $expensiveManifacture = $this->model->getManifacturingCost(); ?>
                    <h2><?php echo $expensiveManifacture['manifactureCost']?> EGP</h2>
                    <h3><?php echo $expensiveManifacture['productName']?> Manifacture Cost</h3>
                </div>
            </div>
        </div>
        <div class="operationGrid">
        <div class="simulationCard">
            <h1>Stock Calculation</h1>
            <hr>
            <p>The prices are given if adding: </p>
            <div class="valueProduct">
            <button id=decrease> <i class="fa-solid fa-minus"></i> </button><input type="text" value=10 id=products><button id=increase> <i class="fa-solid fa-plus"></i> </button>
            </div>
            
            <?php
            $this->model->setProducts();
            $products = $this->model->getProducts();
            $numProducts = mysqli_num_rows($products);
            $i = 1;
            while($product = $products->fetch_assoc()){
                $before = ($i != 1)? $i - 1: $i;
                $after = ($i == $numProducts)?$i:$i + 1;
                echo <<<EOS
                    <input type='hidden' id=numProducts value = $numProducts>
                    <div class="stockInfo" id=product{$product['ID']}>
                        <input type='hidden' id=prodID$i value = {$product['ID']}>
                        <h2>{$product['productName']}</h2>
                        <input type='hidden' id='stockCost$i' value= '{$product['manifactureCost']}'>
                        <div class = stockPrice id=viewStock$i></div>
                        <button id=before onclick='before(this.value,{$product['ID']})' value = $before><i class="fa-solid fa-angle-left"></i> PREVIOUS PRODUCT</button><button id=after onclick='after(this.value,{$product['ID']})' value = $after>NEXT PRODUCT <i class="fa-solid fa-angle-right "></i></button>
                    </div>
                    
                EOS;
                $i+=1;
            }
            ?>
        </div>
        <div class="stockFinanceCard">
            <?php $this->model->displayRecieptsPrices(); ?>
        </div>
        <div class="stockRecieptsCard">
            Hello
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
        <script>
            myString = "Price to fullfill the stocks: "
            numProducts = $("#numProducts").val()
            arrayProduct = []
            arrayProduct[0] = $('#prodID'+1).val()
            // alert($('#stockCost1').val())
            stockCost = $('#stockCost1').val()
            cost = stockCost * parseInt($("#products").val())
            currentProd = 1
            $("#viewStock" + 1).html(myString + cost + "EGP")
            for(i = 2; i <= numProducts;i++){
                $("#product" + $('#prodID'+i).val()).css("display","none")
                arrayProduct[i-1] = $('#prodID'+i).val()
                stockCost = $('#stockCost'+i).val()
                cost = stockCost * parseInt($("#products").val())
                $("#viewStock" + i).html(myString + cost + "EGP")
            }
            
            function before(before,current){
                $("#product" + current).css("display","none")
                $("#product"+arrayProduct[before-1]).css("display","block")
                currentProd = before
                cost = $('#stockCost'+currentProd).val() * parseInt($("#products").val())
                $("#viewStock" + currentProd).html(myString + cost + "EGP")
            }
            function after(after,current){
                $("#product" + current).css("display","none")
                $("#product"+arrayProduct[after-1]).css("display","block")
                currentProd = after
                cost = $('#stockCost'+currentProd).val() * parseInt($("#products").val())
                $("#viewStock" + currentProd).html(myString + cost + "EGP")
            }
            $("#decrease").click(() => {
                if($("#products").val() > 0){
                    $("#products").val($("#products").val() - 1);
                    cost = $('#stockCost'+currentProd).val() * parseInt($("#products").val())
                    $("#viewStock" + currentProd).html(myString + cost + "EGP")
                }
            })
            $("#products").change(() => {
                if($("#products").val() > 0){
                    cost = $('#stockCost'+currentProd).val() * parseInt($("#products").val())
                    $("#viewStock" + currentProd).html(myString + cost + "EGP")
                }
            })
            $("#increase").click(() => {
                $("#products").val(parseInt($("#products").val()) + 1);
                cost = $('#stockCost'+currentProd).val() * parseInt($("#products").val())
                $("#viewStock" + currentProd).html(myString + cost + "EGP")
            })
            function increaseStock(ID) {
                $("#productStock" + ID).val(parseInt($('#productStock' + ID).val()) + parseInt('1'))
                // alert(ID)
            }
            function decreaseStock(ID) {
                if(($("#productStock" + ID).val() - 1) >= $("#currentStock").val())
                    $("#productStock" + ID).val($("#productStock" + ID).val() - 1)
            }
        </script>
        <?php

    }
}