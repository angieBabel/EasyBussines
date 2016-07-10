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
        <h1 id="login-box-link">Sign In</h1>
      </div>
      <div class="social-login">
        <a href="#">
          <i class="fa fa-facebook fa-lg"></i>
          Sign in with facebook
        </a>
        <a href="#">
          <i class="fa fa-google-plus fa-lg"></i>
          Sign in with Google
        </a>
      </div>
      <form class="email-login" action="index.php/uploader/signin" method="post">
        <div class="u-form-group">
          <input type="nombre" for="nombre" name="nombre" placeholder="Nombre"/>
        </div>
        <div class="u-form-group">
          <input type="nombre" for="apellido" name="apellido" placeholder="Apellido"/>
        </div>
        <div class="u-form-group">
          <input type="email" for="email" name="email" placeholder="Email"/>
        </div>
        <div class="u-form-group">
          <input type="password" for="password" name="password" placeholder="Password"/>
        </div>
        <div class="u-form-group">
          <button type="submit">Sign in</button>
        </div>
        <div class="u-form-group">
          <span>¿Ya tienes cuenta?</span>
          <a href="index.php/welcome/login" class="forgot-password">¡Inicia sesión!</a>
        </div>
        <div>
          <a href="#"><i class="fa fa-arrow-circle-left" aria-hidden="true">Inicio</i></a>
        </div>
      </form>

  </div>


</body>
</html>
