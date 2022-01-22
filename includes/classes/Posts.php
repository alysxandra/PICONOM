<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="javascript/bootstrap.js"></script>
<script src="javascript/bootbox.min.js"></script>

<?php 

class Post {
    private $user_obj;
    private $con;
    
    // creates an object of the User class
    public function __construct($con, $user){
        $this->con = $con; // references the class variables
        $this->user_obj = new User($con, $user);
    }

    public function submitPost($body, $user_to, $imageName){
        $body = strip_tags($body); // removes html tags
        $body = mysqli_real_escape_string($this->con, $body);

        // allows line breaks in posts
        $body = str_replace('\r\n', '\n', $body);
        $body = nl2br($body);

        $check_empty = preg_replace('/\s+/', '', $body); // deletes all spaces

        if($check_empty !== ""){

            // current date and time
            $date_added = date("Y-m-d H:i:s");
            //get username
            $added_by = $this->user_obj->getUsername();

            if($user_to == $added_by) {
                $user_to = "none";
            }

            // insert posts into database
            $query = mysqli_query($this->con, "INSERT INTO posts VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no', '0', '$imageName')");
            $returned_id = mysqli_insert_id($this->con);

            // updating post count of user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->con, "UPDATE users SET num_posts = '$num_posts' WHERE username = '$added_by'");

        }
    }

    public function loadPostsFriends(){
        $str = ""; // string to return
        $data = mysqli_query($this->con, "SELECT * FROM posts WHERE deleted = 'no' ORDER BY id DESC");
        $userLoggedIn = $this->user_obj->getUsername();

        while($row = mysqli_fetch_array($data)){
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];
            $imagePath = $row['image'];

            // prepare user_to string
            if($row['user_to'] == "none"){
                $user_to = "";
            }
            else{
                $user_to_obj = new User($con, $row['user_to']);
                $user_to_name = $user_to_obj->getUsername();
                $user_to = "<a href='" . $row['user_to'] . "'>" . $user_to_name . "</a>";
            }

            $user_details_query = mysqli_query($this->con, "SELECT username FROM users WHERE username='$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $username = $user_row['username'];

            ?>

            <script>
            
                function toggle<?php echo $id; ?>(){

                    var target = $(event.target);
                    if (!target.is("a")){
                        var element = document.getElementById("toggleComment<?php echo $id; ?>");

                        // to know if comments are hidden or not
                        if(element.style.display == "block")
                            element.style.display = "none";
                        else
                            element.style.display = "block";
                    }

                }

            </script>

            <?php

            $comments_check = mysqli_query($this->con, "SELECT * FROM comments WHERE post_id='$id'");
            $comments_check_num = mysqli_num_rows($comments_check);

            // time posted
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time); // time of post
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

            // uploaded image
            if($imagePath != ""){
                $imageDiv = "<div class='posted-image'>
                                <img src='$imagePath'>
                            </div>";
            }
            else{
                $imageDiv = "";
            }

            $str .= "<div class='status-posts' onClick='javascript:toggle$id()'>
                <div class='posted-by' style='color: #acacac;'>
                    <a href='#' style='background-color: transparent; font-weight: bold;'> $username </a> &nbsp; · &nbsp; $time_message
                </div>

                <div id='post_body'>
                    $body
                    <br>
                    $imageDiv
                    <iframe src='like.php?post_id=$id' id='likes-iframe' style='height: 55px; width: fit-content; font-family:oxygen; margin-left: 10px; font-size: 8px;' frameborder='0'></iframe>
                </div>

                <div class='view-comments'>
                    $comments_check_num comments
                </div>
            
                <div class='post-comment' id='toggleComment$id' style='display:none;'>
                    <iframe src='comment-frame.php?post_id=$id' id='comment_iframe' frameborder='0'></iframe>
                </div>

            </div>";

            ?>

            <?php
        
        }

        echo $str;
    }

}

?>