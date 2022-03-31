<?php
class signin extends View{
    public function output(){
        $title = $this->model->title;
        $icon = $this->model->icon;
        $css = $this->model->css;
        require_once APPROOT . "/views/inc/header.php";
        ?>
        <head>
          <link rel="stylesheet" href="<?php echo $css; ?>"/>
        </head>
        <body>
    
        <div class="form">
            <form action="" method="post">
            <h1>Sign In</h1>
              <h3>Email</h3>
              <input type="text" name="email" placeholder="Enter your email address" required><br><br>
              <h3>Password</h3>
              <input type="password" name="password" placeholder="Enter Your Password" required><br><br>
              <input type="submit" name="submit" value="submit">
            </form>
        </div>
        </body>

<?php
  
}
}
?>