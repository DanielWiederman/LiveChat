<?php
include_once('./db.php');
session_start();
if(!isset($_SESSION['name'])){
    header("Location: http://localhost/PHP-ME/LiveChat/login.php");
    die
}
$admin = $_SESSION['admin'];
$name = $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="index.css">

        <!-- Font Awesome 5.7.0 -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <meta charset="UTF-8">
        <title>LiveChat</title>
    </head>
    <body>

        <!-- Header -->
        <Header class="header">
            <div class="row">
                <div style="padding:15px" class="col-md-6 offset-md-0" >
                    <span class="title">Welcome <b><span id="uName" class="title"></span></b> to RetroChat</span>
                    <i class="far fa-comments title"></i>
                </div>
                <div class="col-md-2 offset-md-1">
                    <div style="padding:35px">
                        <button id="adminPanel" type="btn" class=" Circlebutton btn-secondary btn-lg" onclick="controlPanel()">Control Panel</button>
                    </div>  
                </div>
                <div class="col-md-1 offset-md-1" >
                    <div style="padding:35px">
                        <button type="btn btn-logout" class=" Circlebutton btn-primary btn-lg" onclick="logout()">Logout</button>
                    </div>
                </div>
            </div> 
        </Header> 
        <!-- /Header -->

        <!-- Section --> 
        <section>
            <div class="divider"></div>                
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">

                    <!-- Contacts -->
                    <div class="col-md-4 col-sm-12" style="height: 600px">
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

                    <!-- Chat -->
                    <div id="chatSize" class="col-md-6 offset-md-2  col-sm-12" style="height: 600px">
                        <div id="chat" class="chatBox h-100 style-2">
                            <div id="chatLoad">
                                <h1><u><b>Welcome to RetroChat  <i class="far fa-comments"></i></b></u></h1>
                            </div>
                            <div id="messages">
                                <p class="startingLine">Pick a contact that you want to start chat with...</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div id="textArea" class="">
                                    <textarea placeholder="Type your text here..." class="form-control textAreaChat" rows="2" id="textA" name="text" cols='90'></textarea>
                                </div>
                                <div style="width:5%"></div>
                                <button class="btn btn-light btn-circle btn-xl btn-lg" onclick="insert()">
                                    <i class="fas fa-share-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /Chat -->

                </div>
                <!-- /Row -->
            </div>
            <div class="divider"></div>
        </section>
        <!-- /Section -->

        <!-- Footer -->
        <Footer>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <center>
                        <p style="font-size: 30px">Dude... im retroing the chat!</p>
                    </center>
                </div>
            </div>
        </Footer>
        <!-- /Footer -->

    </body>
    <script>
        var secondID;
        var scrolled=false;
        var admin = <?PHP echo $admin; ?>;
        var name = '<?PHP echo $name; ?>';
        $(document).ready(function(){
            $('#uName').text(name)
            if(admin){
                $('#adminPanel').show();
            }
            else{
                $('#adminPanel').hide();
            }
            loadContacts();
            window.setInterval(function(){if(secondID){
                load_messages(secondID)
                loadContacts()
            }},2000);
        });

        function loadContacts(){
            $.ajax({
                url:'Contacts/load_contacts.php',
                method: 'POST',
            }).done(function(data){
                $('#contacts').html(data);
            }); 
        }

        function insert(){
            var textData  = document.getElementById("textA").value;
            $.ajax({
                url:'Chat/insert_chat.php',
                method:"POST",
                data:{textData:textData, userId:secondID},
            }).done(function(data){
                $('#textA').val('')
                scrolled=false;
            });
        }

        function load_messages(secondID){
            console.log(secondID)
            $.ajax({
                url:'Chat/load_messages.php',
                method:"POST",
                data:{secondID:secondID},
            }).done(function(data){
                $('#messages').html(data).ready(function(){
                    scrollDown();
                });
            });
        }

        function loadChat(id){
            $.ajax({
                url:'Chat/load_chat.php',
                data:{userId:id},
                method: 'POST'
            }).done(function(data){
                $('#chatLoad').html(data);  
                secondID = id;
                load_messages(secondID);
                scrolled=false;
            })
        }

        function logout(){
            $.ajax({
                url:'session.php',
                data: {logout:"logout"},
                method: 'POST'
            }).done(function(data){
                if(data == 1){
                    window.location.href = "http://localhost/PHP-ME/LiveChat/login.php";
                } 
            })
        }

        function controlPanel(){
            if(admin){
                window.location.href = "http://localhost/PHP-ME/LiveChat/ControlPanel/control_panel.php";
            }
            else{
                alert("Acces DENIED!");
            }
        }

        function scrollDown(){
            if(!scrolled)
            {
                $('#chat').scrollTop($('#chat')[0].scrollHeight);
                window.scrollTo(0,document.body.scrollHeight);
                scrolled = true;
            }
        }
    </script>
</html>