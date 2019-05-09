<?php
include_once('./db.php');
session_start();



if(isset($_POST["logout"])){
    $id = $_SESSION['userID'];
    $statusQuery= "UPDATE `users` SET `user_status`='Offline' WHERE user_id=".$id;
    mysqli_query($mysqli,$statusQuery);  
    session_destroy();
    echo 1;
}
else{
    echo 0;
}
?>