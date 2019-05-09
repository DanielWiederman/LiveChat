<?php include_once('../db.php');
if(isset($_POST["id"])){
    $secondUser=$_POST["id"];
    $query="DELETE FROM `users` WHERE `user_id` =$secondUser";
    mysqli_query($mysqli,$query);
    echo 1;
}
else{
    echo 2; 
}



?>