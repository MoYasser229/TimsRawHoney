<?php
class productModel extends Model{

    public $title = "Tim's Raw Honey";
     
    public function getimage(){
        return IMAGEROOT . 'jarr3.png' ;
    }
    public function getCost(){
        return 90;
    }
    public function getOffer(){
        return 75;
    }
    public function getMaterial(){
    return array(["Glass","Plastic"]);
    }
    public function getSize(){
        return array(["Small","Medium","Large","XLarge"]);
    }

}



?>