<?php 
class productDashboard extends View{
    public function checkStock(){
        $this->model->checkStock();
        $warning = $this->model->getStockWarning();
        if($warning === "none"){
            echo "<div class = 'noError'><h1>STOCK</h1><i class='fa-solid fa-clipboard-check'></i><br><h4>NOTHING TO WORRY ABOUT</h4><p>All stocks are healthy with nothing missing.</p></div>";
        }
        else if($warning === "error"){
            echo "<div class = 'error'>
                <h1>STOCK</h1>
                <i class='fa-solid fa-triangle-exclamation'></i>
                <br>
                <h4>WARNING</h4>
                <p>One or more products need an increase in their stocks as there are no longer avaialable stock for them.</p>
                <a class = 'navigate' href='stocks'>UPDATE STOCK</a>
            </div>";
        }
        else if($warning === "half")
            echo "<div class = 'warning'>
                <h1>STOCK</h1>
                <i class='fa-solid fa-circle-exclamation'></i>
                <br>
                <h4>SMALL WARNING</h4>
                <p>Some stocks need to be restored.</p>
                <a class = 'navigate' href='stocks'>UPDATE STOCK</a>
            </div>";
    }
    public function checkProfit(){
        $check = $this->model->checkProfit();
        if($check){
            echo "<div class = 'error'>
                <h1>LOSS</h1>
                <i class='fa-solid fa-triangle-exclamation'></i>
                <br>
                <h4>LOSS DETECTED</h4>
                <p>One or more products have been detected as a losing product. You might consider updating the retail price</p>
            </div>";
        }
        else{
            echo "<div class = 'noError'>
                <h1>PROFIT</h1>
                <i class='fa-solid fa-clipboard-check'></i>
                <br>
                <h4>NO LOSS DETECTED</h4>
                <p>Products have no loss depending on their retail and manifacture cost.</p>
            </div>";
        }
    }
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        $headercss = $this->model->headercss;
        require_once APPROOT . "/views/inc/managerHeader.php";
        ?>
            <div class="mainClass">
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
                    <input name=productImage type="file" id="file" class="file" accept="image/*">
                    <label for="file" id=productImageAdd>
                    <i class="fa-solid fa-upload"></i>&nbsp; Upload Image
                        
                    </label>
                    <p id="file-name"></p>
                    </div>
                    <textarea id=description name=productDescription placeholder="Enter a brief description about your product" rows="4" cols="40"></textarea>
                    <br>
                    <br>
                    <button onclick="submitForm()" class=subButton id=addProdoct value=add >ADD PRODUCT</button>
                    <div id=error></div>
                </div>
                <div class="informationCard">
                    <h1>OVERVIEW</h1>
                    <hr>
                    <div class="overviewgrid">
                    <div class="overviewChild best">
                        <h1>BEST SELLER</h1>
                        <?php
                            $best = $this->model->getBestSeller();
                            if(isset($best['productName'])){
                                ?>
                                    <i class="fa-solid fa-ranking-star"></i>
                        
                                    <h4><?php echo  $best['productName']; ?></h4>
                                    <p>With <strong><?php echo $best['quantity'];?></strong> taken from stock, <strong><?php echo $best['productName']; ?></strong> is the best seller among the products.</p>
                                <?php
                            }
                            else{
                                echo "<h4>No Products Available</h4>";
                            }
                        ?>
                        

                        </div>
                        <div class="overviewChild zero">
                        <h1>LEAST SELLER</h1>
                        <?php
                            $zero = $this->model->getZeroSeller();
                            if(isset($zero['productName'])){
                                ?>
                                    <i class="fa-solid fa-heart-crack"></i>
                        
                                    <h4><?php echo  $zero['productName']; ?></h4>
                                    <p>Unfortunately, the product <strong><?php echo $zero['productName']; ?></strong> is the least selling product. Moreover, its Manifacture Cost is the highest among the least selling with a value of <strong><?php echo $zero['manifactureCost']; ?> EGP</strong></p>
                                <?php
                            }
                            else{
                                echo "<h4>No Products Available</h4>";
                            }
                        ?>
                        </div>
                        <div class="overviewChild">
                            <?php $this->checkStock(); ?>
                        </div>
                        <div class="overviewChild">
                            <?php $this->checkProfit(); ?>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="searchContainer">
                <h1>SEARCH AND SORT</h1> 
                <hr>
                <!-- <div class="formSort"> -->
                <div class="centerized">
                    <input type="text" id = "search" placeholder="Search Here">
                    <button id = searchButton onclick = "submitSearch()"><i class="fas fa-search"></i></button>
                    <!-- <br><br> -->
                    <select name="type" id = 'type'>
                        <option id="typeChosen" value = "productName" selected>PRODUCT NAME</option>
                        <option id="typeChosen" value = "retailCost">RETAIL COST</option>
                        <option id="typeChosen" value = "manifactureCost">MANIFACTURE COST</option>
                        <option id="typeChosen" value = "productStock">STOCK</option>
                    </select>
                    <select name="filter" id = 'filter'>
                        <option value = "DESC" selected>DESCENDING</option>
                        <option value = "ASC">ASCENDING</option>
                    </select>
                </div>
                <!-- </div> -->
            </div>
            <div id="editCard">
                <div id="editForm"></div>
                <div id="editInfo" >
                    <h1><i class="fa-solid fa-exclamation"></i> &nbsp;DISCLAIMER</h1>
                    <p>For the retail price and manifacture cost, please enter a numerical value to avoid any issues.</p>
                    <p>Please check that all fields are not empty.</p>
                    <p>Want to edit the stocks? <a class=navStock href='stocks'>Click here</a></p>
                </div>
            </div>
            
