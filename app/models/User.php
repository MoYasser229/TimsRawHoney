
<?php 

class User{
    private $name;
    private $Email;
    private $Password;
    private $PhoneNumber1;
    private $PhoneNumber2;
    private $address1;
    private $address2;
    private $Role;
    private $ID;
    protected $database;

    public function __construct($ID){
        $this->ID = $ID;
        $this->database = new Database;
        $customerData = $this->database->query("SELECT * FROM users WHERE ID = {$this->ID}");
        if($customer = $customerData->fetch_assoc()){
            $this->name = $customer['fullName'];
            $this->Email = $customer['email'];
            $this->Password = $customer['pswrd'];
            $this->PhoneNumber1 = $customer['phoneNumber1'];
            $this->PhoneNumber2 = $customer['phoneNumber2'];
            $this->address1 = $customer['homeAddress1'];
            $this->address2 = $customer['homeAddress2'];
            $this->Role = $customer['userRole'];
        }
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getName(){
        return $this->name;
    }
    public function setEmail($Email){
        $this->Email = $Email;
    }
    public function setPassword($Password){
        $this->Password = $Password;
    }
    public function setPhoneNumber($PhoneNumber){
        $this->PhoneNumber = $PhoneNumber;
    }
    public function setRole($Role){
        $this->Role = $Role;
    }
    public function setID($ID){
        $this->ID = $ID;
    }
    public function getEmail(){
        $this->Email;
    }
    public function getPassword(){
        $this->Password;
    }
    public function getPhone1(){
        return $this->PhoneNumber1;
    }
    public function getPhone2(){
        return $this->PhoneNumber2;
    }
    public function getAddress1(){
        return $this->address1;
    }
    public function getAddress2(){
        return $this->address2;
    }
    public function getRole(){
        $this->Role;
    }
    public function getID(){
        $this->ID;
    }

    //functions required (user checking database)
}
