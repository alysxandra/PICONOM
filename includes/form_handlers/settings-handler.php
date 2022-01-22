<?php  
if(isset($_POST['update_details'])) {

	$email = $_POST['email'];

	$email_check = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
	$row = mysqli_fetch_array($email_check);
	$matched_user = $row['username'];

	if($matched_user == "" || $matched_user == $userLoggedIn) {
		$message = "email updated!<br><br>";

		$query = mysqli_query($con, "UPDATE users SET email='$email' WHERE username='$userLoggedIn'");
	}
	else 
		$message = "that email is already in use!<br><br>";
}
else 
	$message = "";


if(isset($_POST['update_password'])) {

	$old_password = strip_tags($_POST['old_password']);
	$new_password_1 = strip_tags($_POST['new_password_1']);
	$new_password_2 = strip_tags($_POST['new_password_2']);

	$password_query = mysqli_query($con, "SELECT password FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($password_query);
	$db_password = $row['password'];

	if(md5($old_password) == $db_password) {

		if($new_password_1 == $new_password_2) {

			if(strlen($new_password_1) <= 3) {
				$password_message = "your password must be more than 3 characters! <br><br>";
			}	
			else {
				$new_password_md5 = md5($new_password_1);
				$password_query = mysqli_query($con, "UPDATE users SET password='$new_password_md5' WHERE username='$userLoggedIn'");
				$password_message = "password has been changed! :D <br><br>";
			}


		}
		else {
			$password_message = "your two new passwords need to match! <br><br>";
		}

	}
	else {
			$password_message = "the old password is incorrect! <br><br>";
	}

}
else {
	$password_message = "";
}

?>