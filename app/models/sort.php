<?php
class Sort{
    private $search,$sortItems,$table,$searchColumns,$filter;
    protected $database;
    public function __construct($table,$searchColumns = array()){
        $this->table = $table;
        $this->database = new Database;
        $this->searchColumns = $searchColumns;
    }
    public function setSearch($search){
        $this->search = $search;
    }
    public function search($group = ""){
        $col = $this->searchColumns();
        $result = $this->database->query("SELECT * FROM {$this->table} WHERE $col $group");
        return $result;
    }
    public function searchColumns(){
        $col = "";
        foreach($this->searchColumns as $searchcol){
            $col .= "$searchcol LIKE '%{$this->search}%' OR ";
        }
        $col = substr($col,0,strlen($col)-3);
        return $col;
    }
    public function setSort($type,$filter){
        $this->sortItems = $type;
        $this->filter = $filter;
    }
    public function filter($selection = "*",$group = "",$condition = ""){
        //SELECT DISTINCT * FROM orders,users WHERE orders.customerID = users.ID ORDER BY orders.orderTotalPrice ASC
        // echo "SELECT $selection FROM {$this->table} $condition $group ORDER BY {$this->sortItems} {$this->filter}";
        $result = $this->database->query("SELECT $selection FROM {$this->table} $group ORDER BY {$this->sortItems} {$this->filter}");
        return $result;
    }

}

?>