<?php include_once('../db.php');
session_start();
$checkAll = 1;

if(isset($_POST["id"])){
    $id = $_POST["id"];
}else{
    $checkAll = 0;
}

if(isset($_POST["password"])){
    $password = $_POST["password"];
}else{
    $checkAll = 0;
}

if($checkAll){
    $query = "SELECT * FROM `users` WHERE user_id = '$id' "; 
    if($result = mysqli_query($mysqli,$query)){
        $row = mysqli_fetch_assoc($result);
        if($row["user_password"] == $password){
            $_SESSION["id"] = $id;
            $_SESSION["name"] = $row["user_name"];
            $_SESSION['userID'] = $row["user_id"];
            $statusQuery= "UPDATE `users` SET `user_status`='Online' WHERE user_id=".$row["user_id"]."";
            mysqli_query($mysqli,$statusQuery);    

            if($row["authorization"]){
                $_SESSION['admin'] = 1;
            }
            else{
                $_SESSION['admin'] = 0;
            }
            echo '1';
        }
        else{
            echo '0';
        }
    }       
}else{
    echo '0';
}


?>