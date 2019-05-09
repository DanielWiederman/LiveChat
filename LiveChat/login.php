<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Messages login</h2>
		    <form class="login-form">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">User ID</label>
    <input name="id" type="number" class="form-control" placeholder="">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input name="password" type="password" class="form-control" placeholder="">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="submit" class="btn btn-login float-right">Submit</button>
  </div>
  
</form>

<div class="copy-text">New? <a href="http://localhost/PHP-ME/LiveChat/Register/register_form.php">Register now!</a><br><br>Created by Wiederman with <i class="fa fa-heart"></i></div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="https://static.pexels.com/photos/33972/pexels-photo.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Business shit</h2>
            <p>This app will let you stay connected with your hostage targets</p>
        </div>	
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="https://images.pexels.com/photos/7097/people-coffee-tea-meeting.jpg" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
        <div class="banner-text">
            <h2>Side love</h2>
            <p>cheat anybody with anybody</p>
        </div>	
    </div>
    </div>
  </div>
            </div>	   		    
		</div>
	</div>
</div>
</section>
</body>
<script>
    $(document).ready(function(){
        $('form').on('submit',function(event){
            event.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url:'authentication/auth.php',
                method: 'POST',
                data: formData
            }).done(function(data){
                if(data == 1){
                    window.location.href = "http://localhost/PHP-ME/LiveChat/index.php";
                }
            })
        })
    })
    
</script>
</html>