<?php

class profile extends View{
    public function output(){
        $title = $this->model->title;
        $css = $this->model->css;
        $icon = $this->model->icon;
        $profileModel = $this->model;
        $profileData = $profileModel->getUserData($_SESSION['ID']);
        $pendingOrders = $profileModel->getPendingOrders($_SESSION['ID']);
        $deliveredOrders = $profileModel->getDeliveredOrders($_SESSION['ID']);


        require_once APPROOT . "/views/inc/header.php";
        ?>
            <link rel="stylesheet" href="<?php echo $css ; ?>"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
            <div class="mainContainer">
                <div class="navChild">
                    <button id = "personal" class = "myButton margin-bottom selected"><i class="fas fa-user-alt"></i><br>Personal Information</button><br>
                    <button id = "security" class = "myButton margin-bottom"><i class="fas fa-lock"></i><br>Security</button><br>
                    <button id = "orders" class = "myButton margin-bottom"><i class="fas fa-receipt"></i><br>My Orders</button><br>
                    <button id = "address" class = "myButton margin-bottom"><i class="fas fa-address-card"></i><br>My Address Book</button><br>
                    <button id = "delete" class = "myButton"><i class="fas fa-trash"></i><br>Delete Account</button>
                </div>
                <div class="mainChild">
                    <div class="personal">
                        <h1 class = "header">Personal information</h1>
                        <hr class = "headerSeparator">
                        <form action="" method="post">
                            <p>
                            First Name:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "fname" value = "<?php echo $profileData['fname']; ?>"><br><br>
                            Last Name:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "lname" value = "<?php echo $profileData['lname']; ?>"><br><br>
                            Phone Number 1:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "phone1" value = "<?php echo $profileData['phoneNumber1']; ?>"><br><br>
                            Alternative Phone Number:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "phone2" value = "<?php echo $profileData['phoneNumber2']; ?>"><br><br>
                            </p>
                            <button class = "submitButton" type="submit" name = "submitPersonal">UPDATE</button>
                        </form>
                    </div>
                    <div class="security">
                        <h1 class = "header">Security</h1>
                        <hr class = "headerSeparator">
                        <form action="" method="post">
                            <p>
                            Email:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "email" value = "<?php echo $profileData['email']; ?>"><br><br>
                            Enter current password:&nbsp;&nbsp;&nbsp;
                            <input type="password" name = "password" placeholder = "Enter your old password" ><br><br>
                            Enter new password:&nbsp;&nbsp;&nbsp;
                            <input type="password" name = "newPassword" placeholder = "Enter new password" ><br><br>
                            Confirm New Password:&nbsp;&nbsp;&nbsp;
                            <input type="password" name = "confirmNewPassword" placeholder = "Confirm Your Password"><br><br>
                        </p>
                            <button class = "submitButton" type="submit" name = "submitSecurity">UPDATE</button>
                        </form>
                    </div>
                    <div class="orders">
                        <h1 class = "header">My Orders</h1>
                        <hr class = "headerSeparator">
                        <h3 class = header>Pending Orders</h3>
                        <div class="gridView">
                            <?php 
                            if(count($pendingOrders) === 0){
                                echo "<h6>No Pending Orders</h6>";
                            }
                            else
                                foreach($pendingOrders as $order){
                                    echo "
                                    <div class='gridCard'>
                                    <h5>Order Serial: <strong>{$order['ID']}</strong></h5>
                                    <hr>
                                    <p>Order Total Price: <strong>{$order['orderTotalPrice']} EGP</strong></p>
                                    <p>Order Items: <strong>{$order['quantity']} items</strong></p>
                                    <p>Order status: <strong>PENDING</strong></p>
                                    <p>Order Date: <strong>{$order['createdAt']}</strong></p>
                                    <form method='post' action = ''>
                                    <button type = 'submit' name = 'viewOrder' value = '{$order['ID']}'>View Order</button>
                                    </form>
                                    </div>
                                    ";
                                } ?>
                            
                        </div>
                        <br>
                        <h3 class = header>Delivered Orders</h3>
                        <div class="gridView">
                        <?php 
                            if(count($deliveredOrders) === 0){
                                echo "<h6>No Previous Delivered Orders</h6>";
                            }
                            else
                                foreach($deliveredOrders as $order){
                                    echo "
                                    <div class='gridCard'>
                                    <h5>Order Serial: <strong>{$order['ID']}</strong></h5>
                                    <hr>
                                    <p>Order Total Price: <strong>{$order['orderTotalPrice']} EGP</strong></p>
                                    <p>Order Items: <strong>{$order['quantity']} items</strong></p>
                                    <p>Order status: <strong>PENDING</strong></p>
                                    <p>Order Date: <strong>{$order['createdAt']}</strong></p>
                                    <form method='post' action = ''>
                                    <button type = 'submit' name = 'viewOrder' value = '{$order['ID']}'>View Order</button>
                                    </form>
                                    </div>
                                    ";
                                } ?>
                        </div>
                    </div>
                    <div class="address">
                        <h1 class = "header">My Address Book</h1>
                        <hr class = "headerSeparator">
                        <form action="" method="post">
                            <h5 class = "header">Main Address:</h5>
                            <p>
                            Address:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "address" value = "<?php echo $profileData['homeAddress1']; ?>"><br><br>
                            </p>
                            <h5 class="header">Alternative Address:</h5>
                            <p>
                            Address:&nbsp;&nbsp;&nbsp;
                            <input type="text" name = "address2" value = "<?php echo $profileData['homeAddress2']; ?>"><br><br>
                            </p>
                            <button class = "submitButton" type="submit" name = "submitAddress">UPDATE</button>
                        </form>
                    </div>
                    <div class="delete">
                        <h1 class = "header">Delete Account</h1>
                        <hr class = "headerSeparator">
                        <h5>Are you sure you want to delete this account. Please Note that the account will permanently be <span style = "color: red">DELETED</span>.</h5>
                        <form action="" method="post">
                            <button class = "deleteButton" type="submit" name = "submitDelete">DELETE MY ACCOUNT</button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function(){
                    count = 0;
                $("#personal").click(function(){
                    
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".personal").css("display", "block");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").addClass("selected");

                })
                $("#security").click(function(){
                    $(".personal").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".security").css("display", "block");
                    $("#security").addClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#orders").click(function(){
                    $(".personal").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "block");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").addClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#address").click(function(){
                    $(".delete").css("display", "none");
                    $(".personal").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "block");
                    $("#security").removeClass("selected");
                    $("#address").addClass("selected");
                    $("#delete").removeClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                $("#delete").click(function(){
                    $(".personal").css("display", "none");
                    $(".security").css("display", "none");
                    $(".orders").css("display", "none");
                    $(".address").css("display", "none");
                    $(".delete").css("display", "block");
                    $("#security").removeClass("selected");
                    $("#address").removeClass("selected");
                    $("#delete").addClass("selected");
                    $("#orders").removeClass("selected");
                    $("#personal").removeClass("selected");
                })
                
                    
                });
            </script>
        <?php
    }
}