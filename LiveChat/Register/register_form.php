<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="register.css">
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <title>register</title>
    </head>
    <body>


        <form>
            <div class="container">
                <h1>Register</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>

                <label><b>User name:</b></label>
                <input onclick="deleteVal('idError')" id="userName" type="text" placeholder="Enter user name" name="userName" required>
                <div class="errorContainer" id="errorId">
                    <p class="error" id="idError"></p>
                </div>


                <label ><b>Password:</b></label>
                <input onclick="deleteVal('passError')" id="password" type="password" placeholder="Enter Password" name="psw" required>
                <div class="errorContainer" id="errorPass">
                    <p class="error" id="passError"></p>
                </div>

                <button type="submit" class="registerbtn" onclick="register()">Register</button>
            </div>
        </form>


    </body>
</html>
<script>
    $(document).ready(function(){
        $('#errorId').hide();
        $('#errorPass').hide();
    });
    
    function register(){
        var userName=document.getElementById("userName").value;
        var password=document.getElementById("password").value;
        $.ajax({
            url:'register_insert.php',
            method:"POST",
            data:{userName:userName,password:password},
        }).done(function(data){
            console.log(data);
            if(data==1){
                alert("Succes!");
                window.location.href="http://localhost/PHP-ME/LiveChat/login.php";
            }
            if(data==2){
                $('#idError').text('ERROR!')
                $('#errorId').show();
            }
            if(data==3){
                $('#idError').text("Dont use empty string BITCH!");
                $('#errorId').show();
            }
            if(data==4){
                $('#passError').text("write password RIGHT NOW!!!!!!!! (Sarah Netaneyahu)");
                $('#errorPass').show();
            }
        })
    }

    function deleteVal(value){
        
        if(value=="idError"){
            $('#idError').text('');
            $('#errorId').hide();
        }
        else{
            $('#passError').text('')
            $('#errorPass').hide();
        }
    }
</script>