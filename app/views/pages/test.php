<?php

class Test extends View{
    public function output(){
        $text = <<<EOT
        <h1>Test</h1>
        <p> To validate that the mvc is working</p>
EOT;
    echo $text;
    }
}