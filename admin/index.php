<?php
require("../config/config.php");
session_start();
if (empty($_SESSION['user_id']) && empty($_SESSION['login']) && empty($_SESSION['user_role']) && empty($_SESSION['username'])) {
  header("location:./login.php");
}
if ($_SESSION['user_role'] == 0) {
  echo "<script>window.location.href='../index.php'</script>";
}
include_once("./header.php");
if (isset($_GET['id'])) {
  $deleteId = $_GET['id'];
  $query2 = "DELETE FROM posts WHERE id = $deleteId";
  mysqli_query($dbConnection, $query2);
  echo "<script>window.location.href='index.php'</script>";
}


?>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class=" d-flex justify-content-between">
              <h3 class="">Blogs</h3>
              <a href="./add.php" class=" btn btn-success">+Add Blog</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 40px">#</th>
                  <th>Title</th>
                  <th>Content</th>
                  <th style="width: 120px">Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if (!empty($_GET['pageno'])) {
                  $pageno = $_GET['pageno'];
                } else {
                  $pageno = 1;
                }
                $numberOfBlog = 4;
                $offset = ($pageno - 1) * $numberOfBlog;
                $query = "SELECT * FROM posts ORDER BY id DESC";
                $result = mysqli_query($dbConnection, $query);
                $rawtable = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $totalPages = ceil(count($rawtable) / $numberOfBlog);

                if (isset($_POST['search'])) {

                  $pageno = 0;
                  $searchValue = $_POST['searchValue'];
                  $query4 = "SELECT * FROM posts WHERE title LIKE '%$searchValue%' ORDER BY id DESC";
                  $result4 = mysqli_query($dbConnection, $query4);
                  $table = mysqli_fetch_all($result4, MYSQLI_ASSOC);
                } else {


                  $query3 = "SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$numberOfBlog";
                  $result3 = mysqli_query($dbConnection, $query3);
                  $table = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                }

                if ($table) {
                  $i = 1;
                  foreach ($table as $row) {
                ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><?php echo $row['title']; ?></td>
                      <td>
                        <?php echo substr($row['content'], 0, 100); ?>
                      <td>
                        <a href="./edit.php?id=<?php echo $row['id'] ?>" class=" me-1">Edit</a> /
                        <a href="./index.php?id=<?php echo $row['id'] ?>" class="text-danger" onclick="return confirm('are you sure you want to delete this item')" type="button">Delete</a>
                      </td>
                    </tr>
                <?php
                    $i++;
                  }
                }
                ?>
                <!-- <tr>
                      <td>1.</td>
                      <td>Update software</td>
                      <td>
                        Sample content
                      <td>
                        <a href="" class=" me-1">Edit</a> /
                        <a href="" class="text-danger">Delete</a>
                      </td>
                    </tr> -->
              </tbody>
            </table>
            <br>
            <nav aria-label="Page navigation example" class=" d-flex justify-content-center">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="?pageno=1">
                    First
                  </a>
                </li>
                <li class="page-item <?php if ($pageno <= 1) {
                                        echo "disabled";
                                      } ?>">
                  <a class="page-link" href="<?php if ($pageno <= 1) {
                                                echo "#";
                                              } else {
                                                echo "?pageno=" . ($pageno - 1);
                                              } ?>">Prev</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#"><?php echo $pageno; ?></a></li>
                <li class="page-item <?php if ($pageno >= $totalPages) {
                                        echo "disabled";
                                      } ?>">
                  <a class="page-link" href="<?php if ($pageno >= $totalPages) {
                                                echo "#";
                                              } else {
                                                echo "?pageno=" . ($pageno + 1);
                                              } ?>">Next</a>
                </li>
                <li class="page-item">
                  <a class="page-link" href="?pageno=<?php echo $totalPages; ?>">
                    Last
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- /.card-body -->

        </div>


      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
include_once("./footer.php");
?>