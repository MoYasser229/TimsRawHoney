<?php

class Address{
    //ATRIBUTES
    private $street, $district, $region, $appNumber, $buildingNumber, $landMark,$userID;
    protected $database;
    public function __construct($street, $district, $region, $appNumber, $buildingNumber,$landMark){
        $this->setStreet($street);
        $this->setDistrict($district);
        $this->setRegion($region);
        $this->setAppNumber($appNumber);
        $this->setBuildingNumber($buildingNumber);
        $this->setLandMark($landMark);
        $this->database = new Database();
    }
    public function validate(){
        if(empty($this->street) || empty($this->district) || empty($this->region) || empty($this->buildingNumber) || empty($this->landMark) || empty($this->appNumber)){
            return false;
        }
        return true;
    }
    public function insertDB(){
        $this->userID = $this->database->query("SELECT ID from users ORDER BY ID DESC LIMIT 1")->fetch_assoc()['ID'];
        $this->database->query("INSERT INTO user_address(customerID,street,district,appNumber,buildingNumber,landMark,region) VALUES ('{$this->userID}','{$this->street}','{$this->district}','{$this->appNumber}','{$this->buildingNumber}','{$this->landMark}','{$this->region}')");
    }
    public function setUserID($userID){
        $this->userID = $userID;
    }
    public function setStreet($street){
        $this->street = $street;
    }
    public function setDistrict($district){
        $this->district = $district;
    }
    public function setAppNumber($appNumber){
        $this->appNumber = $appNumber;
    }
    public function setBuildingNumber($buildingNumber){
        $this->buildingNumber = $buildingNumber;
    }
    public function setLandMark($landMark){
        $this->landMark = $landMark;
    }
    public function setRegion($region){
        $this->region = $region;
    }
    public function getStreet(){
        return $this->street;
    }
    public function getDistrict(){
        return $this->district;
    }
    public function getAppNumber(){
        return $this->appNumber;
    }
    public function getBuildingNumber(){
        return $this->buildingNumber;
    }
    public function getLandMark(){
        return $this->landMark;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getRegion(){
        return $this->region;
    }
    
}