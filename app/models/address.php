<?php

class Address{
    //ATRIBUTES
    private $street, $district, $region, $appNumber, $status, $buildingNumber, $floorNumber, $landMark;
    public function __construct($street, $district, $region, $appNumber, $status, $buildingNumber, $floorNumber,$landMark){
        $this->setStreet($street);
        $this->setDistrict($district);
        $this->setRegion($region);
        $this->setAppNumber($appNumber);
        $this->setStatus($status);
        $this->setBuildingNumber($buildingNumber);
        $this->setFloorNumber($floorNumber);
        $this->setLandMark($landMark);
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
    public function setStatus($status){
        $this->status = $status;
    }
    public function setFloorNumber($floorNumber){
        $this->floorNumber = $floorNumber;
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
    public function getFloorNumber(){
        return $this->floorNumber;
    }
    public function getRegion(){
        return $this->region;
    }
    
}