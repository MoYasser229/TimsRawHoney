<?php

class shop extends View{
    public function output(){
        $title = $this->model->title;
        require_once APPROOT . "/views/inc/header.php";
        ?>
        <html lang>
        <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop</title>
        <link rel="stylesheet" href="<?php echo URLROOT. "css/shopStyle.css" ?>">
        <link rel="stylesheet" href="<?php echo URLROOT. "css/SearchStyle.css" ?>">
        </head>
        <body>
        
        <div class="search__container">
             <input class="search__input" type="text" placeholder="Search">
        </div>

        <div class = "container">
                <div class = "box">
                    <p class="slider"></p>
                    <p class="Honey">Dandelion  Honey</p>
                    <img src = "<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">   
                </div>

                <div class = "box">
                    <p class="slider"></p>
                    <p class="Honey">Sourwood Honey</p>
                    <img src = "<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">   
                </div>

                <div class = "box">
                    <p class="slider"></p>
                    <p class="Honey">Eucalyptus  Honey</p>
                    <img src = "<?php echo IMAGEROOT . "img_2.jpg"; ?>"class ="model">   
                </div>         
        </body>
        </html>
        <?php
    }
}
?>  