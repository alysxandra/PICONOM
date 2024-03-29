<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/home.css">

</head>

  <body>

    <?php 
    
    require 'config/config.php'; 
    include("includes/classes/User.php");
    include("includes/classes/Posts.php");

    if (isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$userLoggedIn'");
        $user = mysqli_fetch_array($user_details_query);
    }
    else{
        header("Location: index.php");
    }

    ?>

    <script>
        function toggle(){
            var element = document.getElementById("comment_section");

            // to know if comments are hidden or not
            if(element.style.display == "block")
                element.style.display = "none";
            else
                element.style.display = "block";

        }
    </script>

    <?php

    // get id of post
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
    }

    $user_query = mysqli_query($con, "SELECT added_by, user_to FROM posts WHERE id='$post_id'");
    $row = mysqli_fetch_array($user_query);

    $posted_to = $row['added_by'];

    if(isset($_POST['postComment' . $post_id])) {
        $post_body = $_POST['post_body'];
        $post_body = mysqli_escape_string($con, $post_body);
        $date_time_now = date("Y-m-d H:i:s");
        $insert_post = mysqli_query($con, "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn', '$posted_to', '$date_time_now', 'no', '$post_id')");
        echo "<p>comment posted! </p>";
    }


    ?>

    <form class="comment-form" action="comment-frame.php?post_id=<?php echo $post_id; ?>" id="comment_form" name="postComment<?php echo $post_id; ?>" method="POST">
		<textarea class="comment-textbox" name="post_body" placeholder="Add a comment..."></textarea>
		<input type="submit" name="postComment<?php echo $post_id; ?>" value="POST">
	</form>

    <?php 

    $get_comments = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id' ORDER BY id ASC");
    $count = mysqli_num_rows($get_comments);

    if ($count != 0){
        while($comment = mysqli_fetch_array($get_comments)){

            $comment_body = $comment['post_body'];
            $posted_to = $comment['posted_to'];
            $posted_by = $comment['posted_by'];
            $date_added = $comment['date_added'];
            $removed = $comment['removed'];

            // time posted
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_added); // time of post
            $end_date = new DateTime ($date_time_now); // current time
            $interval = $start_date->diff($end_date); // difference between dates

            if ($interval-> y >= 1){
                if ($interval == 1){
                    $time_message = $interval -> y . "y"; // 1 year ago
                }
                else{
                    $time_message = $interval -> y . "y"; // 1 year ago
                }
            }
            else if ($interval-> m >= 1){
                if ($interval -> d == 0){
                    $days = " ago";
                }
                else if ($interval -> d == 1){
                    $days = $interval -> d . "d";
                }
                else{
                    $days = $interval -> d . "d";
                }

                if($interval -> m == 1){
                    $time_message = $interval -> m . " month" . $days;
                }
                else{
                    $time_message = $interval -> m . " months" . $days;
                }
            }
            else if($interval -> d >= 1){
                if ($interval -> d == 1){
                    $time_message = "yesterday";
                }
                else{
                    $time_message = $interval -> d . "d";
                }
            }
            else if($interval -> h >= 1){
                if ($interval -> h == 1){
                    $time_message = $interval -> h . "h";
                }
                else{
                    $time_message = $interval -> h . "h";
                }
            }
            else if($interval -> i >= 1){
                if ($interval -> i == 1){
                    $time_message = $interval -> i . "m";
                }
                else{
                    $time_message = $interval -> i . "m";
                }
            }
            else{
                if ($interval -> s < 1){
                    $time_message = "just now";
                }
                else{
                    $time_message = $interval -> s . "s";
                }
            }

            $user_obj = new User($con, $posted_by);

            ?>
            
            <hr class="linespace">

            <!-- outputs the actual comments made by users -->
            <div class="comment-section">
                <a class="comment-users" href="<?php echo $posted_by ?>" style="color: black;" target="_parent"><b><?php echo $user_obj->getUserName(); ?></b></a>
                &nbsp; · &nbsp; <?php echo $time_message . "<br>" . $comment_body; ?>
            </div>

            <hr class="linespace">

    <?php


        }
    }
    
    ?>

    


  </body>

</html>