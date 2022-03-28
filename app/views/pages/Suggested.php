<?php

class Suggested extends View{
    public function output(){
        $title = $this->model->title;
        require_once APPROOT . "/views/inc/header.php";
        ?>
        <html lang>
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Suggested form</title>
        <link rel="stylesheet" href="<?php echo URLROOT. "css/SuggestedStyle.css" ?>">
        </head>
        <body>
        <div class="container">
            <h2 class="title">
                <span class="title-word title-word-1">Your</span>
                <span class="title-word title-word-2">Opinion</span>
                <span class="title-word title-word-3">Matters</span>
            </h2>
        </div>
        </body>
        </html>
        <?php
    }
}
?> 