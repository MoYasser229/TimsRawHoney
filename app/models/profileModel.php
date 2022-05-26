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
    public function addAddress($ID,$street,$region,$landmark,$building,$district,$appNumber){
        $this->database->query("INSERT INTO user_address(customerID,street,region,landmark,buildingNumber,district,appNumber) VALUES('$ID','$street','$region','$landmark','$building','$district','$appNumber')");
    }
    public function viewAddresses($addresses){
        foreach ($addresses as $address){
            echo <<<HTML
                <div class=addressContainer>
                    <p>{$address['street']} Address</p>
                    <button onclick="viewAddress({$address['AddressID']})">VIEW</button>
                </div>
            HTML;
        }
        if(mysqli_num_rows($addresses) < 2){
            echo <<<HTML
                <div class=addAddress>
                    <button onclick="addAddress()">Add Address</button>
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
                <p>Street</p> <input type="text" id = street name="street" value="{$address['street']}">
                <p>Region</p> <select name="region" id="regions" ></select>
                <p>LandMark</p> <input type="text" id=landmark name="landmark" value="{$address['landmark']}">
                <p>Building Number</p> <input type="text" id=building name = building value="{$address['buildingNumber']}">
                <p>District</p> <input type="text" name=district id=district value="{$address['district']}">
                <p>Appartment Number</p> <input type="text" id=appNumber name=appNumber value="{$address['appNumber']}">
                <button onclick="editAddress({$address['AddressID']})">SUBMIT</button>
                <div id=addressError></div>
            HTML;
        }
        
    }
    public function insertSurvey($survey){
        $this->database->query("INSERT INTO survey(customerID,questionOne,questionTwo,questionThree,questionFour,questionFive,`description`) VALUES('{$survey->customerID}','{$survey->q1}','{$survey->q2}','{$survey->q3}','{$survey->q4}','{$survey->q5}','{$survey->description}')");
    }
}