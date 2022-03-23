<?php

class Index extends View{
    public function output(){
        $title = $this->model->title;
        require_once APPROOT . "/views/inc/header.php";
        //         $text = <<<EOT
                
        // EOT;
        //         echo $text . "<a href = '".URLROOT."pages/test'>Click me</a>";
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
                <title>Tim's Raw Honey</title>
            </head>
            <body>
                <div class="bgBody">
                    <img src = "<?php echo IMAGEROOT . 'na7la1.png' ; ?>"/>    
                    <h1 class = "alignmentText">Tim's Raw Honey<br><span class = 'subtitle'>As it exists in the beehive</span></h1>
                    <a href = ""><i class="fas fa-chevron-down fa-lg"></i></a>
                </div>
            </body>
            </html>
        <?php
    }
}
?>