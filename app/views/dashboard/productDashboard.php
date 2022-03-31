<?php 
class productDashboard extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class="mainContainer">
                <h1>PRODUCT</h1>
                <hr>
                <div class="grid-buttons">
                    <button class="productButtons " href="/"><i class="fa-solid fa-plus btnIcon icon"></i> <br> <span>ADD PRODUCT</span> </button> 
                    <button class="productButtons" href="/"><i class="fa-solid fa-trash icon"></i> <br>  <span>DELETE PRODUCT</span> </button>
                    <button class="productButtons" href="/"><i class="fa-solid fa-pen icon"></i> <br>  <span>Edit PRODUCT</span> </button>
                </div>
            </div>
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1> 
                <hr>
            </div>
            <div class="productGrid">
                <div class="productCard">
                    <h2>Immune Honey</h2>
                    <hr>
                    <div class="smallGrid">
                        <div class="smallGridChild">
                            <img src="<?php echo IMAGEROOT . 'jarr3.png' ; ?>" width="150px" height="150px" >
                        </div>
                        <div class="smallGridChild">
                            <h5>Product Retail Price <br> 50 EGP</h5>
                            <h5>Product Manifacture Cost <br> 25 EGP</h5>
                            <h5>Available stock <br> 50</h5>
                            
                        </div>
                    </div>
                    <button class ="productButtons">Edit Product</button>
                </div>
                <div class="productCard">
                    <h2>Immune Honey</h2>
                    <hr>
                    <div class="smallGrid">
                        <div class="smallGridChild">
                            <img src="<?php echo IMAGEROOT . 'jarr3.png' ; ?>" width="150px" height="150px" >
                        </div>
                        <div class="smallGridChild">
                            <h5>Product Retail Price <br> 50 EGP</h5>
                            <h5>Product Manifacture Cost <br> 25 EGP</h5>
                            <h5>Available stock <br> 50</h5>
                            
                        </div>
                    </div>
                    <button class ="productButtons">Edit Product</button>
                </div>
                <div class="productCard">
                    <h2>Immune Honey</h2>
                    <hr>
                    <div class="smallGrid">
                        <div class="smallGridChild">
                            <img src="<?php echo IMAGEROOT . 'jarr3.png' ; ?>" width="150px" height="150px" >
                        </div>
                        <div class="smallGridChild">
                            <h5>Product Retail Price <br> 50 EGP</h5>
                            <h5>Product Manifacture Cost <br> 25 EGP</h5>
                            <h5>Available stock <br> 50</h5>
                            
                        </div>
                    </div>
                    <button class ="productButtons">Edit Product</button>
                </div>
                <div class="productCard">
                    <h2>Immune Honey</h2>
                    <hr>
                    <div class="smallGrid">
                        <div class="smallGridChild">
                            <img src="<?php echo IMAGEROOT . 'jarr3.png' ; ?>" width="150px" height="150px" >
                        </div>
                        <div class="smallGridChild">
                            <h5>Product Retail Price <br> 50 EGP</h5>
                            <h5>Product Manifacture Cost <br> 25 EGP</h5>
                            <h5>Available stock <br> 50</h5>
                            
                        </div>
                    </div>
                    <button class ="productButtons">Edit Product</button>
                </div>
                <div class="productCard">
                    <h2>Immune Honey</h2>
                    <hr>
                    <div class="smallGrid">
                        <div class="smallGridChild">
                            <img src="<?php echo IMAGEROOT . 'jarr3.png' ; ?>" width="150px" height="150px" >
                        </div>
                        <div class="smallGridChild">
                            <h5>Product Retail Price <br> 50 EGP</h5>
                            <h5>Product Manifacture Cost <br> 25 EGP</h5>
                            <h5>Available stock <br> 50</h5>
                            
                        </div>
                    </div>
                    <button class ="productButtons">Edit Product</button>
                </div>
                <div class="productCard">
                    <h2>Immune Honey</h2>
                    <hr>
                    <div class="smallGrid">
                        <div class="smallGridChild">
                            <img src="<?php echo IMAGEROOT . 'jarr3.png' ; ?>" width="150px" height="150px" >
                        </div>
                        <div class="smallGridChild">
                            <h5>Product Retail Price <br> 50 EGP</h5>
                            <h5>Product Manifacture Cost <br> 25 EGP</h5>
                            <h5>Available stock <br> 50</h5>
                            
                        </div>
                    </div>
                    <button class ="productButtons">Edit Product</button>
                </div>
            </div>
        <?php
    }
}