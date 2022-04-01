<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT . 'css/HeaderStyle.css'; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $icon; ?>/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $icon; ?>favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $icon; ?>/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $icon; ?>/site.webmanifest">
    <link rel="mask-icon" href="<?php echo $icon; ?>/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    
    <title>Tims Raw Honey</title>
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light transparent" >
  <a class="navbar-brand" href="#"><img src = "<?php echo IMAGEROOT . "logo.png"; ?>" width = 150 height = 75></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?php if(isset($_SESSION['ID'])){
      ?>
          <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo URLROOT.'pages/index' ?>">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT.'pages/Shop' ?>">Shop</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT.'pages/Suggested' ?>"> Survey </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">AboutUs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT . 'pages/Cart'; ?>">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">ContactUs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT . 'pages/profile'?>">Profile</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URLROOT . 'pages/logout'?>">SignOut</a>
      </li>
    </ul>
      <?php
    } else{
      ?>
        <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="<?php echo URLROOT.'pages/index' ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT.'pages/Shop' ?>">Shop</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT.'pages/Suggested' ?>"> Suggested </a>
  
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">AboutUs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ContactUs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT . 'pages/signin'?>">SignIn</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT . 'pages/signup'?>">Register</a>
        </li>
      </ul>
      <?php
    }?>
    
  </div>
</nav>
</body>
</html>