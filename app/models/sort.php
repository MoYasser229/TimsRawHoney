<?php
class Sort{
    private $search,$sortItems,$table,$searchColumns;
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

}

?>