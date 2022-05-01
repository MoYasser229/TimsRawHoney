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
                <p>Here you can view your products and add new products. You can also edit existing products and delete unwanted products.</p>
                <div class="grid-buttons">
                    <!-- <button onclick="addProduct()" class="productButtons " href="/"><i class="fa-solid fa-plus btnIcon icon"></i> <br> <span>ADD PRODUCT</span> </button>  -->
                    <!-- <button class="productButtons" href="/"><i class="fa-solid fa-trash icon"></i> <br>  <span>DELETE PRODUCT</span> </button> -->
                </div>
                
            </div>
            <div class="gridContainer">
                <div id=addProduct>
                    <h1>ADD A PRODUCT</h1>
                    <hr>
                    <br>
                    <input id=name type="text" name=productName placeholder="Product Name">
                    <br>
                    <input id=retail type="text" name=retailCost placeholder="Product Retail Cost">
                    <br>
                    <input id=manifacture type="text" name=manifactureCost placeholder="Product Manifacture Cost">
                    <br>
                    <input id=stock type="text" name=productStock placeholder="Enter the capacity of the stock">
                    <br>
                    <div class="file-input">
                    <input name=productImage type="file" id="file" class="file">
                    <label for="file">
                    <i class="fa-solid fa-upload"></i>&nbsp; Upload Image
                        <p class="file-name"></p>
                    </label>
                    </div>
                    <br>
                    <br>
                    <textarea id=description name=productDescription placeholder="Enter a brief description about your product" rows="4" cols="40"></textarea>
                    <br>
                    <br>
                    <button onclick="submitForm()" class=subButton>ADD PRODUCT</button>
                    <div id=error></div>
                </div>
                <div class="informationCard">
                    
                </div>
            </div>
            
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1> 
                <hr>
                <div class="formSort">
                    <input type="text" name=search id=search placeholder="Search">
                    <!-- <select name="type" id="type">
                        <option value=""></option>
                    </select> -->
                </div>
            </div>
            <div class="productGrid">
                <?php 
                $this->model->databaseProducts();
                $this->model->getProducts(); 
                ?>
            </div>
            <script>
                const file = document.querySelector('#file');
                file.addEventListener('change', (e) => {
                // Get the selected file
                const [file] = e.target.files;
                // Get the file name and size
                const { name: fileName, size } = file;
                // Convert size in bytes to kilo bytes
                const fileSize = (size / 1000).toFixed(2);
                // Set the text content
                const fileNameAndSize = `${fileName} - ${fileSize}KB`;
                document.querySelector('.file-name').textContent = fileNameAndSize;
                });
                function submitForm(){
                    fd = new FormData()
                    productName = $("#productName").val()
                    retailCost = $("#retailCost").val()
                    manifactureCost = $("#manifactureCost").val()
                    productStock = $("#productStock").val()
                    
                    productImage = $("#productImage").prop("files")[0]
                    description = $("#description").val()
                    error = false
                    alert(productImage)

                    if(productName == "" || retailCost == "" || manifactureCost == "" || productStock == "" || description == "")
                        error = true
                    if(productImage.length <= 0){
                        error = true
                        $("#productImage").css("border","2px solid red")
                    }
                    if(!error){
                        fd.append("productImage",productImage[0])
                        fd.append("retailCost",retailCost)
                        fd.append("manifactureCost",manifactureCost)
                        fd.append("productStock",productStock)
                        fd.append("description",description)
                        fd.append("productName",productName)

                    }
                    else{
                        $(".subButton").css("background-color", "red")
                        $("#error").html("*ERROR please check that you entered all inputs")
                    }
                }
            </script>
        <?php
    }
}