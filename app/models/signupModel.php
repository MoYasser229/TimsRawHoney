<?php
class signupModel extends Model{
    public $title = 'Tims Raw Honey';
    public $css = URLROOT . '/css/signupStyle.css';
    public $icon = IMAGEROOT . 'icon/';
    private $ID;
    private $fname;
    private $lname;
    private $email;
    private $pswrd;
    private $phoneNumber1;
    private $phoneNumber2;
    private $userRole;
    private $homeAddress1;
    private $homeAddress2;

    public function setid($ID) {
    $this->ID = $ID;
    }
    public function getid() {
        return $this->ID;
    }

    public function setfname($fname) {
        $this->fname = $fname;
    }
    public function getfname() {
        return $this->fname;
    }

    public function setlname($lname) {
        $this->lname = $lname;
    }
    public function getlname() {
        return $this->lname;
    }

    public function setemail($email) {
        $this->email = $email;
    }
    public function getemail() {
        return $this->email;
    }
    public function setpassword($pswrd){
        $this->pswrd = $pswrd;
    }
    public function getpassword(){
        return $this->pswrd;
    }
    public function setphonenumber1($phoneNumber1) {
        $this->phoneNumber1 = $phoneNumber1;
    }
    public function getphoneNumber1() {
        return $this->phoneNumber1;
    }
    public function setphonenumber2($phoneNumber2) {
        $this->phoneNumber2 = $phoneNumber2;
    }
    public function getphoneNumber2() {
        return $this->phoneNumber2;
    }
    public function setuserrole($userRole){
        $this->userRole = $userRole;
    }
    public function getuserole(){
        return $this->userRole;
    }
    public function sethomeaddress1($homeAddress1) {
        $this->homeAddress1 = $homeAddress1;
    }
    public function gethomeaddress1() {
    return $this->homeAddress1;
    }
    public function sethomeaddress2($homeAddress2) {
        $this->homeAddress2 = $homeAddress2;
    }
    public function gethomeAddress2() {
        return $this->homeAddress2;
    }
    public function register(){
        $fname = $this->fname;
        $lname = $this->lname;
        $email = $this->email;
        $password = $this->pswrd;
        $homeAddress1 = $this->homeAddress1;
        $homeAddress2 = $this->homeAddress2;
        $phoneNumber1 = $this->phoneNumber1;
        $phoneNumber2 = $this->phoneNumber2;
        $result = $this->database->query("INSERT INTO users(fname,lname,email,pswrd,phoneNumber1,phoneNumber2,homeAddress1,homeAddress2,userRole) VALUES('$fname','$lname','$email','$password','$phoneNumber1','$phoneNumber2','$homeAddress1','$homeAddress2','CUSTOMER')");
        if(!$result){
            return false;
        }
        return true;
    }
}

?>