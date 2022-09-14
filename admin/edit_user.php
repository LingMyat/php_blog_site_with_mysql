<?php 
    session_start();
    require("../config/config.php");
    if (empty($_SESSION['user_id']) && empty($_SESSION['login'])) {
      header("location:./login.php");
    }else{
      $author_id = $_SESSION['user_id'];
    }
    include_once("./header.php");
    $errName = $errEmail =$errImage = $errPassword = $name = $email = $password = $image = '';
    $currentId = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = '$currentId' ";
    $result = mysqli_query($dbConnection,$query);
    $table = mysqli_fetch_all($result,MYSQLI_ASSOC);

    

    $currentName = $table[0]['name'];
    $currentEmail = $table[0]['email'];
    $currentPassword = $table[0]['password'];
    $currentImage = $table[0]['image'];
    $currentRole = $table[0]['role'];


    if (isset($_POST['save'])) {
       
        empty($_POST['name'])?$errName="this field is require!":$name = $_POST['name'];
        empty($_POST['email'])?$errEmail="this field is require!":$email = $_POST['email'];
        empty($_POST['password'])?$errPassword="this field is require!":$password = $_POST['password'];
        empty($_FILES['image']['name'])?$errImage="this field is require!":$image = $_FILES['image']['name'];
        if ($_POST['role']== 'Admin') {
            $role = 1;
        } else {
            $role = 0;
        }

        if ($name <>'' && $email<>''&& $password<>'' && $image <> '') {
          $file = '../image/'.$image;
          $fileType = pathinfo($file,PATHINFO_EXTENSION);
          if ($fileType <>'png' && $fileType <> 'jpg' && $fileType <> "jpeg") {
            $errImage = 'make sure your image type is png, jpg or jpeg';
          } else {
            move_uploaded_file($_FILES['image']['tmp_name'],$file);
            $query = "UPDATE users SET name='$name',email='$email',password='$password',role='$role', image='$image' WHERE id ='$currentId'";
            mysqli_query($dbConnection,$query);
            echo "<script>window.location.href='user_list.php'</script>";
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
                <h3 class="card-title">Edit Accounts</h3>
              </div>

              
                <div class="card-body">
                
                
               <form action="" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" value="<?php if (isset($_POST['save'])) {
                        echo $name;
                    }else{
                        echo $currentName;
                    } ?>" name="name" class="form-control" id="exampleInputName" >
                    <span class=" text-danger"><?php echo $errName?></span>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" value="<?php if (isset($_POST['save'])) {
                        echo $email;
                    }else{
                        echo $currentEmail;
                    } ?>" name="email" class="form-control" id="exampleInputEmail1" >
                    <span class=" text-danger"><?php echo $errEmail?></span>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="text" value="<?php if (isset($_POST['save'])) {
                        echo $password;
                    }else{
                        echo $currentPassword;
                    } ?>" name="password" class="form-control" id="exampleInputPassword" >
                    <span class=" text-danger"><?php echo $errPassword?></span>
                  </div>

                  <div class="form-group">
                  <label>Role</label>
                  <select name="role" class="form-control select2">
                    <option <?php if ($currentRole == 1) {
                        echo"selected='selected'";
                    } ?>>Admin</option>
                    <option <?php if ($currentRole == 0) {
                        echo"selected='selected'";
                    } ?> >User</option>
                  </select>
                </div>

               <div class="mb-3">
                <img style="width: 230px; height: auto;" src="../image/<?php echo$currentImage ?>" alt="" srcset="">
                 <label for="formFile" class="form-label ">current image</label>
                <input class=" form-control mt-2" name="image" type="file" id="formFile">
                <span class=" text-danger"><?php echo $errImage?></span>
                </div>
                <div class="col d-flex justify-content-between">
                        <a href="./user_list.php" class="btn text-white btn-success">Cancel</a>
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