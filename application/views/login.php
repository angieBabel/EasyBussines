<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <base href="<?php echo base_url();?>">
    <title>Login/Sign-In</title>


    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/stylelogin.css">


  </head>

  <body>
<div class="login-box">
    <div class="lb-header">
      <h1 id="login-box-link">Log in</h1>
    </div>
    <div class="social-login">
      <a href="#">
        <i class="fa fa-facebook fa-lg"></i>
        Login in with facebook
      </a>
      <a href="#">
        <i class="fa fa-google-plus fa-lg"></i>
        log in with Google
      </a>
    </div>
    <form class="email-login" action="index.php/welcome/panel">
      <div class="u-form-group">
        <input type="email" placeholder="Email"/>
      </div>
      <div class="u-form-group">
        <input type="password" placeholder="Password"/>
      </div>
      <div class="u-form-group">
        <button type="submit">Log in</button>
      </div>
      <div class="u-form-group">
        <a href="#" class="forgot-password">Forgot password?</a>
      </div>
    </form>

  </div>


  </body>
</html>
