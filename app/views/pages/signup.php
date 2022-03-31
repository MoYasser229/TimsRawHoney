<?php
class signup extends View{
    public function output(){
        $title = $this->model->title;
         require_once APPROOT . "/views/inc/header.php";
         $text = <<<EOT
         <div class="jumbotron jumbotron-fluid">
         <div class="container">
           <h1 class="display-4"> $title</h1>
         </div>
       </div>
     
       </div>
       </div>
       </div>
     EOT;
         echo $text;
    }
}
?>