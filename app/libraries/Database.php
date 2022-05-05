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
        

        $this->createOrderItemsTable();
        $this->createUserTable();
        $this->createProductTable();
        $this->createOrderTable();
        $this->createDeliveryTable();
        $this->createSurveyTable();
        $this->createReviewTable();
        $this->createErrorTable();
        $this->createOffersTable();
        $this->createPromoCodesTable();
        $this->createWishListTable();
    }
    //FUNCTIONS
    public function createDatabase(){
        $this->statement = "CREATE DATABASE IF NOT EXISTS timsrawhoney;";
        // $this->exec("CREATE DATABASE IF NOT EXISTS timsrawhoney;");
        $this->execute(0);
    }
    public function createUserTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS users(
            ID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            fullName VARCHAR(30),
            email VARCHAR(128),
            pswrd VARCHAR(64),
            phoneNumber1 VARCHAR(30),
            phoneNumber2 VARCHAR(30),
            userRole VARCHAR(30),
            homeAddress1 VARCHAR(255),
            homeAddress2 VARCHAR(255)
            )";
        $this->execute(0);
    }
    public function createProductTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS products(
            ID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            productName VARCHAR(30),
            retailCost INT(10) NOT NULL,
            manifactureCost INT(10) NOT NULL,
            productStock INT(10) NOT NULL,
            productImage VARCHAR(124) NOT NULL,
            productDescription VARCHAR(255) NOT NULL
        )";
        $this->execute(0);
    }
    public function createOrderTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS orders(
            ID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            customerID INT(6) NOT NULL,
            quantity INT(10) NOT NULL,
            promocodeid INT(10),
            orderTotalPrice INT(10) NOT NULL,
            createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (customerID) REFERENCES users(ID),
            FOREIGN KEY (promocodeid) REFERENCES promocodes(promoID)
        )";
        $this->execute(0);
    }
    public function createOrderItemsTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS orderItems(
            orderID INT(6) NOT NULL,
            customerID INT(6) NOT NULL,
            productID INT(10) NOT NULL,
            productPrice INT(10) NOT NULL,
            createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (customerID) REFERENCES users(ID),
            FOREIGN KEY (orderID) REFERENCES orders(ID),
            FOREIGN KEY (productID) REFERENCES products(ID)
        )";
        $this->execute(0);
    }
    public function createDeliveryTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS deliveries(
            deliveryID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            orderID INT(6) NOT NULL,
            deliveryPrice INT(10) NOT NULL,
            deliveryStatus VARCHAR(30),
            deliveryLink VARCHAR(30),
            FOREIGN KEY (orderID) REFERENCES orders(ID) 
            )";
            $this->execute(0);
    }
    public function createSurveyTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS survey(
            surveyID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            customerID INT(6) NOT NULL,
            FOREIGN KEY (customerID) REFERENCES users(ID)
        )";
        $this->execute(0);
    }
    public function createReviewTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS review(
            reviewID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            customerID INT(6) NOT NULL,
            productID INT(6) NOT NULL,
            stars INT(10) NOT NULL,
            reviewText VARCHAR(255),
            createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (customerID) REFERENCES users(ID),
            FOREIGN KEY (productID) REFERENCES products(ID)
        )";
        $this->execute(0);
    }
    public function createErrorTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS error(
            errorID INT(10) NOT NULL,
            errorMessage VARCHAR(255)
        )";
        $this->execute(0);
    }
    public function createOffersTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS offers(
            offerID INT(10) NOT NULL PRIMARY KEY,
            productID INT(10) NOT NULL,
            offerPercentage INT(10) NOT NULL,
            offerTitle VARCHAR(15) NOT NULL,
            campaignLength VARCHAR(30) NOT NULL,
            createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (productID) REFERENCES products(ID)
            
        )";
        $this->execute(0);
    }
    public function createPromoCodesTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS promoCodes(
            promoID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            promoCode VARCHAR(30) NOT NULL,
            promoValue VARCHAR(10) NOT NULL,
            promoLength VARCHAR(10) NOT NULL,
            active INT(10) NOT NULL,
            createdAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        )";
        $this->execute(0);
    }
    public function createWishListTable(){
        $this->statement = "CREATE TABLE IF NOT EXISTS wishList(
            wishListID INT(6) AUTO_INCREMENT NOT NULL PRIMARY KEY,
            customerID INT(6) NOT NULL,
            productID INT(6) NOT NULL,
            FOREIGN KEY (customerID) REFERENCES users(ID),
            FOREIGN KEY (productID) REFERENCES products(ID)
        )";
        $this->execute(0);
    }
    //SQL STATEMENTS
    public function query($query){
        $this->statement = $query;
        $res = $this->connection->query($this->statement);
        return $res;
    }
    public function select($selected,$tbname,$condition = 1){ //MUST RETURN VALUE//
        // $this->connection = new mysqli($this->host, $this->user, $this->password,$this->dbname);
        // $this->statement = "SELECT $selected FROM $tbname WHERE $condition";
        // $conn = new mysqli($this->host, $this->user, $this->password,$this->dbname);
        $this->statement = "SELECT * FROM `users` WHERE 1";
        $this->connection->query($this->statement) or die('error');
        // $this->execute(0) or die("error1");
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
    public function execute($result = 0){
        $this->result = $this->connection->query($this->statement);
        // if(!$this->result){
        //     echo $this->triggerError($this->connection->error);
        //     echo "<script>alert('error')</script>";
        // }
        if($result === 1)
            return $this->result->fetch_assoc();
    }
    public function exec($statement,$result = 0){
        $this->result = $this->connection->query($statement);
        if($result === 1)
            return $this->result->fetch_assoc();
    }

    //ERROR HANDLING
    public function triggerError($errorstmt){
        return $this->connection->error;
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
    cart product operations:

**YAsser
    |---------------|   1. Order ID                         2. Cart ID
    |     Order     |   3. Customer ID                      4. Order total price with Delivery
    |---------------|   [TODO]*** TO BE DECIDED ***

**Hady
    |----------------|  1. Order ID                         2. CustomerID
    |    Delivery    |  3. Customer Address                 4. Delivery Price
    |----------------|  5. Delivery Status                  [TODO]*** TO BE DECIDED ***

*/