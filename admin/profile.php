<?php
        include "inc/admin/header.php";
         include "inc/admin/topbar.php";
          include "inc/admin/menubar.php";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome Profile</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Blank Tamplate</li>
            </ol>
          </div><!-- /.col -->
          <!-- content here -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <?php 
          // Tarnary Condition - Its an if else
          // Condition ? True : False ;
          $do = isset($_GET['do']) ? $_GET['do'] : 'View'; 


           
            if ( $do == "View" ) 
            {
              $viewID = $_SESSION['user_id'];

              $query = "SELECT * FROM users WHERE user_id = '$viewID' ";

                $selectUser = mysqli_query($connect, $query);

                while ( $row = mysqli_fetch_assoc($selectUser) )
                {

                $user_id    = $row['user_id'];
                $fullname   = $row['fullname'];
                $username   = $row['username'];
                $email      = $row['email'];
                $password   = $row['password'];
                $phone      = $row['phone'];
                $gender     = $row['gender'];
                $address    = $row['address'];
                $status     = $row['status'];
                $user_role  = $row['user_role'];
                $join_date  = $row['join_date'];
                $image      = $row['image'];  
                ?>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Update Userr Information</h3>
                </div>

                <div class="card-body">
                  <!--- Add Users Form Start --->
                  <form action="profile.php?do=Update" method="POST" enctype="multipart/form-data">
                    <div class="row">

                      <div class="col-lg-6">
                        <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" required="required" autocomplete="off" value="<?php echo $fullname; ?>">
                        </div>

                        <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required="required" autocomplete="off" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required="required" autocomplete="off" value="<?php echo $email; ?>" readonly="readonly">
                        </div>
                        

                        <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="******">
                        </div>

                         <div class="form-group">
                        <label>Re-Type Password</label>
                        <input type="password" name="repassword" class="form-control" placeholder="******">
                        </div>
                        </div>

                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" value="<?php echo $gender; ?>">
                          <option value="2">Please Select The Gender</option>
                          <option value="1" <?php if ($gender == 1) {echo 'selected';} ?> >Male</option>
                          <option value="2" <?php if ($gender == 2) {echo 'selected';} ?> >Female</option>
                        </select>
                        </div>
                          
                        <div class="form-group">
                        <label>Phone No.</label>
                        <input type="text" name="phone" class="form-control" required="required" autocomplete="off" value="<?php echo $phone; ?>">
                        </div>

                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" required="required" autocomplete="off" value="<?php echo $address; ?>">
                        </div>

                        <div class="form-group">
                        <label>User Status</label>
                        <select name="status" class="form-control">
                          <option value="2">Please Select The Status</option>
                          <option value="1" <?php if ($status == 1) {echo 'selected';} ?> >Active</option>
                          <option value="2" <?php if ($status == 2) {echo 'selected';} ?> >Inactive</option>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>User Role</label>
                        <select name="user_role" class="form-control">

                          <option value="3">Please Select The Role</option>
                          <option value="1" <?php if ($user_role == 1) { echo 'selected'; } ?>>Super Admin</option>
                          <option value="2" <?php if ($user_role == 2) { echo 'selected'; } ?>>Editor</option>
                          <option value="3" <?php if ($user_role == 3) { echo 'selected'; } ?>>User</option>

                        </select>
                        </div>

                        <div class="form-group">
                          <label>Profile Picture</label> 
                          <br>
                          <?php 
                                if ( !empty($image) ) 
                                { ?>
                                <img src="dist/img/users/<?php echo $image; ?>" width="80px" height="80px" style="border-radius: 80%;">
                                <?php }

                                else
                                { 
                                  echo "No Picture Uploaded";
                                }
                          ?>
                          <br>
                          <input type="file" name="image" class="form-control-file">
                        </div>

                        <div class="form-group">
                          <input type="hidden" name="updateUserID" value="<?php echo $user_id ?>">
                          <input type="submit" name="savechange" class="btn btn-primary" value="Save Change">
                        </div>

                      </div>
                    </div> 
                    
                  </form>
                  <!--- Add Users Form End --->
                </div>
              </div>

               <?php }
              }
            

            else if ( $do == "Update" ) 
            {
              if ( isset ( $_POST['savechange'] ) ) 
              {
                $updateUserID = $_POST['updateUserID'];
                $fullname     = $_POST['fullname'];
                $username     = $_POST['username'];
                $email        = $_POST['email'];
                $gender       = $_POST['gender'];
                $phone        = $_POST['phone'];
                $address      = $_POST['address'];
                $status       = $_POST['status'];
                $user_role    = $_POST['user_role'];

                $password   = $_POST['password'];
                $repassword = $_POST['repassword'];

                // Take the image file & image name.
                $image      = $_FILES['image']['name'];
                // Take the image file & temporary folder name.
                $image_tmp  = $_FILES['image']['tmp_name'];

                ////////////////////////////////////////
                if ( !empty($password) && !empty($image)) 
                {
                  if ( $password == $repassword) 
                  {
                    // Encrypted Password
                    $hassedPass = sha1($password);

                    //Remove the old image Form the folder
                    $removeQuery = "SELECT * FROM users WHERE user_id = '$updateUserID'";
                    $removeImage = mysqli_query($connect, $removeQuery);
                    while ($row = mysqli_fetch_assoc($removeImage))
                    {
                    $rImage = $row['image'];
                    unlink("dist/img/users/" . $rImage);
                    }

                    // Change the image name
                    $randomNumber = rand(0,9999999);
                    $imageFile = $randomNumber.$image;

                    // Move the file to it's destination folder
                    move_uploaded_file($image_tmp, "dist/img/users/" . $imageFile);

                    $query = "UPDATE users SET fullname='$fullname', username='$username', email='$email', password='$hassedPass', gender='$gender', phone='$phone', address='$address', status='$status', user_role='$user_role', image='$imageFile' WHERE user_id = '$updateUserID'";

                    $updateUserInfo = mysqli_query($connect, $query);

                    if ($updateUserInfo) 
                    {
                     header("Location: profile.php?do=View ");
                    }
                    else{
                     die("MySQL Database Error." . mysqli_error($connect));
                    }
                  }
                }
            
                /////////////////////////////////////////////
                else if ( !empty($password) && empty($image) )
                {
                  
                  if ( $password == $repassword) 
                  {
                    // Encrypted Password
                    $hassedPass = sha1($password);

              
                    $query = "UPDATE users SET fullname='$fullname', username='$username', email='$email', password='$hassedPass', gender='$gender', phone='$phone', address='$address', status='$status', user_role='$user_role' WHERE user_id = '$updateUserID'";

                    $updateUserInfo = mysqli_query($connect, $query);

                  if ($updateUserInfo) 
                  {
                    header("Location: profile.php?do=View");
                  }
                  else{
                    die("MySQL Database Error." . mysqli_error($connect));
                  }

                  }
                }


                /////////////////////////////////////////////
                else if ( empty($password) && !empty($image)) 
                {

                  //Remove the old image Form the folder
                  $removeQuery = "SELECT * FROM users WHERE user_id = '$updateUserID'";
                  $removeImage = mysqli_query($connect, $removeQuery);
                  while ($row = mysqli_fetch_assoc($removeImage))
                  {
                    $rImage = $row['image'];
                    unlink("dist/img/users/" . $rImage);
                  }

                  
                  // Change the image name
                  $randomNumber = rand(0,9999999);
                  $imageFile = $randomNumber.$image;

                  // Move the file to it's destination folder
                  move_uploaded_file($image_tmp, "dist/img/users/" . $imageFile);

                  $query = "UPDATE users SET fullname='$fullname', username='$username', email='$email', gender='$gender', phone='$phone', address='$address', status='$status', user_role='$user_role', image='$imageFile' WHERE user_id = '$updateUserID'";

                  $updateUserInfo = mysqli_query($connect, $query);

                  if ($updateUserInfo) 
                  {
                    header("Location: profile.php?do=View");
                  }
                  else{
                    die("MySQL Database Error." . mysqli_error($connect));
                  }
                }


                ////////////////////////////////////////////
                else if ( empty($password) && empty($image))
                {
                  $query = "UPDATE users SET fullname='$fullname', username='$username', email='$email', gender='$gender', phone='$phone', address='$address', status='$status', user_role='$user_role' WHERE user_id = '$updateUserID'";

                  $updateUserInfo = mysqli_query($connect, $query);

                  if ($updateUserInfo) 
                  {
                    header("Location: profile.php?do=View");
                  }
                  else{
                    die("MySQL Database Error." . mysqli_error($connect));
                  }

                  }
                }
              } 

            else{
              header("Location: 404.php");
            }
           ?>

        <?php 
        ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  <!-- /.content-wrapper -->

<?php include "inc/admin/footer.php"; ?>