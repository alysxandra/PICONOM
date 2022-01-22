<?php 

require 'config/config.php'; 

if (isset($_SESSION['username'])){
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
}
else{
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="javascript/bootstrap.js"></script>
    <script src="javascript/bootbox.min.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/header.css">

</head>

  <body>

    <header>
        <label class="pico-title">PICONOM</label>
        <nav>
            <ul class="nav-links">
                <li><a href="home.php">home</a></li>
                <li><a href="<?php echo $userLoggedIn; ?>">profile</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </nav>
    </header>

  </body>

</html>