                <div id="productTable">
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
                $('#file-name').html(fileNameAndSize)
                // document.querySelector('.file-name').textContent = fileNameAndSize;
                });
                const file2 = document.querySelector('#file2');
                file.addEventListener('change', (e) => {
                // Get the selected file
                const [file2] = e.target.files;
                // Get the file name and size
                const { name: fileName, size } = file;
                // Convert size in bytes to kilo bytes
                const fileSize2 = (size / 1000).toFixed(2);
                // Set the text content
                const fileNameAndSize2 = `${fileName} - ${fileSize2}KB`;
                $('#file-name2').html(fileNameAndSize2)
                // document.querySelector('.file-name').textContent = fileNameAndSize;
                });
                $("#type").change(() => {
                    type = $("#type").val();
                    filter = $("#filter").val();
                    $.ajax({
                        type: 'POST',
                        url: 'productDashboard',
                        data: {type:type,filter:filter},
                        success: (result)=>{
                            $("#productTable").html(result)
                        }
                    })
                });
                
                $("#filter").change(() => {
                    type = $("#type").val();
                    filter = $("#filter").val();
                    $.ajax({
                        type: 'POST',
                        url: 'productDashboard',
                        data: {type:type,filter:filter},
                        success: (result)=>{
                            $("#productTable").html(result)
                        }
                    })
                });
                
                function submitSearch() {
                    search = $('#search').val()
                    $.ajax({
                        type: 'POST',
                        url: 'productDashboard',
                        data: {search:search},
                        success: (result)=>{
                            $("#productTable").html(result)
                        }
                    })
                }
                function submitEdit() {
                    pname = $("#productName").val()
                    rcost = $("#retailCost").val()
                    mcost = $("#manifactureCost").val()
                    productImage = $("#file2")[0].files[0]
                    submit = $("#submitEdit").val()
                    description = $("#editDescription").val()
                    error = false;
                    if(pname == "" || rcost == "" || mcost == "")
                        error = true
                    if(!productImage){
                        // alert(productImage)
                        productImage = $("#imageName").val()
                    }
                    
                    // else{
                    //     type = productImage['type']
                    //     size = productImage['size']
                    //     if(!type.includes("image/")){
                    //         error = true
                    //     }
                    //     if(size <= 0){
                    //         error = true
                    //     }
                    // }
                    if(!error){
                        form = new FormData()
                        form.append("productImage",productImage)
                        form.append("retailCost",rcost)
                        form.append("manifactureCost",mcost)
                        form.append("description",description)
                        form.append("productName",pname)
                        form.append("submitEdit",submit)
                        $.ajax({
                            type: 'POST',
                            url: 'productDashboard',
                            data: form,
                            contentType: false,
                            processData: false,
                            success: (result)=>{
                                $("#productTable").html(result)
                                // console.log(result)
                            }
                        })
                    }
                    else{
                        $("#errorMessage").html("Please check the inputs. Something is empty.")
                    }
                }
                function deleteProduct(value) {
                    // alert(value)
                    $("#deleteButton" + value).html("ARE YOU SURE?")
                    $("#deleteButton" + value).click(() => {
                        $.ajax({
                        type: 'POST',
                        url: 'productDashboard',
                        data: {delete:value},
                        success: (result)=>{
                            $("#productTable").html(result)
                        }
                    })
                    })
                    
                }
                function editProduct(value) {
                    $("#editCard").css('display','grid');
                    $.ajax({
                        type: 'POST',
                        url: 'productDashboard',
                        data:{edit: value},
                        success: (result)=>{
                            $("#editForm").html(result)
                        }
                    })

                }
                function dismiss(){
                    $("#editCard").css('display','none');
                }
                function submitForm(){
                    fd = new FormData()
                    productName = $("#name").val()
                    retailCost = $("#retail").val()
                    manifactureCost = $("#manifacture").val()
                    productStock = $("#stock").val()
                    productImage = $("#file")[0].files[0]
                    description = $("#description").val()
                    submit = $("#addProdoct").val()
                    error = false

                    if(productName == "" || retailCost == "" || manifactureCost == "" || productStock == "" || description == "")
                        error = true
                    if(!productImage){
                        error = true
                        $("#productImage").css("border","none")
                    }
                    else{
                        type = productImage['type']
                        if(!type.includes("image/")){
                            error = true
                        }
                        // if(size <= 0){
                        //     error = true
                        // }
                    }
                    if(!error){
                        fd.append("productImage",productImage)
                        fd.append("retailCost",retailCost)
                        fd.append("manifactureCost",manifactureCost)
                        fd.append("productStock",productStock)
                        fd.append("description",description)
                        fd.append("productName",productName)
                        fd.append("addProduct",submit)
                        $.ajax({
                            type: 'POST',
                            url: 'productDashboard',
                            data:fd,
                            contentType: false,
                            processData: false,
                            success: (result)=>{
                                if(result === 'false'){
                                    $("#productTable").html(result)
                                    $("#name").val("")
                                    $("#retail").val("")
                                    $("#manifacture").val("")
                                    $("#stock").val("")
                                    $("#description").val("")
                                    $("#file").val("")
                                    $("#file-name").html("")
                                }
                                else{
                                    $(".subButton").css("background-color", "red")
                                    $("#error").html("*ERROR Retail cost, manifacture Cost, and stock must number values")
                                }

                            }
                        })
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
