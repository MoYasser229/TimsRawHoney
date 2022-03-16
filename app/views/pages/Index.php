<?php

class Index extends View{
    public function output(){
        $title = $this->model->title;
        $text = <<<EOT
      <h1> $title </h1>
      <hr>
      <p>This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
EOT;
        echo $text;
    }
}