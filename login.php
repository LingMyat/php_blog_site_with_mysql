<?php 
    session_start();
    require("./config/config.php");
    $query1 = "SELECT email FROM users";
    $result = mysqli_query($dbConnection,$query1);
    $table = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $emailArr = [];
    foreach($table as $row){
            array_push($emailArr,$row['email']);
    }
    $errEmail = $errPassword = $email = $password = "";
    if (isset($_POST['sign_in'])) {
        empty($_POST['email'])?$errEmail="this field is require!":$email = $_POST['email'];
        empty($_POST['password'])?$errPassword="this field is require!":$password = $_POST['password'];
        if ($email<>'' && $password<>"") {
            if (in_array($email,$emailArr)) {
                $query2 = "SELECT * FROM users WHERE email='$email'";
                $result2 = mysqli_query($dbConnection,$query2);
                $table2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
                if ($password === $table2[0]['password'] ) {
                        $_SESSION['user_role'] =  $table2[0]['role'];
                        $_SESSION['user_id'] = $table2[0]['id'];
                        $_SESSION['user_name'] = $table2[0]['name'];
                        $_SESSION['login'] = time();
                        header("location:./index.php");
                }else {
                    $errPassword = "your password is wrong please try again";
                }
            } else {
                $errEmail = "your email is not register";
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog | Log in</title>

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
      <a href="" class="h1"><b>Blog-</b>App</a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="./login.php" method="post">
        <div class="input-group mb-2">
          <input type="email" value="<?php echo$email;?>" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class=" text-danger"><?php echo$errEmail; ?></div>
        <div class="input-group mt-3 mb-2">
          <input type="password" value="<?php echo$password;?>" name="password" class="form-control" placeholder="Password">
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
                Remember Me
              </label>
            </div>
            
          </div>
          <div class="col-4 ">
            <button type="submit" name="sign_in" class="btn mb-2 btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
  </div>
</div>
<!-- /.login-box -->
</div>
<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>
</body>
</html>
