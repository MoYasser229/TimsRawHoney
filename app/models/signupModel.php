<?php
class signupModel extends Model{
    public $title = 'Tims Raw Honey';
    public $css = URLROOT . '/css/signupStyle.css';
    public $icon = IMAGEROOT . 'icon/';
    private $ID;
    private $fname;
    private $lname;
    private $name;
    private $email;
    private $pswrd;
    private $confirmPassword;
    private $phoneNumber1;
    private $phoneNumber2;
    private $userRole;
    private $homeAddress1;
    private $homeAddress2;
    private $errorEmail;
    private $errorPassword;
    private $errorName;
    private $errorConfirmPassword;
    private $errorConfirmation;
    private $errorPhone1;
    private $errorAddress1;
    public function setErrorConfirmPassword($errorConfirmPassword){
        $this->errorConfirmPassword = $errorConfirmPassword;
    }
    public function setErrorConfirmation($errorConfirmation){
        $this->errorConfirmation = $errorConfirmation;
    }
    public function setErrorPhone1($errorPhone1){
        $this->errorPhone1 = $errorPhone1;
    }
    public function setErrorAddress1($errorAddress1){
        $this->errorAddress1 = $errorAddress1;
    }
    public function getErrorConfirmPassword(){
        return $this->errorConfirmPassword;
    }
    public function getErrorConfirmation(){
        return $this->errorConfirmation;
    }
    public function getErrorPhone1(){
        return $this->errorPhone1;
    }
    public function getErrorAddress1(){
        return $this->errorAddress1;
    }
    public function setErrorName($errorName){
        $this->errorName = $errorName;
    }
    public function getErrorName(){
        return $this->errorName;
    }
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
    public function setConfirmPassword($confirmPassword){
        $this->confirmPassword = $confirmPassword;
    }
    public function getConfirmPassword(){
        return $this->confirmPassword;
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
    public function setName($name){
        $this->name = $name;
    }
    public function getName() {
        return $this->name;
    }
    private $socialError;
    public function setSocialError($socialError){
        $this->socialError = $socialError;
    }
    public function getSocialError(){
        return $this->socialError;
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
        $name = $this->name;
        $result = $this->database->query("INSERT INTO users(fullName,email,pswrd,phoneNumber1,phoneNumber2,homeAddress1,homeAddress2,userRole) VALUES('$name','$email','$password','$phoneNumber1','$phoneNumber2','$homeAddress1','$homeAddress2','CUSTOMER')");
        if(!$result){
            return false;
        }
        return true;
    }
    public function repeatEmail(){
        $email = $this->email;
        $result = $this->database->query("SELECT * FROM users WHERE email = '$email'");
        $rows = mysqli_fetch_array($result);
        if($rows == 0)
            return true;
        return false;
    }
    private $pageError;
    public function setPageError($statement){
        $this->pageError = $statement;
    }
    public function getPageError(){
        return $this->pageError;
    }
    public function validateEmail(){
        $email = $this->email;
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    public function checkPassword(){
        $password = $this->pswrd;
        $uppercase = preg_match('@|A-Z|@',$password);
        $lowercase = preg_match('@|a-z|@',$password);
        $number = preg_match('@|0-9|@',$password);
        $specialChars = preg_match('@[^\w]@',$password);
        return (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)?false:true; 
    }
}

?>