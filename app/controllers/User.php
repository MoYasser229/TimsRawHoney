
<?php 

class User{
    private FirstName;
    private LastName;
    private Email;
    private Password;
    private PhoneNumber;
    private Role;
    private ID;

    public function __construct(FirstName,LastName,Email,Password,PhoneNumber,Role,ID){
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->PhoneNumber = $PhoneNumber;
        $this->Role = $Role;
        $this->ID = $ID;
    }
    public function setFirstName($FirstName){
        $this->FirstName = $FirstName;
    }
    public function setLastName($LastName){
        $this->LastName = $LastName;
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

    public function getFirstName(){
        return $this->FirstName;
    }
    public function getLastName(){
        return $this->LastName;
    }
    public function getEmail(){
        $this->Email;
    }
    public function getPassword(){
        $this->Password;
    }
    public function getPhoneNumber(){
        $this->PhoneNumber;
    }
    public function getRole(){
        $this->Role;
    }
    public function getID(){
        $this->ID;
    }

    //functions required (user checking database)
}
