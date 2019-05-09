<?PHP include_once("../db.php");

$check = true;

if(!isset($_POST["userName"])){
    echo "2";
    $check = false;
}

if(!isset($_POST["password"])){
    echo "2";
    $check = false;
}

$name = $_POST["userName"];
$password = $_POST["password"];
if(empty($name)){
    echo '3';
    $check = false;
}
if(empty($password)){
    echo '4';
    $check = false;
}
else{
    if($check){
        $query = "INSERT INTO `users`(`user_name`, `user_password`) VALUES ('$name','$password')";
        if($result=mysqli_query($mysqli,$query)){
            echo "1";        
        }
        else{
            echo "2";
        }    
    }
}


?>