<?php
class Survey{
    public $q1,$q2,$q3,$q4,$q5, $description,$customerID;
    public function __construct($customerID,$q1,$q2,$q3,$q4,$q5,$description){
        $this->customerID = $customerID;
        $this->q1 = $q1;
        $this->q2 = $q2;
        $this->q3 = $q3;
        $this->q4 = $q4;
        $this->q5 = $q5;
        $this->description = $description;
    }
}
?>