<?php include_once("../db.php");
session_start();
$id = $_SESSION['userID'];


if(isset( $_POST["userId"])){
    $secondId = $_POST["userId"];
}

if(isset( $_POST["textData"])){
    $messages_body = $_POST["textData"];
}

$sql="SELECT `conversation_id` from `conversations` where `user1_id` = $id and `user2_id` = $secondId OR `user1_id` = $secondId AND `user2_id` = $id";
if($result=mysqli_query($mysqli,$sql)){
    if($row=mysqli_fetch_assoc($result)){
        $conv_id = $row['conversation_id'];
        $query = "INSERT INTO `messages`(`message_body`, `user_id`, `conversion_id`) VALUES ('$messages_body',$id,$conv_id)";
        mysqli_query($mysqli,$query);
    }
    else{
        $query = "INSERT INTO `conversations`(`user1_id`, `user2_id`) VALUES ($id,$secondId)";
        mysqli_query($mysqli,$query);
        $sql="SELECT `conversation_id` from `conversations` where `user1_id` = $id and `user2_id` = $secondId OR `user1_id` = $secondId AND `user2_id` = $id";
        if($result=mysqli_query($mysqli,$sql)){
            if($row=mysqli_fetch_assoc($result)){
                $conv_id = $row['conversation_id'];
                $query = "INSERT INTO `messages`(`message_body`, `user_id`, `conversion_id`) VALUES ('$messages_body',$id,$conv_id)";
                mysqli_query($mysqli,$query);
            }
            else{
                echo "ERROR";
            }
        }
    }
}
?>