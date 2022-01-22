<?php 
include("includes/header.php");
include("includes/form_handlers/settings-handler.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PICONOM</title>
    <link rel="stylesheet " href="css/profile.css">
</head>

<body>

    <div class="main-container">

        <div class="user-cont">
            <div class="username-cont">
                <?php 
                echo $user['username'] . "<br>";
                ?>
            </div>
            <div class="user-details">
                <?php
                echo $user['num_posts'] . " posts &nbsp;&nbsp;&nbsp;" . $user['num_likes'] . " likes";
                ?>
            </div>
        </div>

        <hr class="line">

        <h4>edit profile</h4> 

        <div class="acc-settings">         

            <?php
                // fetches data from database to display into the webpage
                $user_data_query = mysqli_query($con, "SELECT username, email FROM users WHERE username='$userLoggedIn'");
                $row = mysqli_fetch_array($user_data_query);

                $email = $row['email'];
            ?>

            <form class="email-form" action="profile.php" method="POST">

                <label for="email">email</label> <br>
                <div class="editprof-group">
                    <input type="text" name="email" value="<?php echo $email; ?>"> <br><br>
                </div>

                <input class="save-change" type="submit" name="update_details" id="save_details" value="save changes"> <br><br>

            </form>

            <form class="pass-form" action="profile.php" method="POST">

                <div class="editprof-group">
                    <label for="oldpass">current password</label> <br>
                    <input type="password" name="old_password" > <br><br>
                </div>

                <div class="editprof-group">
                    <label for="newpass">new password</label> <br>
                    <input type="password" name="new_password_1" > <br><br>
                </div>

                <div class="editprof-group">
                    <label for="newpass2">confirm new password</label> <br>
                    <input type="password" name="new_password_2" > <br><br>
                </div>
                
                <input class="save-change" type="submit" name="update_password" id="save_details" value="change password"> <br><br>

            </form>

            <br>

        </div>
        
        <!-- error messages -->
        <div class="message-error">
            <?php echo $message; ?>
            <?php echo $password_message; ?>
        </div>

    </div>

    

</body>

</html>