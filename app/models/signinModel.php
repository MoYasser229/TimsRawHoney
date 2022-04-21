<?php
class signinModel extends Model{
    public $title = "Tim's Raw Honey";
    public $css = URLROOT . "css/signinStyle.css";
    public $icon = IMAGEROOT . "icon/";
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
    private $errorEmail;
    private $errorPassword;

    public function setErrorEmail($errorEmail){
        $this->errorEmail = $errorEmail;
    }
    public function setErrorPassword($errorPassword){
        $this->errorPassword = $errorPassword;
    }
    public function getErrorEmail(){
        return $this->errorEmail;
    }
    public function getErrorPassword(){
        return $this->errorPassword;
    }
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
    public function facebookSignIn(){
        $result = $this->database->query("SELECT * FROM users WHERE email = '{$this->email}'");
        $rows = mysqli_num_rows($result);
        if($rows === 0){
            return false;
        }
        return $result->fetch_assoc();
    }   
                        
    public function signin(){
        $result = $this->database->query("SELECT * FROM users WHERE email = '{$this->email}' AND pswrd = '{$this->pswrd}'");
        $rows = mysqli_num_rows($result);
        if($rows === 0){
            return false;
        }
        return $result->fetch_assoc();
    } 
                       
}

?>