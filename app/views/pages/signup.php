<?php
class signup extends View{
    public function output(){
        $title = $this->model->title;
        $css = $this->model->css;
        $icon = $this->model->icon;
         require_once APPROOT . "/views/inc/header.php";
         ?>
         
         <head>
           <link rel="stylesheet" href="<?php echo $css;?>"/>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
           <script type="text/javascript" src="<?php echo URLROOT . "json/regions.json" ;?>"></script>
        </head>
        <body>
        <script>
        function readTextFile(file,callback){
          var rawFile = new XMLHttpRequest()
          rawFile.overrideMimeType("application/json")
          rawFile.open("GET",file,true)
          rawFile.onreadystatechange = () => {
            if(rawFile.readyState === 4 && rawFile.status == "200"){
              callback(rawFile.responseText)
            }
          }
          rawFile.send(null)
        }
        readTextFile("<?php echo URLROOT . "json/regions.json" ;?>",(text) => {
          data = JSON.parse(text)
          data.forEach(function(city){
            console.log(city.city)
            option = `<option value=${city.city}>${city.city}</option>`
            $("#region").append(option)
          })
        })
      </script>
        <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=1921176278089033&autoLogAppEvents=1" nonce="g2XAyTi6"></script>
        <div class="container" id="container">
	
	<div class="form-container sign-in-container">
    
		<form id = "form" action="" method = "POST">
			<h1 class = regHeader>Create New Account</h1>
			<div class="social-container">
				<!-- <a href="#" class="social link" onclick="checkLoginState()"><i class="fab fa-facebook-f"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register with Facebook</a> -->
        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
        </fb:login-button>
      </div>
      <div id="email" class = "warning"><?php echo $this->model->getSocialError(); ?></div>
			<span><div id="status"></div> or manually register a new account  </span><br>
      <input class = mainSignUp type="text" name = "myName" placeholder = "Full Name"><div id="email" class = "warning"><?php echo $this->model->getErrorName(); ?></div></input>
			<input class = mainSignUp type="email" placeholder="Email" name = "email"/>
      <div id="email" class = "warning"><?php echo $this->model->getErrorEmail(); ?></div>
      
			<input class = colSignUp type="password" placeholder="Password" name = "password" autocomplete="off" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"/>
      
      <input class = colSignUp type="password" placeholder="Confirm your password" name = "confirmPassword" autocomplete="off" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"/>
      <div id="email" class = "warning"><?php echo $this->model->getErrorPassword(); ?></div>
      <div id="email" class = "warning"><?php echo $this->model->getErrorConfirmPassword(); ?></div>
      <div id="email" class = warning"><?php echo $this->model->getErrorConfirmation(); ?></div>
      <input class = "colSignUp" type="text" placeholder="Phone Number" name = "phone1"/>
      <input class = "colSignUp" type="text" placeholder = "Alternative Phone Number" name = "phone2"/>
      <div id="email" class="warning"><?php echo $this->model->getErrorPhone1(); ?></div>
      <div id="viewAddressForm">
        <input type="text" class="colSignUp" name="street" placeholder="Street Name"/>
        <select id="region" name="region"></select><br>
        <input type="text" class="colSignUp" name=district placeholder="District">
        <input type="text" class="colSignUp" name=landmark placeholder="Landmark"><br>
        <input type="text" class="colSignUp" name=building placeholder="Building Number">
        <input type="text" class="colSignUp" name=appNumber placeholder="Appartment Number">
        <div id="email" class="warning"><?php echo $this->model->getErrorAddress1(); ?></div>
      </div>
      
      <button type = submit name = regular>Register</button>
		</form>
    <form id = "socialForm" class = "hidden" action="" method = "POST">
      <h1>Welcome</h1>
      <span>Please continue the registration form.</span>
      <input class = "facebookData mainSignUp" type="text" name = "emailFacebook2" id = "emailFacebook" value = "<?php echo "FaceBook Email: " . $this->model->getEmail()?>" disabled />
      <input class = "facebookData mainSignUp" type="text" name = "myNameFacebook2" id = "name" value = "<?php echo "FaceBook Name: " . $this->model->getName()?>" disabled/>
      
      <input class = "facebookData mainSignUp" type="hidden" name = "emailFacebook" id = "emailFacebook2" />
      <input class = "facebookData mainSignUp" type="hidden" name = "myNameFacebook" id = "name2" />
      <hr>
      <input class = colSignUp type="password" placeholder = "Password" name = "password" autocomplete="off" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"/>
      <input class = colSignUp type="password" placeholder = "Confirm Password" name = "confirmPassword" autocomplete="off" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false"/>
      <div id="email" class = "warning"><?php echo $this->model->getErrorPassword(); ?></div>
      <div id="email" class = "warning"><?php echo $this->model->getErrorConfirmPassword(); ?></div>
      <div id="email" class = "warning"><?php echo $this->model->getErrorConfirmation(); ?></div>
      <input class = colSignUp type="text" placeholder="Phone Number" name = "phone1"/>
      <input class = colSignUp type="text" placeholder = "Alternative Phone Number" name = "phone2"/>
      <div id="email" class="warning"><?php echo $this->model->getErrorPhone1(); ?></div>
      <div id="viewAddressForm">
        <input type="text" class="colSignUp" name="street" placeholder="Street Name"/>
        <select id="region1" name="region"></select><br>
        <input type="text" class="colSignUp" name=district placeholder="District">
        <input type="text" class="colSignUp" name=landmark placeholder="Landmark"><br>
        <input type="text" class="colSignUp" name=building placeholder="Building Number">
        <input type="text" class="colSignUp" name=appNumber placeholder="Appartment Number">
        <div id="email" class="warning"><?php echo $this->model->getErrorAddress1(); ?></div>
      </div>
      <button type = submit name = "submitFacebook" value = "facebook">Sign In</button>
    </form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-right">
				<h1>Already Registered?</h1>
				<p>Click the button below to sign in</p>
				<button class="ghost" onclick = "window.location.replace('<?php echo URLROOT . 'pages/signin'; ?>')">Sign In</button>
			</div>
		</div>
	</div>
</div>
        </body>
        
<script>
    function statusChangeCallback(response) {
                if (response.status === 'connected') {
                    FB.api('/me',{ locale: 'en_US', fields: 'name, email' }, function (response) {
                        console.log('Successful login for: ' + response.email);
                        $.post("",{id: "signin" , email: response.email}).done((data) =>{
                          if(data != "false"){
                            $('#form').css('display', 'none')
                            $('#socialForm').css('display', 'block')
                            $('#emailFacebook').val('Facebook Email: ' + response.email);
                            $('#name').val('Facebook Name: ' + response.name);
                            $('#emailFacebook2').val(response.email)
                            $('#name2').val(response.name)
                            readTextFile("<?php echo URLROOT . "json/regions.json" ;?>",(text) => {
                            data = JSON.parse(text)
                            data.forEach(function(city){
                              option = `<option value=${city.city}>${city.city}</option>`
                              $("#region1").append(option)
                            })
                          })
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
           
            </body>
            
         <?php
    }
}
?>