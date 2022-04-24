<?php
class productModel extends Model{

    public $title = "Tim's Raw Honey";
     
    public function getimage(){
        return IMAGEROOT . 'jarr3.png' ;
    }
}



?>