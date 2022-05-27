<?php

class sales extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
        <div class="mainContainer">
            <h1>Sales</h1>
            <hr>
            <div class="gridContainer">
                <div class="gridChild">
                    <h1>Regions with Active Customers</h1>
                    <h2><?php echo $this->model->activeRegions(); ?> REGIONS</h2>
                </div>
                <div class="gridChild">
                    <h1>Best region</h1>
                    <h2><?php echo strtoupper($this->model->topRegion()); ?></h2>
                </div>
            </div>
        </div>
        <div class="searchContainer">
            <h1>Search and Sort</h1>
            <hr>
            <input type="text" name=search id=search placeholder="Search Here">
                <button onclick="searchButton()" id=searchButton><i class="fa-solid fa-magnifying-glass"></i></button>
                <select id=type>
                    <option value = "region">Region</option>
                    <option value = "regiontotPrice">Revenue</option>
                    <option value = "totproduct">Products Sold</option>
                </select>
                <select id="filter">
                    <option value="DESC">Descending</option>
                    <option value=ASC>Ascending</option>
                </select>
        </div>
        <div class="regionGrid">
            <?php $this->model->viewRegions(); ?>
        </div>
        <script>
            function searchButton(){
                search = $("#search").val();
                $.ajax({
                    type: "POST",
                    url: "sales",
                    data:{search:search},
                    success: (result) => {
                        $(".regionGrid").html(result);
                    }
                })
            }
            $("#filter, #type").change(() => {
                filter = $("#filter").val();
                type = $("#type").val();
                $.ajax({
                    type: "POST",
                    url: "sales",
                    data:{filter: filter,type:type},
                    success: (result) => {
                        $(".regionGrid").html(result);
                    }
                })
            })
        </script>
        <?php
    }
}