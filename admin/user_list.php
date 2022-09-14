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

  <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="card">
          <div class="card-header">
            <div class=" d-flex justify-content-between">
              <h3 class="">User_Lists</h3>
              <a href="./add_user.php" class=" btn btn-success">+Add Account</a>
            </div>
          </div>
         
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 40px">#</th>
                  <th style="width: 60px">Photo</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Role</th>
                  <th >Action</th>
                </tr>
              </thead>
              <tbody>

                <?php
                if (!empty($_GET['pageno'])) {
                  $pageno = $_GET['pageno'];
                } else {
                  $pageno = 1;
                }
                $numberOfBlog = 6;
                $offset = ($pageno - 1) * $numberOfBlog;
                $query = "SELECT * FROM users ";
                $result = mysqli_query($dbConnection, $query);
                $rawtable = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $totalPages = ceil(count($rawtable) / $numberOfBlog);



                  $query3 = "SELECT * FROM users LIMIT $offset,$numberOfBlog";
                  $result3 = mysqli_query($dbConnection, $query3);
                  $table = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                

                if ($table) {
                  $i = 1;
                  foreach ($table as $row) {
                ?>
                    <tr>
                      <td><?php echo $i ?></td>
                      <td><img class=" rounded-circle" style="width:50px; height:50px" src="../image/<?php echo$row['image']; ?>" alt=""></td>
                      <td><?php echo $row['name']; ?></td>
                      <td>
                        <?php echo $row['email']; ?>
                  </td>
                      <td>
                        <?php echo $row['password']; ?>
                  </td>
                      <td>
                        <?php if ($row['role'] == 1) {
                            echo "Admin";
                        } else{
                            echo "User";
                        } ?>
                      </td>
                      <td>
                        <a href="./edit_user.php?id=<?php echo $row['id'] ?>" class=" me-1">Edit</a> /
                        <a href="./user_list.php?id=<?php echo $row['id'] ?>" class="text-danger" onclick="return confirm('are you sure you want to delete this item')" type="button">Delete</a>
                      </td>
                    </tr>
                <?php
                    $i++;
                  }
                }
                ?>
            
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
          

        </div>


      </div>
    </div>
 
  </div>

  
</div>
<?php
include_once("./footer.php");
?>