<?php 
    session_start();
    require("../config/config.php");
    if (empty($_SESSION['user_id']) && empty($_SESSION['login'])) {
      header("location:./login.php");
    }else{
      $author_id = $_SESSION['user_id'];
    }
    include_once("./header.php");
    $errContent = $errTitle = $errImage = $content = $title = $image = '';
    $currentId = $_GET['id'];
    $query = "SELECT * FROM posts WHERE id = $currentId ";
    $result = mysqli_query($dbConnection,$query);
    $table = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $currentTitle = $table[0]['title'];
    $currentContent = $table[0]['content'];
    $currentImage = $table[0]['image'];

    if (isset($_POST['save'])) {
       
        empty($_POST['title'])?$errTitle="this field is require!":$title = $_POST['title'];
        empty($_POST['content'])?$errContent="this field is require!":$content = $_POST['content'];
        empty($_FILES['image']['name'])?$image= $currentImage :$image = $_FILES['image']['name'];


        if ($content <>'' && $title<>'' && $image <> '') {
          $file = '../image/'.$image;
          $fileType = pathinfo($file,PATHINFO_EXTENSION);
          if ($fileType <>'png' && $fileType <> 'jpg' && $fileType <> "jpeg") {
            $errImage = 'make sure your image type is png, jpg or jpeg';
          } else {
            move_uploaded_file($_FILES['image']['tmp_name'],$file);
            $query = "UPDATE posts SET title='$title',content='$content',image='$image' WHERE id =$currentId";
            mysqli_query($dbConnection,$query);
            echo "<script>window.location.href='index.php'</script>";
          } 
         
        }

    }

  ?>
  <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col">
          <div class="card">
            <div class="col">
            <div class="card ">
              <div class="card-header ">
                <h3 class="card-title">Edit Blog</h3>
              </div>

              
                <div class="card-body">
                
                
               <form action="" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                    <label for="exampleInputEmail1">Title</label>
                    <input type="text" value="<?php if (isset($_POST['save'])) {
                        echo $title;
                    }else{
                        echo $currentTitle;
                    } ?>" name="title" class="form-control" id="exampleInputEmail1" >
                    <span class=" text-danger"><?php echo $errTitle?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleTextarea">Content</label>
                    <textarea name="content" id="exampleTextarea" class=" form-control" rows="8"><?php if (isset($_POST['save'])) {
                        echo $content;
                    }else{
                        echo $currentContent;
                    } ?></textarea>
                    <span class=" text-danger"><?php echo $errContent?></span>
                  </div>
               <div class="mb-3">
                <img style="width: 230px; height: auto;" src="../image/<?php echo$currentImage ?>" alt="" srcset="">
                 <label for="formFile" class="form-label ">current image</label>
                <input class=" form-control mt-2" name="image" type="file" id="formFile">
                </div>
                <div class="col d-flex justify-content-between">
                        <a href="./index.php" class="btn text-white btn-success">Cancel</a>
                    <button type="save" name="save" class="btn btn-primary">Save</button>
                    </div>
               </form>
            </div>
            </div>
          </div>
        </div>
        </div>
    </div>
    </div>
    </div>
    
          
        

  <?php 
  include_once("./footer.php");
  ?>