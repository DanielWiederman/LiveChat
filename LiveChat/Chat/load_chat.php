<?php include_once('../db.php');
session_start();
$query = "SELECT * FROM `users`";
$id = $_SESSION['userID'];
if($result = mysqli_query($mysqli,$query)){
    while ($row = mysqli_fetch_assoc($result)) {//Get the 
        if($row['user_id'] == $_POST["userId"])
        {
            echo "<div class='col-sm-12 text-center chatProfileTarget '><p style='font-size:25px'>".$row['user_name']."</p></div>";
        }  
    }
}
?>
