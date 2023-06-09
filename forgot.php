<?php
include 'connection.php';
?>
<html>
<head>
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
        }
        
        body {
            display: flex;
            align-items: center;
        }
        
        .loader {
            display: none;
            text-align: center;
        }
        
        .loader.active {
            display: block;
        }
    </style>
</head>

<body>
<div class="container d-flex justify-content-center ">
    <div class="table-responsive">
        <h3 align="center">Forgot Password</h3>
        <h6> A reset link will be sent to your email</h6>
        
        <br/>
        <div class="box ">
            <form id="validate_form" method="POST" action="forgotpassword.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="E-mail" name="email">
                </div>
                <div class="form-group ">
                    <button type="submit" class="btn btn-primary" name="send-reset-link">Send link</button>
                </div>
                <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
                <div class="loader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('validate_form');
    const loader = document.querySelector('.loader');

    form.addEventListener('submit', function () {
        loader.classList.add('active');
    });
</script>
</body>
</html>




<!-- first code -->

<!-- <?php
include '../config.php';
?>
<html>  
<head>  
    <title>Forgot Password</title>  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>


<body>
<div class="container d-flex-center">  
    <div class="table-responsive">  
    <h3 align=center>Forgot Password</h3><br/>
    <div class="box">
     <form id="validate_form" method="POST" action="forgotpassword.php" >  
       <div class="form-group">
       <input type="text" placeholder="E-mail" name="email"></input>
      </div>
      <div class="form-group">
        <button type="submit" class="reset-btn" name="send-reset-link"> Send link</button>
    </div>
       
       <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
     </form>
     </div>
   </div>  
  </div>
</body>
</html> -->