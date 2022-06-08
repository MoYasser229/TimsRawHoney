<?php

class profileModel extends Model{
    public $title = "Tim's Raw Honey";
    public $css = URLROOT . "css/profileStyles.css";
    public $icon = IMAGEROOT . "icon/";
    public function getUserData($ID){
        $result = $this->database->query("SELECT * FROM users WHERE ID = '$ID'");
        return $result;

    }
    // public function getSecurity(){

    // }
    public function getPendingOrders($ID){
        $result = $this->database->query("SELECT * FROM orders,deliveries WHERE orders.customerID = $ID AND orders.ID = deliveries.orderID AND deliveries.deliveryStatus = 'PENDING'");
        if(mysqli_num_rows($result) == 0){
            return 0;
        }
        return $result;
    }
    public function getDeliveredOrders($ID){
        $result = $this->database->query("SELECT * FROM orders,deliveries WHERE orders.customerID = $ID AND orders.ID = deliveries.orderID AND deliveries.deliveryStatus = 'DELIVERED'");
        if(mysqli_num_rows($result) == 0){
            return 0;
        }
        return $result;
    }
    public function checkSurvey($ID){
        $result = $this->database->query("SELECT * FROM survey WHERE customerID = $ID");
        if(mysqli_num_rows($result) == 0){
            return true;
        }
        return false;
    }
    public function getPromos(){
        $result = $this->database->query("SELECT * FROM promocodes WHERE active = '1'");
        return $result;
    }
    public function getOldPassword($ID){
        $result = $this->database->query("SELECT pswrd FROM users WHERE ID = '$ID'")->fetch_assoc();
        return $result;
    }
    public function checkPassword($password){
        $uppercase = preg_match('@|A-Z|@',$password);
        $lowercase = preg_match('@|a-z|@',$password);
        $number = preg_match('@|0-9|@',$password);
        return (!$uppercase || !$lowercase || !$number || strlen($password) < 8)?false:true; 
    }
    public function deleteAccount($ID){
        $result = $this->database->query("DELETE FROM users WHERE ID = '$ID'");
        return ($result)?true:false;
    }
    public function updatePersonal($ID,$name, $phone1, $phone2){
        $result = $this->database->query("UPDATE users SET fullName = '$name', phoneNumber1 = '$phone1',phoneNumber2 = '$phone2' WHERE ID = $ID ");
        return ($result)?true:false;
    }
    public function updateSecurity($ID,$email,$password){
        $password = password_hash($password,PASSWORD_DEFAULT);
        $result = $this->database->query("UPDATE users SET email = '$email', pswrd = '$password' WHERE ID =$ID");
        return ($result)?true:false;
    }
    public function updateAddress($ID,$address1,$address2){
        $result = $this->database->query("UPDATE users SET homeAddress1 = '$address1', homeAddress2 = '$address2' WHERE ID = '$ID'");
        return ($result)?true:false;
    }
    public function getAddresses($ID){
        $result = $this->database->query("SELECT * FROM user_address WHERE customerID = $ID");
        return $result;
    }
    public function updateAddressDB($ID,$street,$region,$landmark,$building,$district,$appNumber){
        $this->database->query("UPDATE user_address SET street='$street',region='$region',landmark='$landmark',buildingNumber='$building',district = '$district',appNumber = '$appNumber' WHERE AddressID = '$ID'");
    }
    public function deleteAddress($address){
        $this->database->query("DELETE FROM user_address WHERE AddressID = '$address'");
    }
    public function addAddress($ID,$street,$region,$landmark,$building,$district,$appNumber){
        $this->database->query("INSERT INTO user_address(customerID,street,region,landmark,buildingNumber,district,appNumber) VALUES('$ID','$street','$region','$landmark','$building','$district','$appNumber')");
    }
    public function viewAddresses($addresses){
        $num = mysqli_num_rows($addresses);
        foreach ($addresses as $address){
            $street = strtoupper($address['street']);
            echo <<<HTML
                <div class=addressContainer>
                    <span class=addressHeader>Address: <strong>{$street}</strong></span>
                    <button class=viewaddressButton onclick="viewAddress({$address['AddressID']})">VIEW</button>
                    <button id=deleteAddress onclick="confirmDelete({$address['AddressID']},{$num})" >DELETE</button>
                    <div id=confirmDeleteAddress{$address['AddressID']}></div>
                    <hr>
                </div>
            HTML;
        }
        if(mysqli_num_rows($addresses) < 2){
            echo <<<HTML
                <div class=addAddress>
                    <button onclick="addAddress()"><i class="fa-solid fa-plus"></i><br>ADD ADDRESS</button>
                </div>
            HTML;
        }
    }
    public function viewOrders($orders){
        if($orders === 0){
            echo "<h6>No Pending Orders</h6>";
        }
        else
            foreach ($orders as $order){
                echo "
                    <div class='gridCard'>
                    <h5>Order Serial: <strong>{$order['ID']}</strong></h5>
                    <hr>
                    <p>Order Total Price: <strong>{$order['orderTotalPrice']} EGP</strong></p>
                    <p>Order status: <strong>{$order['deliveryStatus']}</strong></p>
                    <p>Order Date: <strong>{$order['createdAt']}</strong></p>
                    <button onclick='viewOrder(this.value); topFunction()' name = 'viewOrder' value = '{$order['ID']}' id = '{$order['ID']}'>View Order</button>
                    </div>
                    <script>

                    var mybutton = document.getElementById('{$order['ID']}');
    
                    // When the user scrolls down 20px from the top of the document, show the button
                    window.onscroll = function() {scrollFunction()};
    
                    function scrollFunction() {
                      if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                        mybutton.style.display = 'block';
                      } else {
                        mybutton.style.display = 'none';
                      }
                    }
    
                    // When the user clicks on the button, scroll to the top of the document
                    function topFunction() {
                      document.body.scrollTop = 0;
                      document.documentElement.scrollTop = 0;
                    }
                    </script>
                ";
        }
    }
    public function myOrder($ID){
        $result = $this->database->query("SELECT * FROM orders,orderitems,products WHERE orders.ID = orderitems.orderID AND orderitems.productID = products.ID AND orders.ID = $ID");
        if($order = $result->fetch_assoc()){
            $discount = 1;
            $discountString = "";
            if(isset($order['promocodeid'])){
                $discount=(($this->database->query("SELECT promoValue FROM promocodes WHERE promoID = '{$order['promocodeid']}'")->fetch_assoc()['promoValue']));
                $discountString = "Discount: " . (($this->database->query("SELECT promoValue FROM promocodes WHERE promoID = '{$order['promocodeid']}'")->fetch_assoc()['promoValue']))." %";
            }
            $totalPrice = $order['orderTotalPrice'] ;
            $createdAt = Date("D d F Y",strtotime($order['createdAt']));
            $discountPrice=$totalPrice*$discount/100;
            $totalAfter=$totalPrice-$discountPrice;
            if (isset($order['promocodeid'])){
            echo <<<HTML
                <button onclick="closeView()">X</button>
                <h4>Order Serial: <strong>{$order['orderID']}</strong></h4>
                <h6>$discountString</h6>
                <h5>Date of issue: <strong>{$createdAt}</strong></h5>
                <h5>Price before discount : <strong>$totalPrice EGP</strong></h5>
                
                <h5>Price After discount : <strong>$totalAfter EGP</strong></h5>
              
            HTML;
            }
            else{
                echo <<<HTML
                <button onclick="closeView()">X</button>
                <h4>Order Serial: <strong>{$order['orderID']}</strong></h4>
                <h6>$discountString</h6>
                <h5>Date of issue: <strong>{$createdAt}</strong></h5>
                <h5>Price: <strong>$totalPrice EGP</strong></h5>
                  
            HTML;
            }
        }
        echo <<<HTML
            <div class="table">
                <div class="table-header">
                    <div class="header__item"><span id="name" class="filter__link">Name</span></div>
                    <div class="header__item"><span id="price" class="filter__link">Unit Price</span></div>
                    <div class="header__item"><span id="quantity" class="filter__link">Quantity</span></div>
                    <div class="header__item"><span id="totalPrice" class="filter__link">Price</span></div>
                </div>
            </div>
            <div class="table-content">
                
         HTML;
        foreach($result as $order){
            $productPrice = $order['retailCost'] * $order['quantity'];
            echo <<<HTML
                <div class='table-row'>
                    <div class='table-data'>{$order['productName']}</div>
                    <div class='table-data'>{$order['retailCost']} EGP</div>
                    <div class='table-data'>{$order['quantity']}</div>
                    <div class='table-data'>{$productPrice} EGP</div>

            </div>
            HTML;
        }
        echo "</div>";
        
    }
    public function getAddress($address){
        $result = $this->database->query("SELECT * FROM user_address WHERE AddressID = '$address'")->fetch_assoc();
        if($address = $result){
            $url = URLROOT . "json/regions.json";
            echo <<<HTML
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
                        readTextFile("{$url}",(text) => {
                            data = JSON.parse(text)
                            data.forEach(function(city){
                                console.log(city.city)
                                if(city.city == "{$address['region']}")
                                    option = "<option value='"+city.city+"' selected>"+city.city+"</option>"
                                else
                                    option = "<option value='"+city.city+"'>"+city.city+"</option>"
                                $("#regions").append(option)
                            })
                        })
                </script>
                <div class="addressFormEdit">
                    <h1 class=addressHeader >ADDRESS INFORMATION</h1>
                    <span class=formText>Street</span> <input class=editAddress type="text" id = street name="street" value="{$address['street']}"><br>
                    <span class=formText>Region</span> <select name="region" id="regions" ></select><br>
                    <span class=formText>LandMark</span> <input class=editAddress type="text" id=landmark name="landmark" value="{$address['landmark']}"><br>
                    <span class=formText>Building Number</span> <input class=editAddress type="text" id=building name = building value="{$address['buildingNumber']}"><br>
                    <span class=formText>District</span> <input class=editAddress type="text" name=district id=district value="{$address['district']}"><br>
                    <span class=formText>Appartment Number</span> <input class=editAddress type="text" id=appNumber name=appNumber value="{$address['appNumber']}"><br>
                    <div id=addressError></div>
                    <button onclick="editAddress({$address['AddressID']})">SUBMIT</button>
                    
                </div>
                
            HTML;
        }
        
    }
    public function insertSurvey($survey){
        $this->database->query("INSERT INTO survey(customerID,questionOne,questionTwo,questionThree,questionFour,questionFive,`description`) VALUES('{$survey->customerID}','{$survey->q1}','{$survey->q2}','{$survey->q3}','{$survey->q4}','{$survey->q5}','{$survey->description}')");
    }
}