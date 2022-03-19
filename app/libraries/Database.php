<?php
class Database{
    private $host = DATABASEHOST;
    private $user = DATABASEUSER;
    private $password = DATABASEPASSWORD;
    private $dbname = DATABASENAME;

    private $connection;
    private $statement;
    private $result;

    public function __construct(){
        $this->connection = new mysqli($this->host, $this->user, $this->password,$this->dbname);
        if(!$this->connection)
            $this->triggerError($this->connection->error);
        

        $this->statement = "CREATE DATABASE IF NOT EXISTS expensify;";
        $this->execute();
        
    }

    //SQL STATEMENTS
    public function select($selected,$tbname,$condition = 1){
        $this->statement = "SELECT $selected FROM $tbname WHERE $condition";
        $this->execute();
    }
    public function insert($tbname,$selected,$values){
        $this->statement = "INSERT INTO $tbname($selected) VALUES($values)";
        $this->execute();
    }
    public function update($tbname,$values,$condition = 1){
        $this->statement = "UPDATE $tbname SET $values WHERE $condition";
        $this->execute();
    }
    public function delete($tbname,$condition = 1){
        $this->statement = "DELETE FROM $tbname WHERE $condition";
        $this->execute();
    }

    //SQL STATEMENTS EXECUTION
    public function execute(){
        $this->result = $this->connection->query($this->statement) or die($this->triggerError($this->connection->error));
        return $this->result->fetch_assoc();
    }

    //ERROR HANDLING
    public function triggerError($errorstmt){
        return $errorstmt;
    }
}

//NOTES
//  CLASSES AND DATABASE BRAINSTORMING
/*


1. Customer can order a product. Orders Database required.
2. Products list must come from the manager from the database.
3. Each customer have his/her own profile. Manager and Admin required. User Database required.
4. Each customer can track their delivery. Delivery Database required.



    Classes Table ---------------------------------------------------------------------

     /  Class Name  /                            Description                     /
     /     user     / Contains all users of the application                      /
     /    Orders    / Contains ordered products by customers                     /
     /    Cart      / Products selected by customer                              /
     /  Customer    / Contains basic data of the customer                        /
     / Adminstrator / Contains basic data for each admin                         /
     /    Manager   / Contains basic information about the manager               /
     /   Delivery   / A child to orders contains the information of the delivery /
     /   Product    / An object for each product with its basic information      /


    Classes Details ----------------------------------------------------------------
    **ghourab
    |---------------|   
    |               |   -----------------------CLASS ATTRIBUTES--------------------                       
    |               |   1. First Name - Last Name           2. Email Address
    |     USER      |   3. Password                         4. Phone Number
    |               |   5. Role                             6. userID
    |               |   -----------------------CLASS METHODS-----------------------
    |---------------|   1. Getters & Setters                2. User checking Database
                        
**Hady
    |----------------|   -----------------------CLASS Attributes--------------------
    |                |   1. extends user data*               2. Home Address
    |                |   3. cart object                      4. Orders objects
    |    Customer    |   -----------------------CLASS METHODS--------------------------
    |                |   1. Getters & Setters                2. Order operations
    |                |   3. Cart Operations                  4. Delivery Tracking
    |----------------|   

        *DELETED*
    |----------------|  1. extends user data*               [TODO]***TO BE DECIDED*** 
    |  Adminstrator  |
    |----------------|


    |---------------|   1. extends user data*               [TODO]***TO BE DECIDED***
    |    Manager    |
    |---------------|

**YAsser
    |---------------|   ---------------------CLASS ATTRIBUTES-----------------
    |               |   1. Product Name                     2. Product Cost
    |               |   3. Product Description              4. Product Stock
    |    Product    |   5. Product Size                     6. Product ID
    |               |   ---------------------CLASS METHODS--------------------
    |               |   1. Getters & Setters                2. Stock Operations
    |---------------|   3. Size/quantity operations         4. cost operations


    |----------------|  ---------------------CLASS ATTRIBUTES--------------------
    |                |  1. extends Customer data*           2. Cart ID
    |                |  3. Cart array of products           4. Cart Price 
    |      Cart      |  5. Cart Quantity                    6. Cart Price with Delivery
    |                |  ---------------------CLASS METHODS-----------------------
    |                |  1. Getters & Setters                2.Cart cookies operations
    |----------------|  3. cart product Operations          4.Cost Operations

**YAsser
    |---------------|   1. Order ID                         2. Cart ID
    |     Order     |   3. Customer ID                      4. Order total price with Delivery
    |---------------|   [TODO]*** TO BE DECIDED ***

**Hady
    |----------------|  1. Order ID                         2. CustomerID
    |    Delivery    |  3. Customer Address                 4. Delivery Price
    |----------------|  5. Delivery Status                  [TODO]*** TO BE DECIDED ***

*/