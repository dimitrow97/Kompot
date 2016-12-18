<?php
    require_once('session.php');
    require_once('User.php');
    require_once('CredentialValidator.php');
    require_once('PendingUser.php');
    
    $session = new session();
    $session::checkLogin();
    $session::isTuneAwaiting();


    if(isset($_POST['btn-submit']))
    {
        
       #DB Prerequisits
       $name = $_POST['name'];
       $password = $_POST['password'];
       $confirmPassword = $_POST['confirmPassword'];
       $email = $_POST['email'];
       $confirmEmail = $_POST['confirmEmail'];
        
       $user = new User($email,$password,$name,$confirmEmail,$confirmPassword);   
       
       $credentials = new CredentialValidator($user);    
       #TODO: Complete CredentialValidatior Class
       $nameCallBack = $credentials->isNameValid();
       $passwordCallBack = $credentials->isPasswordValid();
       $emailCallBack = $credentials->isEmailValid();
        

       if(!$emailCallBack['hasError'] && !$passwordCallBack['hasError'] && !$nameCallBack['hasError']){
               
            $pendingUser = new PendingUser($user);
            $pendingUser->initiateRegisterRequest();
        
            $errType = "success";
            $errorMessage = "Successfully registered, you may log-in";
            
            #Collecting the Garbage
            unset($name);
            unset($email);
            unset($password);
            unset($user);
               
            //header("Location: ../../index.php");
            //exit;
               
        }else {
               
            $errType = "danger";
            $errMessage = "Something went wrong, try again later ...";
               
        }
           
       }
       
    

?>


    <!DOCTYPE html>
    <!--Kompot Website-->

    <html lang="en">


    <head>

        <meta charset="utf-8" />
        <meta name="Registeration" content="Register Form" />
        <meta name="google" content="nositelinkssearchbox" />
        <meta name="google" content="notranslate" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title>Register Test</title>

        
        <link type="text/css" rel="stylesheet" href="../css/registerpage.css">
        <link type="text/css" rel="stylesheet" href="../css/index.css">
   

        <script type="text/jscript" href="../scripts/bootstrap.js"></script>
        <script type="text/jscript" href="../scripts/jquery-3.1.1.js"></script>

    </head>

    <body>
<header></header>
       <main>
        <div id="snow"></div>
    
    <div class="wrapper">
	<div class="container">
		<h1>Register</h1>
		
		<form class="form" method="post" action="register.php" autocomplete="off">
			 <input  pattern="^[a-z0-9_-]{6,16}$" id="user_name" placeholder="User Name" name="name"  type ="text" required>
			<input type ="email"  pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_email" placeholder="Email" name="email" required>
           <input type ="email"  pattern="^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$" id="user_emailConfirm" placeholder="Confirm Email" name="confirmEmail"  required  >
          <input  type ="password"  pattern="^[a-zA-Z0-9_-]{6,16}$" id="user_password" placeholder="Password" name="password" required >
            <input  type ="password"  pattern="^[a-zA-Z0-9_-]{6,16}$" id="user_password_confirm" placeholder="Confirm Password" name="confirmPassword" required >

            <button type="submit" id="NQMA TAKOVA OBOBOBO" name="btn-submit">Register</button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
           </main> 
        <div class="dark-footer">
     <footer class="footer-wrapper bottom-footer">
                <div class="footer">
                    <div class="social-links">
                        <div class="center">
                            <div class="inner-center">
                                <button class="button-fb" onclick="location.href='https://www.facebook.com/trueslavs/'" type="button">&nbsp; FACEBOOK
                                </button>
                            </div>
                        </div>
                    </div>
                    <p class="links"><a href="Blog/web/aboutUs.html">About Us</a> | <a href="#">Music</a> | <a href="Blog/web/policy.html">Privacy Policy</a>| <a href="Blog/web/contact.html">Contact</a>| <a href="http://adidas.com">Adidas</a></p>
                    <p class="copyright">&copy; 2042 Kompot of Rhytms. All rights reserved. Made with Suka by TRUE SLAVS |||</p>
                    <p class="copyright">We do not own any of the rights regarding the music we post. It's only for entertainment purposes! True Slavs |||</p>
                </div>
            </footer>
    
    </div>
  
    </body>
    
    <script>
    
        
        $('#user_email').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_emailConfirm').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_password').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        $('#user_password_confirm').bind("cut copy paste",function(e) {
                e.preventDefault();
         });
        
        
    </script>

    </html>
