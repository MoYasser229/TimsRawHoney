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
    public function getName($ID){
        
        $result = $this->database->query("SELECT * FROM users WHERE ID= $ID");
        return $result -> fetch_assoc()['fullName'];
    }

}



?>