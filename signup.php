<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP • PICONOM</title>

    <!-- javascript alerts -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <!-- javascript alerts -->
    <link rel="stylesheet" href="css/signup.css">
</head>

  <body>

  <script src="javascript/alerts.js"></script>
  <?php require 'includes/form_handlers/signup-handler.php'; ?>
    
    <div class="main-container">

      <div class="container">

        <form action="signup.php" method="POST" class="signup">

          <p class="signup-text">PICONOM</p>

          <div class="signup-group">
            <input type="email" placeholder="email" name="su_email" value="<?php 
            if(isset($_SESSION['su_email'])) { 
              echo $_SESSION['su_email']; 
            } 
            ?>" required>
          </div>

          <div class="signup-group">
            <input type="username" placeholder="username" name="su_username" value="<?php 
            if(isset($_SESSION['su_username'])) { 
              echo $_SESSION['su_username']; 
            } 
            ?>" required>
          </div>

          <div class="signup-group">
            <input type="password" placeholder="password" name="su_password" required>
          </div>
          <div class="signup-group">
            <input type="password" placeholder="confirm password" name="su_password2" required>
          </div>
          <p class="extra-space">&nbsp;</p>

          <div class="signup-group">
            <input type="submit" name="signup_btn" class="signup-btn" value="sign up">
          </div>

        </form>

      </div>

      <div class="container2">
        <p class="signup-login-text">Already have an account?<a href="index.php">&nbsp;Log in</a></p>
      </div>

    </div>

  </body>
</html>