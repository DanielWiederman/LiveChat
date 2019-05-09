<?php
if(!isset($_SESSION['admin'])){
    session_destroy();
    header("Location: http://localhost/PHP-ME/LiveChat/login.php");
}
include_once('../db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="../index.css">

        <!-- Font Awesome 5.7.0 -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <title>RetroChat's Control Panel</title>
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <div class="row">
                <div style="padding:15px" class="col-md-3 offset-md-1" >
                    <span class="title">  RetroChat</span>
                    <i class="far fa-comments title"></i>
                </div>
                <div class="col-md-3 offset-md-1">
                    <div style="padding:35px">
                        <button id="adminPanel" type="btn" class=" Circlebutton btn-secondary btn-lg" onclick="goBack()">Back 2 RetroChat</button>
                    </div>  
                </div>
                <div class="col-md-1 offset-md-2" >
                    <div style="padding:35px">
                        <button type="btn btn-logout" class=" Circlebutton btn-primary btn-lg" onclick="logout()">Logout</button>
                    </div>
                </div>
            </div> 
        </header> 
        <!-- /Header --> 


        <!-- Section -->
        <section>
            <div class="divider"></div>

            <!-- Add -->
            <div class="row">
                <div class="col-md-4 offset-md-1">
                    <Button class="btn-Dark btn-lg" data-toggle="modal" data-target="#exampleModalCenter">Add new user</Button>
                </div>
            </div> 

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Add new user to RetroChat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="check" class="modal-body">

                            <!-- ModalContect -->
                            <form>
                                <label><b>Username:</b></label><br>
                                <input id="userName" type="text" placeholder="Enter username" name="userName">
                                <br>
                                <br>
                                <label ><b>Password:</b></label><br>
                                <input id="password" type="password" placeholder="Enter password" name="psw">
                                <br>
                                <br>
                                <b>Admin privileges?</b><br>
                                <div class="btn-group" id="radioAdmin">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadio1" name="adminPriv" class="custom-control-input">
                                        <label class="custom-control-label" for="customRadio1" value="0">Yes</label>
                                    </div>
                                </div>
                            </form>
                            <!-- /ModalContect -->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Dismiss</button>
                            <button type="button" class="btn btn-primary" onclick="addContact()" data-dismiss="modal">Add user</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Add -->

            <div class="divider"></div>              
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">

                    <!-- Contacts -->
                    <div class="col-md-4" style="height: 600px">
                        <div class="contactBox h-100 style-1">
                            <div class="col-md-12 text-center" ><p style="font-size: 25px"><b>Contacts</b></p></div>
                            <table class="table" >
                                <thead>
                                </thead>
                                <tbody id="contacts">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /Contacts -->

                    <!-- Options -->
                    <div id="options" class="col-md-6 offset-md-2 options" style="height: 650px">
                        <div id="">
                            <div id="ContactPicker">

                            </div>
                        </div>

                        <!-- Update -->
                        <div id="updateContact">
                            <form>
                                <div class="container inputBox">
                                    <center>
                                        <h1><b><u>Update user</u></b></h1>
                                        <p>Choose what to update (you can <b><u>change one OR both</u></b> of them).</p>
                                    </center>
                                    <hr>
                                    <center>
                                        <label><b>New user name:</b></label><br>
                                        <input id="newuserName" type="text" placeholder="Enter NEW name" name="userName">
                                        <br>
                                        <label ><b>New password:</b></label><br>
                                        <input id="newpassword" type="password" placeholder="Enter NEW password" name="psw">
                                        <br>
                                        <br>
                                        <button type="submit" class="btn-primary btn-lg" onclick="update(secondUser)">Update user</button>
                                    </center>
                                    <br>
                                </div>
                            </form>
                            <br>
                            <br>
                        </div>
                        <!-- /Update -->

                        <div id="mainButtons" class="d-flex justify-content-around">
                            <Button class="btn-danger btn-sm" type="btn" onclick="deleteUser(secondUser)">Delete</Button>
                            <Button id="updateButton" class="btn-warning btn-sm" onclick="updateHandler()">Update</Button>
                        </div>
                    </div>
                    <!-- /Options -->

                </div>
            </div>
            <div class="divider"></div>
        </section>   
        <!-- /Section -->


        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <center>
                        <p style="font-size: 30px">Dude... im retroing the chat!</p>
                    </center>
                </div>
            </div>
        </footer>
        <!-- /Footer -->
    </body>
    <script>
        var secondUser;
        var currentUser;
        var selected = false;
        $(document).ready(function(){
            loadContacts();
            $('#options').hide();
            $('#updateContact').hide();
        });

        function loadContacts(){
            $.ajax({
                url:'../Contacts/load_contacts.php',
                method: 'POST',
            }).done(function(data){
                $('#contacts').html(data);
            }); 
        }

        function loadChat(id){
            $.ajax({
                url:'load_user.php',
                data:{userId:id},
                method: 'POST'
            }).done(function(data){
                $('#ContactPicker').html(data);  
                secondUser = id;
                $('#updateContact').hide();
                $('#updateButton').attr("disabled", false);
                if(!selected || currentUser != secondUser){
                    $('#options').show();
                    selected = !selected;
                    currentUser = secondUser;
                }
                else{
                    $('#options').hide();
                    selected = !selected;
                    currentUser = secondUser;
                }
            })
        }

        function goBack(){
            window.location.href = "http://localhost/PHP-ME/LiveChat/index.php";
        }

        function updateHandler(){
            $('#updateContact').show();
            $('#updateButton').attr("disabled", true);
        }

        function update(id){
            var userName=document.getElementById("newuserName").value;
            var password=document.getElementById("newpassword").value;

            $.ajax({
                url:'update_contact.php',
                method:"POST",
                data:{userName:userName,password:password,userId:id},
            }).done(function(data){
                if(data==0){
                    alert("Succes! updated username and password!");
                    $('#updateContact').hide();
                }
                if(data==1){
                    alert("Succesfly updated username!");
                    $('#updateContact').hide();
                }
                if(data==2){
                    alert("Succesfly updated password!");
                    $('#updateContact').hide();
                }
                if(data==3){
                    alert("ERROR");
                    $('#updateContact').hide();
                }
                loadContacts();
            })
        }

        function deleteUser(id){
            $.ajax({
                url:"delete_user.php",
                data:{id:id},
                method:"POST",
            }).done(function(data){
                if(data==1){
                    alert("SUCCES");
                    loadContacts();
                    $('#options').hide();
                }
                if(data==2){
                    alert("FAILURE");
                }
            })
        }

        function addContact(){
            var userName=document.getElementById("userName").value;
            var password=document.getElementById("password").value;
            var auth=$('#radioAdmin input:radio:checked').val();
            if(auth)
            {
                auth = 1;
                $.ajax({
                    url:"add_user",
                    data:{newPassword:password,newUserName:userName,authorization:auth},
                    method:"POST",  
                }).done(function(data){
                    if(data==0)
                    {
                        alert("Error");
                    }
                    if(data==1)
                    {
                        alert("New admin added!");
                    }
                    if(data==2)
                    {
                        alert("New user added!");
                    }
                })
            }
            else{
                $.ajax({
                    url:"add_user",
                    data:{newPassword:password,newUserName:userName},
                    method:"POST",  
                }).done(function(data){
                    if(data==0)
                    {
                        alert("Error");
                    }
                    if(data==1)
                    {
                        alert("New admin added!");
                    }
                    if(data==2)
                    {
                        alert("New user added!");
                    }
                })
            }
            loadContacts();
        }
    </script>
</html>