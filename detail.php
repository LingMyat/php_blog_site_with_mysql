<?php 
require "./config/config.php";
session_start();
include_once("./header.php");
if (empty($_GET['id']) && empty($_GET['pageNo'])) {
  echo "<script>window.location.href='index.php'</script>";
}
$pageNo = $_GET['pageNo'];
$currentId = $_GET['id'];
$query = "SELECT * FROM posts WHERE id = '$currentId'";
$result = mysqli_query($dbConnection,$query);
$table = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
    <div class="row">
          <div class="col">
            <!-- Box Comment -->
            <div class="card ">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="./image/mygf (2).jpg" alt="User Image">
                  <span class="username"><a href=""> Ling Myat Aung </a></span>
                  <span class="description">Shared publicly - <?php echo $table[0]['created']; ?></span>
                </div>

                <div class=" card-tools">
                    <a href="./index.php?pageNo=<?php echo $pageNo ?>" class=" btn btn-success">Back to blogs</a>
                </div>
            
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                <img class="img-fluid m-auto col-lg-10" src="./image/<?Php echo $table[0]['image']; ?>" alt="Photo">
                </div>
                
                  <div class=" mt-3">
                  <h2 class="">
                    <?php echo $table[0]['title']; ?>
                  </h2>
                <p><?php echo $table[0]['content']; ?></p>
                  </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="dist/img/user3-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="dist/img/user4-128x128.jpg" alt="User Image">

                  <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <img class="img-fluid img-circle img-sm" src="dist/img/user4-128x128.jpg" alt="Alt Text">
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
  </div>
    <!-- /.content -->

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
      <i class="fas fa-chevron-up"></i>
    </a>
  </div>
  <!-- /.content-wrapper -->

  <?php 
  include_once("./footer.php");
  ?>