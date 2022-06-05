b<?php

class profile extends View{
    public function output(){
        $title = $this->model->title;
        $css = $this->model->css;
        $icon = $this->model->icon;
        $profileModel = $this->model;
        $profileData = $profileModel->getUserData($_SESSION['ID']);
        $pendingOrders = $profileModel->getPendingOrders($_SESSION['ID']);
        $deliveredOrders = $profileModel->getDeliveredOrders($_SESSION['ID']);
        foreach($profileData as $profile){
            $profileData = $profile;
            break;
        }
        

        require_once APPROOT . "/views/inc/header.php";
        ?>
            <link rel="stylesheet" href="<?php echo $css ; ?>"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
            <div class="mainContainer">
                <div class="navChild">
                    <button id = "personal" class = "myButton margin-bottom selected"><i class="fas fa-user-alt"></i><br>Personal Information</button><br>
                    <button id = "security" class = "myButton margin-bottom"><i class="fas fa-lock"></i><br>Security</button><br>
                    <button id = "orders" class = "myButton margin-bottom"><i class="fas fa-receipt"></i><br>My Orders</button><br>
                    <button id = "address" class = "myButton margin-bottom"><i class="fas fa-address-card"></i><br>My Address Book</button><br>
                    <button id = "promo" class = "myButton margin-bottom"><i class="fa-solid fa-percent"></i><br>My Promo Codes</button><br>
                    <button id = "survey" class = "myButton margin-bottom"><i class="fa-solid fa-file-pen"></i><br>Survey</button><br>
                   
                </div>
                <div class="mainChild">
                    <div class="personal">
                        <h1 class = "header">Personal information</h1>
                        <hr class = "headerSeparator">
                        <form action="" method="post">
                            <p>
                            Full Name:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "name" value = "<?php echo $profileData['fullName']; ?>"><br><br>
                            
                            Phone Number 1:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "phone1" value = "<?php echo $profileData['phoneNumber1']; ?>"><br><br>
                            Alternative Phone Number:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "phone2" value = "<?php echo $profileData['phoneNumber2']; ?>"><br><br>
                            </p>
                            <button class = "submitButton" type="submit" name = "submitPersonal">UPDATE</button>
                        </form>
                    </div>
                    <div class="security">
                        <h1 class = "header">Security</h1>
                        <hr class = "headerSeparator">
                        <form action="" method="post">
                            <p>
                            Email:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "email" value = "<?php echo $profileData['email']; ?>"><br><br>
                            Enter current password:&nbsp;&nbsp;&nbsp;
                            <input type="password" name = "password" placeholder = "Enter your old password" ><br><br>
                            Enter new password:&nbsp;&nbsp;&nbsp;
                            <input type="password" name = "newPassword" placeholder = "Enter new password" ><br><br>
                            Confirm New Password:&nbsp;&nbsp;&nbsp;
                            <input type="password" name = "confirmNewPassword" placeholder = "Confirm Your Password"><br><br>
                        </p>
                            <button class = "submitButton" type="submit" name = "submitSecurity">UPDATE</button>
                        </form>
                    </div>
                    <div class="orders">
                        <h1 class = "header">My Orders</h1>
                        <hr class = "headerSeparator">
                        <div id="orderReciept"></div>
                        <h3 class = header>Pending Orders</h3>
                        <div class="gridView">
                            <?php 
                                $this->model->viewOrders($pendingOrders);
                             ?>
                        </div>
                        <br>
                        <h3 class = header>Delivered Orders</h3>
                        <div class="gridView">
                        <?php 
                            $this->model->viewOrders($deliveredOrders);   
                        ?>
                        </div>
                    </div>
                    <div class="address">
                        <h1 class = "header">My Address Book</h1>
                        <hr class = "headerSeparator">
                        <!-- <form action="" method="post">
                            <h5 class = "header">Main Address:</h5>
                            <p>
                            Address:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "address" value = "<?php //echo $profileData['homeAddress1']; ?>"><br><br>
                            </p>
                            <h5 class="header">Alternative Address:</h5>
                            <p>
                            Address:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "address2" value = "<?php //echo $profileData['homeAddress2']; ?>"><br><br>
                            </p>
                            <button class = "submitButton" type="submit" name = "submitAddress">UPDATE</button>
                        </form> -->
                        <div id="myAddresses">
                            <?php
                                $addresses = $this->model->getAddresses($_SESSION['ID']);
                                $this->model->viewAddresses($addresses);
                            ?>
                        </div>
                        
                        <div id="addressbook"></div>
                        <div id="addAddress">
                            <h1 class = addressHeader>Add Address</h1>
                        <input class=addAddressForm id = addstreet type="text" name="street" placeholder="Street Name"/><br>
                        <select id="addregions" name="region"></select><br>
                        <input class=addAddressForm id=adddistrict type="text" name=district placeholder="District"><br>
                        <input class=addAddressForm id=addlandmark type="text" name=landmark placeholder="Landmark"><br>
                        <input class=addAddressForm id=addbuilding type="text" name=building placeholder="Building Number"><br>
                        <input class=addAddressForm id=addappNumber type="text" name=appNumber placeholder="Appartment Number"><br>
                        <button onclick="ajaxAddress()">Add Address</button>
                                        </div>
                    </div>
                    <div class="promo">
                        <h1 class="header">PROMO CODES</h1>
                        <hr class="headerSeparator">
                        <div class="promoItem">
                            <?php
                                $promocodes = $this->model->getPromos();
                                foreach($promocodes as $code){
                                    if(strtotime(date("Y-m-d"))>strtotime($code['createdAt'])){
                                        continue;
                                    }
                                    $dateDiff = floor((strtotime($code['createdAt']. "+ {$code['promoLength']} days") - strtotime(date("Y-m-d")))/86400);
                                    echo "
                                        <h2>{$code['promoValue']} Discount on items</h2>
                                        <h3>Copy the code <span>{$code['promoCode']}</span> to use the discount</h3>
                                        <h4>$dateDiff DAYS LEFT!</h4>
                                        <hr>

                                    ";
                                }
                            ?>
                        </div>
                        

                    </div>
                    <div class="survey">
                    <h2 class="title">
                        <span>Your Opinion</span>
                        <span class="title-word title-word-3">Matters</span>
                    </h2>
                    
        <!-- <h3><b>Overall experience with our service</b></h3> -->
            <br>
            <div class="radio-group">
            <h6>How would you rate your overall experience with our service?</h6>
            <button onclick="toggle(this.value,'one')" value=1 id=onea1><i class="fa-solid fa-face-frown"></i><br>Very Poor</button>
            <button onclick="toggle(this.value,'one')" value=2 id=onea2><i class="fa-solid fa-face-frown-open"></i><br>Poor</button>
            <button onclick="toggle(this.value,'one')" value=3 id=onea3><i class="fa-solid fa-face-meh"></i><br>Fair</button>
            <button onclick="toggle(this.value,'one')" value=4 id=onea4><i class="fa-solid fa-face-smile-beam"></i><br>Good</button>
            <button onclick="toggle(this.value,'one')" value=5 id=onea5><i class="fa-solid fa-face-grin-beam"></i><br>Very Good</button>
            <input type=hidden name=questionOne id=one>
            </div><!-- </tr> -->
          <br>
          <!-- <tr> -->
              <!-- <hr> -->
              <!-- <br> -->
            <div class="radio-group">
            <h6>How satisfied are you with the comprehensiveness of our offer?</h6>
            <button onclick="toggle(this.value,'two')" value=1 id=twoa1><i class="fa-solid fa-face-frown"></i><br>Very Poor</button>
            <button onclick="toggle(this.value,'two')" value=2 id=twoa2><i class="fa-solid fa-face-frown-open"></i><br>Poor</button>
            <button onclick="toggle(this.value,'two')" value=3 id=twoa3><i class="fa-solid fa-face-meh"></i><br>Fair</button>
            <button onclick="toggle(this.value,'two')" value=4 id=twoa4><i class="fa-solid fa-face-smile-beam"></i><br>Good</button>
            <button onclick="toggle(this.value,'two')" value=5 id=twoa5><i class="fa-solid fa-face-grin-beam"></i><br>Very Good</button>
            <input type=hidden name=questionTwo id=two>
            </div>
            <br>
          <!-- </tr> -->
          <!-- <tr> -->
            <div class="radio-group">
            <h6>How would you rate our prices?</h6>
            <button onclick="toggle(this.value,'three')" value=1 id=threea1><i class="fa-solid fa-face-frown"></i><br>Very Poor</button>
            <button onclick="toggle(this.value,'three')" value=2 id=threea2><i class="fa-solid fa-face-frown-open"></i><br>Poor</button>
            <button onclick="toggle(this.value,'three')" value=3 id=threea3><i class="fa-solid fa-face-meh"></i><br>Fair</button>
            <button onclick="toggle(this.value,'three')" value=4 id=threea4><i class="fa-solid fa-face-smile-beam"></i><br>Good</button>
            <button onclick="toggle(this.value,'three')" value=5 id=threea5><i class="fa-solid fa-face-grin-beam"></i><br>Very Good</button>
            <input type=hidden name=questionThree id=three>
            </div>
            <br>
          <!-- </tr> -->
          <!-- <tr> -->
            <div class="radio-group">
            <h6>How satisfied are you with the customer support?</h6>
            <button onclick="toggle(this.value,'four')" value=1 id=foura1><i class="fa-solid fa-face-frown"></i><br>Very Poor</button>
            <button onclick="toggle(this.value,'four')" value=2 id=foura2><i class="fa-solid fa-face-frown-open"></i><br>Poor</button>
            <button onclick="toggle(this.value,'four')" value=3 id=foura3><i class="fa-solid fa-face-meh"></i><br>Fair</button>
            <button onclick="toggle(this.value,'four')" value=4 id=foura4><i class="fa-solid fa-face-smile-beam"></i><br>Good</button>
            <button onclick="toggle(this.value,'four')" value=5 id=foura5><i class="fa-solid fa-face-grin-beam"></i><br>Very Good</button>
            <input type=hidden name=questionFour id=four>
            </div>
            <br>
          <!-- </tr> -->
          <div class="radio-group">
            <h6>Would you recommend our product / service to other people?</h6>
            <button onclick="toggle(this.value,'five')" value=1 id=fivea1><i class="fa-solid fa-face-frown"></i><br>Very Poor</button>
            <button onclick="toggle(this.value,'five')" value=2 id=fivea2><i class="fa-solid fa-face-frown-open"></i><br>Poor</button>
            <button onclick="toggle(this.value,'five')" value=3 id=fivea3><i class="fa-solid fa-face-meh"></i><br>Fair</button>
            <button onclick="toggle(this.value,'five')" value=4 id=fivea4><i class="fa-solid fa-face-smile-beam"></i><br>Good</button>
            <button onclick="toggle(this.value,'five')" value=5 id=fivea5><i class="fa-solid fa-face-grin-beam"></i><br>Very Good</button>
            <input type=hidden name=questionFive id=five>
            </div>
            <br>
        <!-- </table> -->
        <h6><b>What should we change in order to live up to your expectations?</b></h6>
        <textarea id = surveyDescription name=surveyText class=textStyle style="resize: none;"></textarea>
        <span id=success style="color: green"></span>
        <span class=error id=surveyError></span>
          <button style="color: white;background-color: #FBAB7E;" onclick="survey()">Send Feedback</button>
                    </div>
                   
                </div>
            </div>
            <script>
                function readTextFile(file,callback){
                            var rawFile = new XMLHttpRequest()
                            rawFile.overrideMimeType("application/json")
                            rawFile.open("GET",file,true)
                            rawFile.onreadystatechange = () => {
                                if(rawFile.readyState === 4 && rawFile.status == "200"){
                                callback(rawFile.responseText)
                                }
                            }
                            rawFile.send(null)
                        }
                        readTextFile("<?php echo URLROOT . "json/regions.json" ;?>",(text) => {
                            data = JSON.parse(text)
                            data.forEach(function(city){
                                console.log(city.city)
                                option = "<option value='"+city.city+"'>"+city.city+"</option>"
                                $("#regions").append(option)
                                $("#addregions").append(option)
                            })
                        })
                $(document).ready(function(){
                    count = 0;
                $("#personal").click(function(){
                    
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".personal").css("display", "block");
                    $(".promo").css("display", "none");
                    $(".survey").css("display", "none");
                    $("#survey").removeClass("selected");
                    $("#promo").removeClass("selected");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").addClass("selected");

                })
                $("#security").click(function(){
                    $(".personal").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".security").css("display", "block");
                    $(".promo").css("display", "none");
                    $(".survey").css("display", "none");
                    $("#survey").removeClass("selected");
                    $("#promo").removeClass("selected");
                    $("#security").addClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#orders").click(function(){
                    $(".personal").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "block");
                    $(".promo").css("display", "none");
                    $(".survey").css("display", "none");
                    $("#survey").removeClass("selected");
                    $("#promo").removeClass("selected");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").addClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#address").click(function(){
                    $(".delete").css("display", "none");
                    $(".personal").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "block");
                    $(".promo").css("display", "none");
                    $(".survey").css("display", "none");
                    $("#survey").removeClass("selected");
                    $("#promo").removeClass("selected");
                    $("#security").removeClass("selected");
                    $("#address").addClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#delete").click(function(){
                    $(".personal").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "block");
                    $(".promo").css("display", "none");
                    $(".survey").css("display", "none");
                    $("#survey").removeClass("selected");
                    $("#promo").removeClass("selected");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").addClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#promo").click(function(){
                    $(".personal").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".promo").css("display", "block");
                    $(".survey").css("display", "none");
                    $("#survey").removeClass("selected");
                    $("#promo").addClass("selected");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#survey").click(function(){
                    $(".personal").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".promo").css("display", "none");
                    $(".survey").css("display", "block");
                    $("#survey").addClass("selected");
                    $("#promo").removeClass("selected");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                    
                });
                function toggle(value,id){
                    if(value == 1) {
                        $("#"+id+"a1").addClass("selectedAns");
                        $("#"+id+"a2,#"+id+"a3,#"+id+"a4,#"+id+"a5").removeClass("selectedAns")
                    }
                    if(value == 2) {
                        $("#"+id+"a2").addClass("selectedAns");
                        $("#"+id+"a1,#"+id+"a3,#"+id+"a4,#"+id+"a5").removeClass("selectedAns")
                    }
                    if(value == 3) {
                        $("#"+id+"a3").addClass("selectedAns");
                        $("#"+id+"a2,#"+id+"a1,#"+id+"a4,#"+id+"a5").removeClass("selectedAns")
                    }
                    if(value == 4) {
                        $("#"+id+"a4").addClass("selectedAns");
                        $("#"+id+"a2,#"+id+"a3,#"+id+"a1,#"+id+"a5").removeClass("selectedAns")
                    }
                    if(value == 5) {
                        $("#"+id+"a5").addClass("selectedAns");
                        $("#"+id+"a2,#"+id+"a3,#"+id+"a4,#"+id+"a1").removeClass("selectedAns")
                    }
                    $("#"+id).val(value)
                    // alert($("#one").val());
                }
                function survey(){
                    questionOne = $('#one').val();
                    questionTwo = $('#two').val();
                    questionThree = $('#three').val();
                    questionFour = $('#four').val()
                    questionFive = $('#five').val()
                    description = $('#description').val()
                    error = false
                    if(questionOne == "" || questionTwo == "" || questionThree == "" || questionFour == "" || questionFive == ""){
                        error = true
                        $("#surveyError").html("Please fill all questions in the form")
                    }
                    else{
                        $("#surveyError").html("")
                        $.ajax({
                            type: 'POST',
                            url: 'profile',
                            data: {q1: questionOne, q2:questionTwo, q3:questionThree, q4:questionFour, q5:questionFive, description: description},
                            success: (result) => {
                                $("#success").html(result)
                            } 
                        })
                    }
                    // alert(questionFour)
                }
                function viewAddress(ID){
                    $.ajax({
                        type: 'POST',
                        url: 'profile',
                        data: {addressID:ID},
                        success: (result)=>{
                            $("#addressbook").html(result)
                        }
                    })
                }
                function editAddress(ID){
                    street = $("#street").val()
                    region = $("#regions").val()
                    landmark = $("#landmark").val()
                    building = $("#building").val()
                    district = $("#district").val()
                    appNumber = $("#appNumber").val()
                    if(street == '' || region =='' || landmark == '' || building == '' || district == '' || appNumber == ''){
                        $("#addressError").html("Some fields are empty")
                    }
                    else
                        $.ajax({
                            type: 'POST',
                            url: 'profile',
                            data: {editAddressID:ID,street:street,region:region,landmark:landmark,building:building,district:district,appNumber:appNumber},
                            success: (result) => {
                                $("#addressbook").html(result)
                            }
                        })
                }
                function addAddress(){
                    $("#addressbook").html($("#addAddress").html())
                    
                }
                function ajaxAddress(){
                    street =   $("#addstreet").val()
                    region =   $("#addregions").val()
                    landmark = $("#addlandmark").val()
                    building = $("#addbuilding").val()
                    district = $("#adddistrict").val()
                    appNumber = $("#addappNumber").val()
                    addID = "addID"
                    fd = new FormData();
                    fd.append("addID",addID)
                    fd.append("street",street)
                    fd.append("region",region)
                    fd.append("landmark",landmark)
                    fd.append("building",building)
                    fd.append("district",district)
                    fd.append("appNumber",appNumber)
                    if(street == '' || region =='' || landmark == '' || building == '' || district == '' || appNumber == ''){
                        $("#addressError").html("Some fields are empty")
                    }
                    else
                        $.ajax({
                            type: 'POST',
                            url: 'profile',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: (result) => {
                                $("#myAddresses").html(result)
                                $("#addressbook").html("")
                            }
                        })
                }
                function confirmDelete(ID,addresses){
                    if(addresses == 2)
                        $("#confirmDeleteAddress" + ID).html("<span class=confirmDelete>Are You sure you want to delete?</span><button class=deleteAddress onclick='deleteAddress("+ID+")'>DELETE</button><button class=cancelAddress onclick='cancelAddress("+ID+")'>CANCEL</button>")
                    else
                    $("#confirmDeleteAddress" + ID).html("This address can not be deleted as it is the only address available")
                }
                function deleteAddress(ID){
                    $.ajax({
                        type: "POST",
                        url: "profile",
                        data:{deleteAddressID:ID},
                        success: (result) => {
                            $("#myAddresses").html(result)
                            $("#confirmDeleteAddress" + ID).html("")
                        }
                    })
                }
                function cancelAddress(ID){
                    $("#confirmDeleteAddress" + ID).html("")
                }
                function viewOrder(value){
                    $.ajax({
                        type: "POST",
                        url: "profile",
                        data:{orderID:value},
                        success: (result) => {
                            $("#orderReciept").html(result)
                            $("#orderReciept").css("display","block")
                        }
                    })
                }
                function closeView(){
                    $("#orderReciept").html("")
                    $("#orderReciept").css("display", "none")
                }
            </script>
        <?php
    }
}