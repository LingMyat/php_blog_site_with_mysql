<?php
require "./config/config.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Widgets</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    * {
      scroll-behavior: smooth;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <div class="">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <h2 class=" text-center">Blog Posts</h2>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <div class=" container-fluid">
        <div class="row">
          <?php
          if (!empty($_GET['pageNo'])) {
            $pageNo = $_GET['pageNo'];
          } else {
            $pageNo = 1;
          }
          $numberOfBlogs = 6;
          $offset = ($pageNo - 1) * $numberOfBlogs;
          $query = "SELECT * FROM posts ";
          $result = mysqli_query($dbConnection, $query);
          $rawTable = mysqli_fetch_all($result, MYSQLI_ASSOC);
          $totalPages = ceil(count($rawTable) / $numberOfBlogs);
          $query2 = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numberOfBlogs";
          $result2 = mysqli_query($dbConnection, $query2);
          $table = mysqli_fetch_all($result2, MYSQLI_ASSOC);
          foreach ($table as $row) {
          ?>
            <div class="col-md-4">
              <div class="card card-widget">
                <div class="card-body">
                  <img class="img-fluid pad w-100" style="" src="./image/<?php echo $row['image']; ?>" alt="Photo">
                </div>
                <div class="card-footer">
                <h4 class="  text-md-start text-center"><?php echo $row['title']; ?></h4>
                </div>
              </div>
            </div>
          <?php
          }
          ?>


        </div>
        <nav aria-label="Page navigation example" class=" d-flex justify-content-center">
          <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?pageNo=1">First</a></li>
            <li class="page-item <?php if ($pageNo <= 1) {
                                    echo 'disabled';
                                  } ?>">
              <a class="page-link" href="<?php if ($pageNo <= 1) {
                                            echo '#';
                                          } else {
                                            echo "?pageNo=" . ($pageNo - 1);
                                          } ?>">Prev</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#"><?php echo $pageNo; ?></a></li>
            <li class="page-item <?php if ($pageNo >= $totalPages) {
                                    echo 'disabled';
                                  } ?>">
              <a class="page-link" href="<?php if ($pageNo >= $totalPages) {
                                            echo '#';
                                          } else {
                                            echo "?pageNo=" . ($pageNo + 1);
                                          } ?>">Next</a>
            </li>
            <li class="page-item"><a class="page-link" href="?pageNo=<?php echo $totalPages ?>">Last</a></li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

  <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
  </a>



  <footer class="main-footer" style="margin-left:0 !important ;">

    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2022-2023 <a href="https://adminlte.io">Ling Myat Aung</a>.</strong> All rights reserved.
  </footer>

  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>