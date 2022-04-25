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
        

        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <div class="mainContainer">
                <h1>Customers</h1>
                <hr>
                <div class="gridCards">
                    <div class="cardChild"><h2>TOP CUSTOMER</h2><h3><?php echo $topCustomer; ?></h3></div>
                    <div class="cardChild"><h2>NUMBER OF CUSTOMERS</h2><h3><?php echo $totalCustomers; ?></h3></div>
                    <div class="cardChild"><h2>ACTIVE CUSTOMERS</h2><h3><?php echo $activeCustomers; ?></h4></div>
                </div>
            </div>
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1>
                <hr>
                <input type="text" id = "search" placeholder="Search Here">
                <!-- <input type="hidden" id = "model" value = "<?php //echo serialize($this->model);?>"> -->
                <input type="hidden" id = "model" value = "customer">
                <button id = "searchButton">Search</button>
                <div id="div1"></div>
            </div>
            <div class="gridCustomer">
                
                <?php
                $this->model->viewCustomers();
                ?>
                </div>
                <script>
                    $("#search").change(function(){
                        search = $("#search").val()
                        model = $("#model").val()
                        searchData = "search"
                        modelData = "model"
                        var url ="<?php echo 'ajax/search.php'; ?>";
                        $.ajax({
                            type: "POST",
                            url: url,
                            data: {modelData: $("#model").val(), searchData: search},
                            success: function(result){
                            $(".gridCustomer").html(result);
                            // alert(model)
                        }});
                    });
                </script>
        <?php
    }
}