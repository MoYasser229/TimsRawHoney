<?php
class customer extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;

        //CUSTOMER DATA
        $topCustomer = $this->model->getTopCustomer();
        $totalCustomers = $this->model->getTotalCustomers();
        $activeCustomers = $this->model->getActiveCustomers();
        $first = $this->model->getCustomers();
        $customerRatio = $this->model->getCustomerRatio();
        $promoCodes = $this->model->getPromoCodes();
        $promoCodesRatio = $this->model->getPromoCodesRatio();
        $promocodes = $this->model->getPromo();
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <div class="mainContainer">
                <h1>Customers</h1>
                <hr>
                <div class="gridCards">
                    <div class="cardChild"><h2>TOP CUSTOMER</h2><h3><?php echo $topCustomer; ?></h3></div>
                    <div class="cardChild"><h2>NUMBER OF CUSTOMERS</h2><h3><?php echo $totalCustomers; ?></h3></div>
                    <div class="cardChild"><h2>ACTIVE CUSTOMERS</h2><h3><?php echo $activeCustomers; ?></h3></div>
                    <div class="cardChild"><h2><?php echo $customerRatio; ?>%</h2><h3>CUSTOMER BUY RATIO</h3></div>
                    <div class="cardChild"><h2>ACTIVE PROMO CODES</h2><h3><?php echo ($promoCodes == 0)?"NO ACTIVE PROMO CODES":$promoCodes; ?></h3></div>  
                    <div class="cardChild"><h2><?php echo ($promoCodes == 0)?"NO ACTIVE PROMO CODES":$promoCodesRatio . "%"; ?></h2><h3>PROMO CODES USE RATIO</h3></div>  
                </div>
        </div>
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1>
                <hr>
                <div class="centerized">
                    <input type="text" id = "search" placeholder="Search Here">
                    <!-- <input type="hidden" id = "model" value = "<?php //echo serialize($this->model);?>"> -->
                    <input type="hidden" id = "model" value = "customer">
                    <button id = "searchButton"><i class="fas fa-search"></i></button>
                    <!-- <br><br> -->
                    <select name="type" id = 'type'>
                        <option id="typeChosen" value = "fullName" selected>NAME</option>
                        <option id="typeChosen" value = "sales">NUMBER OF ORDERS</option>
                    </select>
                    <select name="filter" id = 'filter'>
                        <option value = "DESC" selected>DESCENDING</option>
                        <option value = "ASC">ASCENDING</option>
                    </select>
                </div>
                
                
            </div>
            <div class="gridCustomer">
                
                <?php
                $this->model->viewCustomers();
                ?>
                </div>
                <br>
                <div class="PromoMain">
                    <h1>Promo Codes</h1>
                    <hr>
                    <p>Right Here, you can view all promo codes created and generate new ones! You can also send those promo codes to any customer.</p>
                    
                </div>
                <br>
                <div class="PromoGen">
                <h1>Generate a New Promo Code</h1>
                        <input type="text" class=promoInput placeholder= "Click Generate" name = "promoCode" value="" id = "promoCode" disabled>
                        <span onclick="generatePromo()">GENERATE</span><br><br>
                        <input type = "text" class=promoInput placeholder="discount value" name = "discount" id = "discount">
                        <br><br>
                        <div class="daysInput">
                            <input type="text" placeholder="Promo code Length" name=promoLength id=promoLength >
                            <div class=defspan>DAYS</div>
                        </div>
                        <label><i class="fa-solid fa-circle-info"></i> If empty, the promo code length will be 30 days by default</label>
                        
                        <div id="warning"></div>
                        <button onclick="generate()">SUBMIT</button>
                </div>
                <br>
                <div class="searchContainer">
                <h1>PROMOCODES SORT</h1>
                <hr>
                <div class="centerized">
                    <select name="type" id = 'promotype'>
                        <option id="typeChosen" value = "promoValue" selected>DISCOUNT VALUE</option>
                        <option id="typeChosen" value = "promoLength">EXPIRY</option>
                    </select>
                    <select name="filter" id = 'promofilter'>
                        <option value = "DESC" selected>DESCENDING</option>
                        <option value = "ASC">ASCENDING</option>
                    </select>
                </div>
                
                
            </div>
            <br>
                <div class="gridPromo" id = "promoData">
                    <?php 
                    
                    $this->model->viewPromo();
                    ?>
                </div>
                <script>
                    $( document ).ready(function() {
                       myAjax()
                    });
                    $("#searchButton").click(function(){
                        myAjax()
                    });
                    $("#type").change(() => {
                        myAjax()
                    })
                    $("#filter").change(() => {
                        myAjax()
                    })
                    $("#promotype").change(() => {
                        type = $("#promotype").val()
                        filter = $("#promofilter").val()
                        $.ajax({
                            type: 'POST',
                            url: 'customer',
                            data:{type:type,filter:filter},
                            success: (result)=>{
                                $("#promoData").html(result)
                            }
                        })
                    })
                    $("#promofilter").change(() => {
                        type = $("#promotype").val()
                        filter = $("#promofilter").val()
                        $.ajax({
                            type: 'POST',
                            url: 'customer',
                            data:{type:type,filter:filter},
                            success: (result)=>{
                                $("#promoData").html(result)
                            }
                        })
                    })
                    function generate() {
                        
                        var promoCode = $("#promoCode").val()
                        var discount = $("#discount").val()
                        var length = ($("#promoLength").val())?$("#promoLength").val():30
                        $.ajax({
                            type: "POST",
                            url: "customer",
                            data: {promoCode: promoCode,discount:discount,length:length},
                            success: (result) =>{
                                // alert(result)
                                error = false
                                if(result == "falseDiscount"){
                                    $("#discount").css("border","2px solid red")
                                    $("#warning").html("*Please GENERATE A promo code and enter a discount value")
                                    error = true
                                }
                                if(result == "falsePromo"){
                                    $("#promoCode").css("border","2px solid red")
                                    $("#warning").html("*Please GENERATE A promo code and enter a discount value")
                                    error = true
                                }
                                if(result == "falsePromofalseDiscount" || result == "falseDiscountfalsePromo"){
                                    $("#discount").css("border","2px solid red")
                                    $("#promoCode").css("border","2px solid red")
                                    $("#warning").html("*Please GENERATE A promo code and enter a discount value")
                                    error = true
                                }

                                if(!error){
                                    $("#promoCode").css("border","2px solid #fab637")
                                    $("#discount").css("border","2px solid #fab637")
                                    $("#warning").html("")
                                    // alert(result)
                                    $("#promoData").html(result)
                                    $("#promoCode").val('')
                                    $("#discount").val('')
                                    $("#promoLength").val('')
                                }

                            }
                        })
                    }
                    function myAjax(){
                        search = $("#search").val()
                        type = $("#type").val()
                        filter = $("#filter").val()
                        model = "customer"

                        
                        var url = "ajax"
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {searchData: search,modelData: model,typeData:type,filterData:filter},
                            success: (result) => {
                                $(".gridCustomer").html(result);
                            }
                        })
                    }
                    function generatePromo(){
                        var generated = []
                        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
                        var result = "";
                        for(i = 0; i < 10;i++)
                            result += possible.charAt(Math.floor(Math.random() * possible.length))
                        $("#promoCode").val(result)
                    }
                    function ondelete(value){
                        deleteid = value;
                        $.ajax({
                            type: 'POST',
                            url: 'customer',
                            data:{deleteid:deleteid},
                            success: (result)=>{
                                $("#promoData").html(result)
                            }
                        })
                    }
                    function onextend(value,length){
                        extendid = value;
                        $.ajax({
                            type: 'POST',
                            url: 'customer',
                            data:{extendid:extendid,length:length},
                            success: (result)=>{
                                $("#promoData").html(result)
                            }
                        })
                    }
                </script>
        <?php
    }
}