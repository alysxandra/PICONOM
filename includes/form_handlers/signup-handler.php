<?php

require 'config/config.php';

// declaring variables to prevent errors
$email = ""; // email
$username = ""; // username
$password = ""; // password
$password2 = ""; // confirm password
$date = ""; // date the user signed up
$error_array = array(); // holds error messages

if(isset($_POST['signup_btn'])){
  
  // signup form values

  // email
  $email = strip_tags($_POST['su_email']); // removes html tags
  $email = str_replace(' ', '', $email); // removes spaces
  $email = strtolower($email); // lowercase all
  $_SESSION['su_email'] = $email; // stores email into session variable

  // username
  $username = strip_tags($_POST['su_username']); // removes html tags
  $username = str_replace(' ', '', $username); // removes spaces
  $username = strtolower($username); // lowercase all
  $_SESSION['su_username'] = $username; // stores username into session variable

  // password
  $password = strip_tags($_POST['su_password']); // removes html tags
  $password2 = strip_tags($_POST['su_password2']); // removes html tags

  $date = date("Y-m-d"); // gets current date

  if(filter_var($email, FILTER_VALIDATE_EMAIL)){

    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // check if email already exists
    $e_check = mysqli_query($con, "SELECT email FROM users WHERE email = '$email'");

    // count the number of rows returned
    $num_rows = mysqli_num_rows($e_check); 

    if($num_rows > 0){
        echo '<script type="text/javascript">','emailTaken();','</script>';
    }

  }
  else{
      echo '<script type="text/javascript">','emailInvalid();','</script>';
  }

  // check if username is taken
  $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username = '$username'");
  $num_rows_user = mysqli_num_rows($check_username_query);

  if($num_rows_user > 0){
    echo '<script type="text/javascript">','userTaken();','</script>';
  }
  
  // checks if username length is enough
  if(strlen($username) > 20 || strlen($username) < 2){
      echo '<script type="text/javascript">','userLength();','</script>';
  }

  // checks if passwords match
  if($password != $password2){
      echo '<script type="text/javascript">','passwordsUnmatched();','</script>';
  }
  else{ // checks if password contains non-english characters
      if(preg_match('/[^A-Za-z0-9]/', $password)){
          echo '<script type="text/javascript">','passwordsNotEnglish();','</script>';
      }
  }

  // checks if password length is enough
  if(strlen($password) > 30 || strlen($password) < 3){
    echo '<script type="text/javascript">','passwordsLength();','</script>';
  }
  
  // storing the values into the database

  // hashing the password
  $password = md5($password);

  $query = mysqli_query($con, "INSERT INTO users VALUES ('', '$username', '$email', '$password', '$date', '0', '0')");

}

?>