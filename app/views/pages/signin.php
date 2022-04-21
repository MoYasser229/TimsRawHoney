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
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        </head>
        <body>
        <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=1921176278089033&autoLogAppEvents=1" nonce="g2XAyTi6"></script>
        <div class="container" id="container">
	<div class="form-container sign-in-container">
		<form action="" onsubmit = "validate()" method = "POST">
			<h1>Sign in</h1>
			<div class="social-container">
      
				<!-- <a href="#" class="social link" onclick="checkLoginState()"><i class="fab fa-facebook-f"></i></a> -->
				<a href="#" class="social link" onclick="checkLoginState()"><i class="fab fa-facebook-f"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign In with Facebook</a>
      </div>
			<span><div id="status"></div> or use your account  </span>
			<input id = "emailText" type="email" placeholder="Email" name = "email"/>
      <div id="email" class = "warning"><?php echo $this->model->getErrorEmail(); ?></div>
			<input id = "passwordText" type="password" placeholder="Password" name = "password"/>
			<div id="password" class = "warning"><?php echo $this->model->getErrorPassword(); ?></div>
      <br>
      <button >Sign In</button>
		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay" style = "background-image: url('<?php echo IMAGEROOT . "bg-signin.jpg   " ?>')">
			<div class="overlay-panel overlay-right">
				<h1>Want To Sign Up?</h1>
				<p>Click the button below to sign up</p>
				<button class="ghost" id="signUp" onclick = "window.location.replace('<?php echo URLROOT . 'pages/signup'; ?>')">Sign Up</button>
			</div>
		</div>
	</div>
</div>
        </body>
        
<script>
  function validate(){
    emailValue = $('#emailText').val
    passwordValue = $('#passwordText').val
    if(emailValue == ""){
      $("#emailError").html = "Please Enter an email. REQUIRED*"
      alert('error')
    }
    if(passwordValue == ""){
      $("#password").html = "Please Enter an password. REQUIRED*"
    }
  }
    function statusChangeCallback(response) {
                if (response.status === 'connected') {
                    FB.api('/me',{ locale: 'en_US', fields: 'name, email' }, function (response) {
                        console.log('Successful login for: ' + response.email);
                        $.post("",{id: "signin" , email: response.email}).done((data) =>{
                          if(data != "false")
                            window.location.replace(data)
                          else{
                            document.getElementById('status').innerHTML = "This facebook account is not link to any account here sign up please.<br><br>"
                          }
                        })
                    });
                } else {
                    // The person is not logged into your app or we are unable to tell.
                    document.getElementById('status').innerHTML = 'Please log ' +
                      'into this app.';
                }
            }
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1921176278089033',
      cookie     : true,
      xfbml      : true,
      version    : 'v13.0'
    });
      
    FB.AppEvents.logPageView();   
    
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
    function checkLoginState() {
      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
        // alert(response.name);
      });
    }
</script>

<?php
  
}
}
?>