<?php

class Survey extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class="mainContainer">
                <h1>Survey</h1>
                <hr>
                <div class="gridTable">
                    <div class="cardTable">
                        <h1><?php echo $this->model->surveys(); ?></h1>
                        <h2>Number of Surveys Done</h2>
                    </div>
                    <div class="cardTable">
                        <h1><?php echo ceil($this->model->avgSurvey()['satisfaction']); ?>%</h1>
                        <h2>Customer Satistisfaction Rate</h2>
                    </div>
                </div>
            </div>
            <div class="searchContainer">
            <h1>Search and Sort</h1>
            <hr>
            <div class="centerized">
                    <input type="text" id = "search" placeholder="Search Here">
                    <button id = searchButton onclick = "submitSearch()"><i class="fas fa-search"></i></button>
                    <!-- <br><br> -->
                    <select name="type" id = 'type'>
                    <option id="typeChosen" value = "customerID">ID</option>
                        <option id="typeChosen" value = "fullName" selected>NAME</option>
                        <option id="typeChosen" value = "satisfaction">SATISFACTION</option>
                    </select>
                    <select name="filter" id = 'filter'>
                        <option value = "DESC" selected>DESCENDING</option>
                        <option value = "ASC">ASCENDING</option>
                    </select>
                </div>
        </div>
        <div id="surveyGrid">
            <?php
                $this->model->databaseSurvey();
                $this->model->display();
            ?>
        </div>
        <script>
            function submitSearch() {
                    search = $('#search').val()
                    $.ajax({
                        type: 'POST',
                        url: 'survey',
                        data: {search:search},
                        success: (result)=>{
                            $("#surveyGrid").html(result)
                        }
                    })
                }
                $("#type").change(() => {
                    type = $("#type").val()
                    filter = $("#filter").val()
                    $.ajax({
                        type: 'POST',
                        url: 'survey',
                        data: {type:type,filter:filter},
                        success: (result) => {
                            $("#surveyGrid").html(result)
                        } 
                    })
                })
                $("#filter").change(() => {
                    type = $("#type").val()
                    filter = $("#filter").val()
                    $.ajax({
                        type: 'POST',
                        url: 'survey',
                        data: {type:type,filter:filter},
                        success: (result) => {
                            $("#surveyGrid").html(result)
                        } 
                    })
                })
            </script>
        <?php
    }
}