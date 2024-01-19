<?php

session_start();
include('config.php');

if(isset($_SESSION['userid'])){
    $user_id = $_SESSION['userid'];
    $sql = "select * from poll_votes where user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        echo $row['vote_option'];
    }
}

?>