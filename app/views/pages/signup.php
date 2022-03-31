<?php
class signup extends View{
    public function output(){
        $title = $this->model->title;
        $css = $this->model->css;
        $icon = $this->model->icon;
         require_once APPROOT . "/views/inc/header.php";
         ?>
            <link rel="stylesheet" href="<?php echo $css;?>"/>
            <body>
             
                <div class="form">
                <h1>Register</h1>
                <form action="" method = "POST">
                  First Name: <br>
                  <input type="text" name = "fname"><br>
                  Last Name: <br>
                  <input type="text" name = "lname"><br>
                  Email: <br>
                  <input type="text" name = "email"><br>
                  Password: <br>
                  <input type="password" name = "password"><br>
                  Phone Number 1: <br>
                  <input type="text" name = "phoneNumber1"><br>
                  Phone Number 2: <br>
                  <input type="text" name = "phoneNumber2"><br>
                  Home Address 1: <br>
                  <input type="text" name = "homeAddress1"><br>
                  Home Address 2: <br>
                  <input type="text" name = "homeAddress2"><br><br>
                  <input type="submit" name="submit">
                  <h3>Already have account ? <a class="aclk" href="#">Click here!</a></h3>
                </form>
    </div>
           
            </body>
         <?php
    }
}
?>