<?php
class security{
    public function checkID(){
        if(!isset($_SESSION['ID'])){
            redirect('pages/index');
        }
        return true;
    }
    public function checkDb($database){
        $result = $database->query("SELECT * FROM users WHERE ID = '{$_SESSION['ID']}' AND userRole = 'ADMIN'");
        if(mysqli_num_rows($result) == 0){
            redirect('pages/index');
        }
        return true;
    }
}