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
        $specialChars = preg_match('@[^\w]@',$password);
        return (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)?false:true; 
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