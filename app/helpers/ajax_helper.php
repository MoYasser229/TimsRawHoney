<?php
if($_POST['id'] === "signin"){
    $email = $_POST['email'];
    
    $model = new signinModel();
    $result = $model->facebookSignIn($email);
    if(!$result){
        echo "No account linked with this facebook account";
    }
}