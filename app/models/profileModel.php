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
    public function insertSurvey($survey){
        $this->database->query("INSERT INTO survey(customerID,questionOne,questionTwo,questionThree,questionFour,questionFive,`description`) VALUES('{$survey->customerID}','{$survey->q1}','{$survey->q2}','{$survey->q3}','{$survey->q4}','{$survey->q5}','{$survey->description}')");
    }
}