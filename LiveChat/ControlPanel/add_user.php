<?php include_once('../db.php');

if(isset($_POST["newPassword"])){
    $newPassword=$_POST["newPassword"];
}

if(isset($_POST["newUserName"])){
    $newUserName=$_POST["newUserName"];
}

if(isset($_POST["authorization"])){
    $authorization=intval($_POST["authorization"]);
}

if(!empty($newUserName)&&!empty($newPassword)&&!empty($authorization)){
    $query ="INSERT INTO `users`(`user_name`, `user_password`, `authorization`) VALUES ('$newUserName','$newPassword', $authorization)";
    mysqli_query($mysqli,$query);
    echo 1;
}
else if(!empty($newUserName)&&!empty($newPassword)){
    $query ="INSERT INTO `users`(`user_name`, `user_password`) VALUES ('$newUserName','$newPassword')";
    mysqli_query($mysqli,$query);
    echo 2;
}
else{
    echo 0;
}
?>