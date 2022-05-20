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
                <link rel="stylesheet" href="<?php echo URLROOT . 'css/indexStyle.css'; ?>">
                <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
                <title>Tim's Raw Honey</title>
            </head>
            <body>
      

                <div class="bgBody">
                    <img src = "<?php echo IMAGEROOT . 'na7la1.png' ; ?>"/>    
                    <h1 class = "alignmentText">Tim's Raw Honey<br><span class = 'subtitle'>As it exists in the beehive</span></h1>
                    <a href = "#down"><i class="fas fa-chevron-down fa-lg"></i></a>
                </div>

                <!--Griglia alternata testo e immagine, resposive con flexbox.-->
<section>
  <div class="grid-flex">
    <div class="col col-image" style="background-image: url(https://scontent.faly3-1.fna.fbcdn.net/v/t1.6435-9/117899897_2708271302760225_8116209010189839187_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=e3f864&_nc_ohc=w99LW7gz9J0AX8M6uJy&_nc_ht=scontent.faly3-1.fna&oh=00_AT-Duy5tGvB1K9TRmDG3q1BwflpB_fu_LjgxmXcXcXXlKg&oe=62AE8E10);">
    </div>
    <div class="col col-text">
      <div class="Aligner-item">
      <h2 >About us<br></h2>
                    <p >We, in Tim Raw Honey produce and sell premium High Quality Raw Honey. Many people search for high quality raw honey and everyone has his/her own reasons.
Accordingly, here we offer this type of honey product for you!
Try & Enjoy</p>
      </div>
    </div>
  </div>
  
  <div class="grid-flex">
    <div class="col col-image" style="background-image: url(https://scontent.faly3-1.fna.fbcdn.net/v/t1.6435-9/196510016_2939905546263465_2451703053349340914_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=Y6JyPCM2vKkAX_mlIrO&_nc_oc=AQkvk4XKsi9GcHmQvDxVC8iDq69pgm1QvXs8RBcQW14QWPd_WoTieziQvw6T1XLuPtk&_nc_ht=scontent.faly3-1.fna&oh=00_AT84SlxV_TSzDbLbQDOj92IgKVUi2DcGj8FR4bqLXITiWQ&oe=62ABD26C);">
      &nbsp;
    </div>
    <div class="col col-text col-left">
      <div class="Aligner-item">
      <h2>Start shopping<br></h2>
                    <p >Pure natural domestic Premium Raw Honey From the best fields right to our customers' who value the real natural taste and aroma.</p>
                    <div class="fa-3x">
                    <a href = "<?php echo URLROOT.'pages/Shop' ?>"><i class="fa-solid fa-shop fa-bounce" style="color:#EBA937"></i></a>
                    </div>
      </div>
    </div>
  </div>
                



  

            </body>
        
            </html>
        
        <?php
        require_once APPROOT . "/views/inc/Footer.php";
        
    }
}
?>
