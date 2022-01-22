<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN • PICONOM</title>

    <!-- javascript -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <link rel="stylesheet " href="css/login.css">
</head>

  <body>

  <script src="javascript/alerts.js"></script>

  <?php 
  require 'includes\form_handlers\signup-handler.php';
  require 'includes\form_handlers\login-handler.php'; 
  ?>
    
    <div class="main-container">

      <div class="container">

        <!-- login form -->
        <form action="index.php" method="POST" class="login">

          <p class="login-text">PICONOM</p>

          <div class="login-group">
            <input type="email" placeholder="email" name="log_email" required>
          </div>
          <div class="login-group">
            <input type="password" placeholder="password" name="log_password" required>
          </div>

          <hr style="padding-bottom: 30px; border: transparent;">

          <div class="login-group">
            <input type="submit" name="login_btn" class="login-btn" value="log in">
          </div>

        </form>

      </div>

      <div class="container2">
        <p class="signup-login-text">Don't have an account?<a class="signup-btn" href="signup.php">&nbsp;Sign up</a></p>
      </div>

    </div>

  </body>
</html>