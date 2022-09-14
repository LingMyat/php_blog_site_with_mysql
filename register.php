<?php 
    
    require("./config/config.php");

    $errEmail = $errName = $errPassword = $email = $password = $name ="";
    if (isset($_POST['register'])) {
        empty($_POST['email'])?$errEmail="this field is require!":$email = $_POST['email'];
        empty($_POST['password'])?$errPassword="this field is require!":$password = $_POST['password'];
        empty($_POST['name'])?$errName="this field is require!":$name = $_POST['name'];
        if ($email<>'' && $password<>"" && $name <> "") {
            $query = "INSERT INTO users (name,email,password,role) VALUES ('$name','$email','$password',0)";
            mysqli_query($dbConnection,$query);
            header("location:login.php");
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
  <div class="card-header text-center">
      <a href="" class="h1"><b>Blog-</b>User</a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="./register.php" method="post">
      <div class="input-group mb-2">
          <input type="text" value="<?php echo$name;?>" name="name" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class=" text-danger"><?php echo$errName; ?></div>
        <div class="input-group mt-3 mb-2">
          <input type="email"  value="<?php echo$email;?>" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class=" text-danger"><?php echo$errEmail; ?></div>
        <div class="input-group mt-3 mb-2">
          <input type="text" value="<?php echo$password;?>" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="text-danger"><?php echo$errPassword; ?></div>
        <div class="row mt-3">
        <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Agee with team
              </label>
            </div>
            
          </div>
          <div class="col-4 ">
            <button type="submit" name="register" class="btn mb-2 btn-primary btn-block">Register</button>
          </div>
        </div>
      </form>
      <p class="mb-0">
        <a href="login.php" class="text-center">I already have a membership</a>
      </p>


      
      
        
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>