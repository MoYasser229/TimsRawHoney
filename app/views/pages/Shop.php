<?php

class shop extends View{
    public function output(){
        $title = $this->model->title;
        $shop=$this->model->shop();

        require_once APPROOT . "/views/inc/header.php";
        ?>
        <html lang>
        <head>
        <title>Shop</title>
        <link rel="stylesheet" href="<?php echo URLROOT. "css/shopStyle.css" ?>">
        <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js "></script>
        </head>
        <body>

        <!-- <div class= "Searchbar">
            <label for="search">Search for stuff</label>
            <input id="shopSearch" type="search" placeholder="Search..." autofocus required /> -->
            <!-- <input type="text" id="shopSearch" placeholder="Search..."> -->
        <!-- </div>
        <div class="button">
          <button onclick = "submitSearch()" type="submit">Go</button>
        </div> -->

        <!-- <button id = searchButton onclick = "submitSearch()"> Go </button> -->

        <br><br><br><br><br><br><br><br><br>
        <div class="searchContainer">
                <h1>SEARCH AND SORT</h1> 
                <hr>
                <!-- <div class="formSort"> -->
                <div class="centerized">
                    <input type="text" id = "shopSearch" placeholder="Search Here">
                    <button id = searchButton onclick = "Search()"><i class="fas fa-search"></i></button>
                    <!-- <br><br> -->
                    <select name="type" id = 'type'>
                        <option id="typeChosen" value = "productName" selected>PRODUCT NAME</option>
                        <option id="typeChosen" value = "retailCost">RETAIL COST</option>
                        <option id="typeChosen" value = "manifactureCost">MANIFACTURE COST</option>
                        <option id="typeChosen" value = "stock">STOCK</option>
                    </select>
                    <select name="filter" id = 'filter'>
                        <option value = "DESC" selected>DESCENDING</option>
                        <option value = "ASC">ASCENDING</option>
                    </select>
                </div>
                <!-- </div> -->
            </div> 
        
        <div class="row" id="productsContainer">
          <?php
          foreach($shop as $row)
          {
         ?>
         
          <div class="col-md-3 col-sm-6">
            <div class="product-grid">
              <div class="product-image">
              <a class = "image" type="hidden" name="hidden_name" href="<?php echo URLROOT.'pages/product' ?>?id=<?php echo $row['ID']; ?>"><img src="<?php echo IMAGEROOT."product/".$row["productImage"]; ?>" class="model" width="300px" height = "300px"/></a><br/>
                <?php if(isset($_SESSION['ID'])){
                ?>
                <a href="<?php echo URLROOT.'pages/Cart'?>?id=<?php echo $row['ID'];?>" class="add-to-cart"></a>
                <?php
                }
                else{
                ?>
               <a href="<?php echo URLROOT.'pages/signup'?>"</a>
                <?php
                }
                ?>
              </div>
              <div class="product-content">
                <!-- <h3 class="title"><a href="#">Sage Honey</a></h3> -->
                <h4 class="title"><?php echo $row["productName"]; ?></h4>
                <!-- <div class="price">$53.55 <span>$68.88</span></div> -->
                <div class="price"> <?php echo $row["retailCost"]; ?>  EGP </div>
              </div>
            </div>
          </div>

          <?php
          }
          ?>
          </div>
          <script>
          function Search(){
            shopSearch = $('#shopSearch').val();
                    $.ajax({
                        type: 'POST',
                        url: 'Shop',
                        data: {shopSearch:shopSearch},
                        success: (result)=>{
                            // console.log(result);
                            $("#productsContainer").html("") 
                            $("#productsContainer").html(result)
                        }
                    })
        }
        $("#type").change(() => {
                    type = $("#type").val();
                    filter = $("#filter").val();
                    $.ajax({
                        type: 'POST',
                        url: 'Shop',
                        data: {type:type,filter:filter},
                        success: (result)=>{
                            $("#productSearchShop").html(result)
                        }
                    })
                });
        $("#filter").change(() => {
                    type = $("#type").val();
                    filter = $("#filter").val();
                    $.ajax({
                        type: 'POST',
                        url: 'Shop',
                        data: {type:type,filter:filter},
                        success: (result)=>{
                            $("#productSearchShop").html(result)
                        }
                    })
                });
        </script>
      </body>
      </html>
      <?php
    }
}
?>  