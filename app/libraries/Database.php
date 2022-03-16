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