<?php 
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Posts.php");


if(isset($_POST['post'])){

    // uploads image
    $uploadOk = 1;
    $imageName = $_FILES['fileToUpload']['name'];

    if($imageName != ""){
        $targetDir = "media/posts/";
        $imageName = $targetDir . uniqid() . basename($imageName);
        $imageFileType = pathinfo($imageName, PATHINFO_EXTENSION);

        if($_FILES['fileToUpload']['size'] > 10000000000){
            $errorMessage = "file is too big!";
            $uploadOk = 0;
        }

        if(strtolower($imageFileType) != "jpeg" && strtolower($imageFileType) != "png" && strtolower($imageFileType) != "jpg" && strtolower($imageFileType) != "jfif" && strtolower($imageFileType) != "gif"){
            echo '<script>alert(sorry! only jpeg, jpg, jfif, png, and gif files are allowed!)</script>';
            $uploadOk = 0;
        }

        if($uploadOk){
            if(move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $imageName)){
                // image uploaded ok!!
            }
            else{
                // img did not upload :(
                    $uploadOk = 0;
            }
        }

    }

    if($uploadOk){
        $post = new Post($con, $userLoggedIn);
        $post->submitPost($_POST['post-text'], 'none', $imageName);
    }
    else{
        echo '<script type="text/javascript">','uploadFail();','</script>';
    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    
    <link rel="stylesheet " href="css/home.css">
</head>

<body>

    <div class="main-container">

        <div class="post-container">

            <form class="post-form" action="home.php" method="POST" enctype="multipart/form-data">
                <textarea name="post-text" id="post-text" placeholder="What's going on today?"></textarea>
                <br>
                <input type="submit" name="post" id="post-btn" value="POST">

                <!-- upload image -->
                <input type="file" name="fileToUpload" id="fileToUpload">
            </form>

        </div> 

        <!-- outputs all of the posts -->
        <div class="posts-container">
            <?php
                $post = new Post($con, $userLoggedIn);
                $post-> loadPostsFriends();
            ?>
        </div>

    </div>

    

</body>

</html>