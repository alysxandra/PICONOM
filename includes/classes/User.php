<?php 

class User {
    private $user;
    private $con;
    
    // creates an object of the User class
    public function __construct($con, $user){
        $this->con = $con; // references the class variables
        $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user'");
        $this->user = mysqli_fetch_array($user_details_query);
    }

    public function getNumPosts(){
        $username = $this->user['username'];
        $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);
        return $row['num_posts'];
    }

    public function getUsername(){
        return $this->user['username'];
    }

}

?>