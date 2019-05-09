<?php include_once('../db.php');
session_start();
$myId=intval($_SESSION["userID"]);
if(isset($_POST["secondID"])){
    $otherId=intval($_POST["secondID"]);
    if($otherId == $myId){
        echo $myId;
        echo $otherId;
        die();
    }
}
$sql = "SELECT * FROM `conversations` WHERE (user1_id = $myId OR user2_id = $myId)";
$cov_id;
$right="text-align:right";
$left="text-align:left";
if($result = mysqli_query($mysqli,$sql))
{
    while ($row = mysqli_fetch_assoc($result))
    {
        if(($row["user1_id"] == $myId || $row["user1_id"] == $otherId )&&($row["user2_id"] == $myId || $row["user2_id"] == $otherId))
        {
            $cov_id = $row['conversation_id'];
            $sql = "SELECT messages.*,users.* FROM `messages` JOIN `users` WHERE conversion_id = $cov_id AND users.user_id = messages.user_id ORDER BY `message_id`";
            if($result = mysqli_query($mysqli,$sql))
            {
                while ($row = mysqli_fetch_assoc($result))
                {
                    if($myId == $row["user_id"]){
                        $style=$left;
                        $class="firstUser col-md-6 offset-md-1";
                    }
                    else{ 
                        $style=$right;
                        $class="secondUser col-md-6 offset-md-5";
                    }
                    $img = base64_encode($row["user_img"]);
                    echo '<div class="'.$class.'" style="'.$style.'">
                    <p class="userName">'.$row["user_name"].'</p>
                    <p class="messageBody">'.$row["message_body"].'</p>
                    <p class="time">'.$row["message_time"].'</p>
                    </div>
                    <div style="height:10px"></div>';
                }
            }
        }




    }
}
?>