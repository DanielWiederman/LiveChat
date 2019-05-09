<?php include_once('../db.php');
session_start();
$query = "SELECT * FROM `users`";
$id = $_SESSION['userID'];
if($result = mysqli_query($mysqli,$query)){
        while ($row = mysqli_fetch_assoc($result)) {//Get the 
            if($row['user_id'] == $id)
            {
                continue;
            }
            echo "<tr id=".$row["user_id"].">";
            if($row["user_status"]=="Offline"){
             echo '<td onclick="loadChat('.$row["user_id"].')"" class="contact text-center"><p class="badge badge-pill badge-danger" style="font-size: 20px">'.$row["user_name"].'</p></td>';
            }
            else
            echo '<td onclick="loadChat('.$row["user_id"].')" class="contact text-center"><p class="badge badge-pill badge-warning" style="font-size: 20px">'.$row["user_name"].'</p></td>';
            }
            echo "</tr>";
        }

?>