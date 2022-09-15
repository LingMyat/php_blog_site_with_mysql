<?php 
require("./config/config.php");
$currentUserId = $_SESSION['user_id'];
$currentUserQuery = "SELECT * FROM users WHERE id = '$currentUserId'";
$currentUserResult = mysqli_query($dbConnection,$currentUserQuery);
$currentUserTable = mysqli_fetch_all($currentUserResult,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
  <!-- CSS only -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" /> -->
  <style>
    * {
      scroll-behavior: smooth;
    }
    .parent {
      position: relative;
      
    }
    .child {
      display: flex;
      padding: 0;
      justify-content: center;
      align-items: center;
      width: 15px;
      height: 15px;
      position: absolute;
      bottom: -5px;
      right: -3px;
      border-radius: 50%;
      border: 1px solid #fff;
      cursor: pointer;
    }

    .profileUpdateAlert{
      width: 350px;
      position: absolute;
      left: 10px;
      top: 0;
      z-index: 1;
      opacity: 1;
    }
    .addBtn{
      height: 25px;
      width: 25px;
    }
  </style>
</head>

<?php 
if (isset($_POST['next'])) {
  $newProfile = $_FILES['profile']['name'];
  $path = "./image/".$newProfile;
  move_uploaded_file($_FILES['profile']['tmp_name'],$path);
  $updateProfileId = $currentUserTable[0]["id"];
  $updateProfileQuery = "UPDATE users SET image = '$newProfile' WHERE id = '$updateProfileId'";
  mysqli_query($dbConnection,$updateProfileQuery);
  echo"<script>window.location.href='./index.php'</script>";
}
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header mb-3 d-flex justify-content-between navbar navbar-expand navbar-white navbar-light position-relative">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block w-50">
          <form class="form-inline" action="./index.php" method="post">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" name="searchValue" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" name="search" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav">
      <a href="./logout.php" class="btn btn-primary">Logout</a>
    </ul>
    <!-- Alert update profile picture -->
    <div class=" profileUpdateAlert card card-primary <?php 
    if (isset($_POST['updateBtn'])) {
          echo "d-block";
        }else{
          echo "d-none";
        }
        if (isset($_POST['back'])) {
          echo " "."d-none";
        }
        ?> ">
        <div class="card-header p-3">
          Are you sure! want to change your profile?
        </div>
        <div class="card-body">
          <form action="" class=" " method="post" enctype="multipart/form-data">
          <input type="file" name="profile" >
            <div class=" d-flex justify-content-between mt-3">
            <input class="btn btn-secondary " name="back" type="submit" value="Back">
            <input class="btn btn-primary" name="next" type="submit" value="Next">
            </div>
          </form>
        </div>
      </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">User Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image p-0 parent">
          <img src="./image/<?php echo$currentUserTable[0]["image"]; ?>" class="img-circle elevation-2" style="width:46px; height:46px;" alt="User Image">

          <div class="child">
            
          <form action="" method="post" class=" p-0" >
            <button class="addBtn d-flex justify-content-center align-items-center rounded-circle p-0" name="updateBtn" type="submit"><i class="fas fa-camera text-info p-0"></i></button>
          </form>
          </div>
        </div>
        <div class="info d-flex justify-content-center align-items-center">
          <a href="#" class="d-block"><?php echo$currentUserTable[0]["name"]; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="./index.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Blogs
                
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">

    
  