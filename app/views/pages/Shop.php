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
        </head>
        <body>

        <div class= "Searchbar">
          <form onsubmit="event.preventDefault();" role="search">
            <label for="search">Search for stuff</label>
            <!-- <input id="search" type="search" placeholder="Search..." autofocus required /> -->
            <input type="text" id = "shopSearch" placeholder="Search...">
            <button type="submit">Go</button>    
          </form>
        </div>

        
            
        <!-- <div class="container">
          <h2>best selling</h2>      
        </div> -->
        <div class="row">
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
      </body>
      </html>
      <script>
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
                
                function submitSearch() {
                    search = $('#shopSearch').val()
                    $.ajax({
                        type: 'POST',
                        url: 'Shop',
                        data: {search:shopSearch},
                        success: (result)=>{
                            $("#productSearchShop").html(result)
                        }
                    })
                }
      </script>
      <?php
    }
}
?>  