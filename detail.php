<?php 
require "./config/config.php";
session_start();
include_once("./header.php");
if (empty($_GET['id']) && empty($_GET['pageNo'])) {
  echo "<script>window.location.href='index.php'</script>";
}


// For show blog query
$pageNo = $_GET['pageNo'];
$currentId = $_GET['id'];
$currentUser = $currentUserTable[0]["name"];
$query = "SELECT * FROM posts WHERE id = '$currentId' ORDER BY id DESC";
$result = mysqli_query($dbConnection,$query);
$table = mysqli_fetch_all($result,MYSQLI_ASSOC);
$currentBlogId = $table[0]['id'];
// For comments set query 
if (!empty($_POST['comment'])) {
      $comment =  $_POST['comment'];
      $query2 = "INSERT INTO comments (content,name,post_id) VALUES ('$comment','$currentUser','$currentBlogId')";
      mysqli_query($dbConnection,$query2);
      echo "<script>window.location.href='./detail.php?id=$currentId&pageNo=$pageNo'</script>";
}
// For comments show query
$query3 ="SELECT * FROM comments WHERE post_id = '$currentId'";
$result3 = mysqli_query($dbConnection,$query3);
$table3 = mysqli_fetch_all($result3,MYSQLI_ASSOC);
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
                  <h3 class=" mb-3" >
                    <?php echo $table[0]['title']; ?>
                  </h3>
                <p><?php echo $table[0]['content']; ?></p>
                  </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer card-comments">
                <h3 class=" mb-3">Comments</h3>
                  <?php 
                  if (!$table3 == []) {
                    foreach($table3 as $row){
                      $currentHuman = $row['name'];
                      $queryTakeImage = "SELECT image FROM users where name = '$currentHuman'";
                      $result4 = mysqli_query($dbConnection,$queryTakeImage);
                      $imgArr = mysqli_fetch_all($result4,MYSQLI_ASSOC);

                  ?>
                    <div class="card-comment">
                  <img class="img-circle img-sm" src="./image/<?php echo $imgArr[0]['image'] ?>" alt="User Image">
                  <div class="comment-text">
                    <span class="username">
                    <?php echo$row['name']; ?>
                      <span class="text-muted float-right"><?php echo$row['created']; ?></span>
                    </span>
                    <?php echo$row['content']; ?>
                    <!-- It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout. -->
                  </div>
                </div>
                  <?php

                    }
                  } else {
                    echo "There is no comments yet!";
                  }
                  
                  ?>
                
              
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="" method="post">
                  
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" name="comment" class="form-control form-control-sm" placeholder="Press enter to post comment">
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