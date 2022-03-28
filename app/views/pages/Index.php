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
                    <a href = "#down"><i class="fas fa-chevron-down fa-lg"></i></a>
                </div>

                <div class = "bgBody2">
                    <div class= "grid">
                        <div class = "grid-child-left">
                    <h2 >About us<br></h2>
                    <p >We, in Tim Raw Honey produce and sell premium High Quality Raw Honey. Many people search for high quality raw honey and everyone has his/her own reasons.
Accordingly, here we offer this type of honey product for you!
Try & Enjoy</p>
                </div>
                <div class = "grid-child-right">
                <img src = "<?php echo IMAGEROOT . 'Honey.jpg';?>"/>
                    </div>
                </div>

                <div class= "grid">
                        <div class = "grid-child-left">
                        <img src = "<?php echo IMAGEROOT . 'Honey2.jpg';?>"/>
                </div>
                <div class = "grid-child-right">
                <h2>Start shopping<br></h2>
                    <p >Pure natural domestic Premium Raw Honey From the best fields right to our customers' who value the real natural taste and aroma.</p>
                    <div class="fa-3x">
                    <a href = "#"><i class="fa-solid fa-shop fa-bounce"></i></a>
                    </div>
                </div>
                </div>

                

     

                

                

                <div id="down">
    <h1>You are down!</h1>
  </div>
  

            </body>
            

            </html>
        <?php
    }
}
?>