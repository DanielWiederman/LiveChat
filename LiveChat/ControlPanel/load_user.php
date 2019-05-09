<?php include_once('../db.php');
session_start();

if(isset($_POST["userId"])){
    $userId=intval($_POST["userId"]);
}
$query = "SELECT * FROM `users` where `user_id` = $userId";
if($result = mysqli_query($mysqli,$query)){
    if ($row = mysqli_fetch_assoc($result)) {
        echo '<p class="font-weight-bold"><u>ID:</u> '.$row["user_id"].'</p><br>';
        echo '<p class="font-weight-bold"><u>Name:</u> '.$row["user_name"].'</p><br>';
        echo '<p class="font-weight-bold"><u>Password:</u> '.$row["user_password"].'</p><br>';
    }
}

?>