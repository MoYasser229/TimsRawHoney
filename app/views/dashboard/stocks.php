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
                    <h2><?php echo $this->model->getSold(); ?></h2>
                    <h3>PRODUCTS SOLD</h3>
                </div>
                <div class="infoChild">
                    <h2><?php echo $this->model->getLeastStock()['productName'];?></h2>
                    <h3>The Least Stock</h3>
                </div>
                <div class="infoChild">
                    <?php $expensiveManifacture = $this->model->getManifacturingCost(); 
                    if($expensiveManifacture === false){
                        echo <<<HTML
                            <h2>NONE</h2>
                            <h3>There are no products</h3>
                        HTML;
                    }
                    else{
                        echo <<<HTML
                            <h2>{$expensiveManifacture['manifactureCost']} EGP</h2>
                            <h3>{$expensiveManifacture['productName']} Manifacture Cost</h3>
                        HTML;
                    }
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="operationGrid">
        <div class="simulationCard">
            <h1>Stock Calculation</h1>
            <hr>
            <p>The prices are given if adding: </p>
            <div class="valueProduct">
                <button id=decrease> <i class="fa-solid fa-minus"></i></button><input type="text" value=10 id=productsSimulation><button id=increase> <i class="fa-solid fa-plus"></i> </button>
            </div>
            
            <?php
            $this->model->setProducts();
            $products = $this->model->getProducts();
            $numProducts = mysqli_num_rows($products);
            $i = 1;
            while($product = $products->fetch_assoc()){
                $before = ($i != 1)? $i - 1: $i;
                $after = ($i == $numProducts)?$i:$i + 1;
                echo <<<HTML
                    <input type='hidden' id=numProducts value = $numProducts>
                    <div class="stockInfo" id=product{$product['ID']}>
                        <input type='hidden' id=prodID$i value = {$product['ID']}>
                        <h2>{$product['productName']}</h2>
                        <input type='hidden' id='stockCost$i' value= '{$product['manifactureCost']}'>
                        <div class = stockPrice id=viewStock$i></div>
                        
                        <button id=before onclick="before(this.value,{$product['ID']})" value = $before><i class="fa-solid fa-angle-left"></i> PREVIOUS PRODUCT</button><button id=after onclick='after(this.value,{$product['ID']})' value = $after>NEXT PRODUCT <i class="fa-solid fa-angle-right "></i></button>
                    </div>
                HTML;
                $i+=1;
            }
            ?>
        </div>
        <div class="stockFinanceCard">
            <?php $this->model->displayRecieptsPrices(); ?>
        </div>
        <div class="stockRecieptsCard">
            <?php $this->model->getReciepts();?>
        </div>
        </div>
       <div class="recieptContainer">
           
       </div>
        <div class="searchContainer">
            <h1>SEARCH AND SORT</h1>
            <hr>
            <input type="text" id="search" placeholder="Search Here">
            <button id="searchButton" onclick="searchStock()"><i class="fa-solid fa-magnifying-glass"></i></button>
            <select id=type>
                <option value = productName>Product Name</option>
                <option value = productStock>Product Stock</option>
            </select>
            <select id=filter>
                <option value=DESC>Descending</option>
                <option value=ASC>Ascending</option>
            </select>
        </div>
        <div class="productGrid">
            <?php
                $this->model->setProducts();
                $this->model->display();
            ?>
        </div>
        <div class="saveContainer">
            <span>Please enter save to accept the added stocks. Or click cancel to abort.</span>
            <button class=saveButton id=saveButton>SAVE</button>
            <button class=closeButton id=closeButton><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="empty"></div>
        <script>
            
            $("#type,#filter").change(() => {
                type = $("#type").val();
                filter = $("#filter").val();
                $.ajax({
                    type: 'POST',
                    url: 'stocks',
                    data: {type: type, filter: filter},
                    success: (result) => {
                        $(".productGrid").html(result)
                    }
                })
            })
            function searchStock(){
                search = $("#search").val()
                $.ajax({
                    type: 'POST',
                    url: 'stocks',
                    data: {search:search},
                    success: (result) => {
                        $(".productGrid").html(result);
                    }
                })
            }
            myString = "Price to fullfill the stocks: "
            numProducts = $("#numProducts").val()
            arrayProduct = []
            arrayProduct[0] = $('#prodID'+1).val()
            // alert($('#stockCost1').val())
            stockCost = $('#stockCost1').val()
            cost = stockCost * parseInt($("#productsSimulation").val())
            currentProd = 1
            $("#viewStock" + 1).html(myString + cost + "EGP")
            for(i = 2; i <= numProducts;i++){
                $("#product" + $('#prodID'+i).val()).css("display","none")
                arrayProduct[i-1] = $('#prodID'+i).val()
                stockCost = $('#stockCost'+i).val()
                cost = stockCost * parseInt($("#products").val())
                $("#viewStock" + i).html(myString + cost + "EGP")
            }
            stockRecieptCount = parseInt($("#stockRecieptCount").val())
            for(i = 1; i < stockRecieptCount;i++){
                $("#stock" + i).css("display","none")
            }
            recieptCount = parseInt($("#recieptCount").val())
            for(i = 1;i < recieptCount;i++){
                $("#reciept" + i).css("display","none")
            }
            $("#saveButton").click(() => {
                fd = new FormData();
                for(i = 1;i<= numProducts;i++){
                    console.log($("#productStock"+$("#prodID"+i).val()).val())
                    if($("#productStock"+$("#prodID"+i).val()).val() != parseInt($("#curStock" + $("#prodID"+i).val()).val())){
                        fd.append("productID[]",$("#prodID"+i).val())
                        fd.append("quantities[]",($("#productStock"+$("#prodID"+i).val()).val()) - parseInt($("#curStock" + $("#prodID"+i).val()).val()))
                    }
                }
                $.ajax({
                    type: "POST",
                    url:"stocks",
                    data:fd,
                    contentType: false,
                    processData: false,
                    success: (result)=>{
                        window.location.reload();
                    }
                })
            })
            function before(before,current){
                // alert(before)
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
                // alert($("#productsSimulation").val())
                if($("#productsSimulation").val() > 0){
                    $("#productsSimulation").val($("#productsSimulation").val() - 1);
                    cost = $('#stockCost'+currentProd).val() * parseInt($("#productsSimulation").val())
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
                $("#productsSimulation").val(parseInt($("#productsSimulation").val()) + 1);
                cost = $('#stockCost'+currentProd).val() * parseInt($("#productsSimulation").val())
                $("#viewStock" + currentProd).html(myString + cost + "EGP")
            })
            function increaseStock(ID) {
                $("#productStock" + ID).val(parseInt($('#productStock' + ID).val()) + parseInt('1'))
                currentCost = (parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())) * parseInt($("#stockCost" + ID).val())
                // alert($("#stockCost" + ID).val())
                // alert((parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())))
                $("#scost" + ID).html(`Cost: <strong> ${currentCost} EGP</strong>`)
                $(".saveContainer").css('display','flex')
            }
            function decreaseStock(ID) {
                if(($("#productStock" + ID).val() - 1) >= $("#currentStock").val())
                    $("#productStock" + ID).val($("#productStock" + ID).val() - 1)
                    // currentCost = (parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())) * parseInt($("#stockCost" + ID).val())
                    if(((parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())) * parseInt($("#stockCost" + ID).val())) != 0)
                        $("#scost" + ID).html(`Cost: <strong> ${(parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())) * parseInt($("#stockCost" + ID).val())} EGP</strong>`)
                    else{
                        $("#scost" + ID).html("");
                        $(".saveContainer").css('display','none')
                    }
            }
            function stockChange(value,ID) {
                // currentCost = parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())
                    // console.log(currentCost)
                    if(value >= parseInt($("#curStock" + ID).val())){
                        currentCost = (parseInt($("#productStock" + ID).val()) - parseInt($("#curStock" + ID).val())) * parseInt($("#stockCost" + ID).val())
                        $("#scost" + ID).html(`Cost: <strong> ${currentCost} EGP</strong>`)
                        
                        $(".saveContainer").css('display','flex')
                    }
                    else{
                        $("#scost" + ID).html("<div class = error>Please Enter a number greater than the stock value available</div>")
                        $(".saveContainer").css('display','none')
                    }
            }
            function recieptPrev(product){
                if(product != 0){
                    // product--;
                    $("#stock" + product--).css("display","none")
                    $("#stock" + product).css("display","block")
                }
            }
            function recieptNext(product){
                if(product+1 < stockRecieptCount){
                    $("#stock" + product++).css("display","none")
                    $("#stock" + product).css("display","block")
                }
            }
            function recieptp(currReciept){
                if(currReciept != 0){
                    $("#reciept" + currReciept--).css("display","none")
                    $("#reciept" + currReciept).css("display","block")
                }
            }
            function recieptn(currReciept){
                // alert(currReciept)
                if(currReciept+1 < recieptCount){
                    $("#reciept" + currReciept++).css("display","none")
                    $("#reciept" + currReciept).css("display","block")
                }
            }
            // $("#datesearch").change(() => {
            //     searchDate($("#datesearch").val())
            // })
            function searchDate(value) {
                // alert('hena')
                for(i = 0; i < recieptCount; i++){
                    if(i == value){
                        $("#reciept" + i).css("display","block")
                        $("option[value="+i+"]").prop("selected","selected")
                        continue
                    }
                    $("#reciept" + i).css("display","none")
                }
            }
            function viewReciept(ID){
                $(".recieptContainer").css("display","block")
                $.ajax({
                    type: "POST",
                    url: "stocks",
                    data:{recieptID: ID},
                    success: (result)=>{
                        // alert(result)
                        $(".recieptContainer").html("<span id=closeReciept onclick='closeReciept()'><i class='fa fa-xmark'></i></span><br>" + result)
                    }
                })
            }
            function closeReciept(){
                $(".recieptContainer").css("display","none")
            }
            $("#closeButton").click(function(){
                location.reload()
            })
        </script>
        <?php

    }
}