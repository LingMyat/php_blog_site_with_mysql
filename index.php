<?php
require "./config/config.php";
session_start();
if (empty($_SESSION['user_id']) && empty($_SESSION['login']) && empty($_SESSION['user_role']) && empty($_SESSION['username'])) {
  header("location:./login.php");
}
if ($_SESSION['user_role'] == 1) {
  echo "<script>window.location.href='./admin/index.php'</script>";
}
include_once("./header.php");
?>

    
      
      <div class=" container-fluid">
      <h2 class=" text-center text-primary">Blog Posts</h2>
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

          if (isset($_POST['search'])) {

            $pageNo = 0;
            $searchValue = $_POST['searchValue'];
            $query3 = "SELECT * FROM posts WHERE title LIKE '%$searchValue%' ORDER BY id DESC";
            $result3 = mysqli_query($dbConnection, $query3);
            $table = mysqli_fetch_all($result3, MYSQLI_ASSOC);
          } else {


          $query2 = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numberOfBlogs";
          $result2 = mysqli_query($dbConnection, $query2);
          $table = mysqli_fetch_all($result2, MYSQLI_ASSOC);
          }

          
          foreach ($table as $row) {
          ?>
            <div class="col-md-4">
            <a href="./detail.php?id=<?php echo $row['id']; ?>&pageNo=<?php
             if ($pageNo < 1) {
                echo 1;
             }else{
              echo $pageNo;
             }
             ?>" class=" ">
              <div class="card card-widget">
                <div class="card-body">
                  <img class="img-fluid pad w-100" style="" src="./image/<?php echo $row['image']; ?>" alt="Photo">
                </div>
                <div class="card-footer">
                <h4 class="  text-md-start text-center"><?php echo $row['title']; ?></h4>
                </div>
              </div>
              </a>
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

<?php 
include_once("./footer.php");
?>