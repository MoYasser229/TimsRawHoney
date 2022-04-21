<?php

class profileModel extends Model{
    public $title = "Tim's Raw Honey";
    public $css = URLROOT . "css/profileStyles.css";
    public $icon = IMAGEROOT . "icon/";
    public function getUserData($ID){
        $result = $this->database->query("SELECT * FROM users WHERE ID = '$ID'")->fetch_assoc();
        return $result;

    }
    // public function getSecurity(){

    // }
    public function getPendingOrders($ID){
        $result = $this->database->query("SELECT * FROM orders WHERE customerID = '$ID'")->fetch_assoc();
        $pending = [];
        while($row = $result){
            $result2 = $this->database->query("SELECT * FROM deliveries WHERE orderID = '{$row['ID']}'")->fetch_assoc();
            if($row1 = $result2){
                if($row1['deliveryStatus'] == 'PENDING')
                    $pending[] = $row1['deliveryStatus'];
            }
        }
        return $pending;
    }
    public function getDeliveredOrders($ID){
        $result = $this->database->query("SELECT * FROM orders WHERE customerID = '$ID'")->fetch_assoc();
        $delivered = [];
        while($row = $result){
            $result2 = $this->database->query("SELECT * FROM deliveries WHERE orderID = '{$row['ID']}'")->fetch_assoc();
            if($row1 = $result2){
                if($row1['deliveryStatus'] == 'DELIVERED')
                    $delivered[] = $row1['deliveryStatus'];
            }
        }
        return $delivered;
    }
    // public function getAddress(){

    // }
    // public function getAlternateAddress(){

    // }
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
}