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
            <h1 class="m-0">Manage All Post</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage Post</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-12">

        <?php 
          // Tarnary Condition - Its an if else
          // Condition ? True : False ;
          $do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

          // Read All The Users
            if ($do == "Manage") 
            { ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage All Post</h3>
              </div>
                <div class="card-body">
                  <table class="table table-bordered"> 
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#SL</th>
                          <th scope="col">Thumbnail</th>
                          <th scope="col">Title</th>
                          <th scope="col">Category</th>
                          <th scope="col">Author</th>
                          <th scope="col">Post Tags</th>
                          <th scope="col">Status</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                        <tbody>
                          <?php 
                          $query = "SELECT * FROM post ORDER BY post_id DESC";
                          $allPosts = mysqli_query($connect, $query);
                          $count = mysqli_num_rows($allPosts);

                          if ( $count <= 0 ) 
                          {
                            echo '<div class=" alert alert-info font-weight-bold font-italic text-uppercase text-center text-gray-dark h3" > No Post Found Yet. Add New Post.!! </div>';
                          }

                          $i = 0;
                          while( $row = mysqli_fetch_assoc($allPosts) )
                           {
                            $post_id       = $row['post_id'];
                            $title         = $row['title'];
                            $description   = $row['description'];
                            $category_id   = $row['category_id'];
                            $auther_id     = $row['adder_id']; 
                            $post_tags     = $row['tags']; 
                            $status        = $row['status'];
                            $post_date     = $row['post_date'];
                            $image         = $row['image'];
                            $i++;
                            ?>

                            <tr>

                              <th scope="row"><?php echo $i ; ?></th>
                              <th scope="row">
                                <?php 
                                  if ( !empty($image) ) 
                                  { ?>
                                  <img src="dist/img/posts/<?php echo $image; ?>" width="50">
                                  <?php }

                                  else 
                                  { ?>
                                    <img src="dist/img/posts/default.png" width="50">
                                  <?php }
                                 ?>
                              </th>
                              <th scope="row"> <?php echo $title; ?> </th>
                              <th scope="row"> 
                                <?php 
                                  $query = "SELECT * FROM category WHERE cat_id = '$category_id'";
                                  $category_name = mysqli_query($connect, $query);
                                  while ( $row = mysqli_fetch_array($category_name) ) 
                                  {
                                     $cat_id    = $row['cat_id'];
                                     $cat_name  = $row['cat_name'];
                                     
                                     echo $cat_name; 
                                  }
                                 ?>
                              </th>
                              <th scope="row"><?php 
                                  $query = "SELECT * FROM users WHERE user_id = '$auther_id'";
                                  $auther_name = mysqli_query($connect, $query);
                                  while ( $row = mysqli_fetch_array($auther_name) ) 
                                  {
                                     $user_id    = $row['user_id'];
                                     $user_name  = $row['fullname'];
                                     
                                     echo $user_name; 
                                  }?></th>
                              <th scope="row"> <?php echo $post_date; ?> </th>
                              <th scope="row"><?php
                                  if ( $status == 1 ) 
                                  { ?>
                                     <span class="badge badge-success">Active</span>
                                  <?php }
                                  elseif ( $status == 2 ) 
                                  { ?>
                                     <span class="badge badge-danger">In-Active</span>
                                 <?php } ?></th>

                              <th scope="row"><?php echo $post_date; ?></th>
                               
                              <td>
                                <div class="action-bar">
                                  <ul>
                                    <li><a href="post.php?do=Edit&p_id=<?php echo $post_id; ?>"><i class="fa fa-edit"></i></a></li>
                                    <li><a href="" data-toggle="modal" data-target="#deletePost<?php echo $post_id; ?>"><i class="fa fa-trash"></i></a></li>
                                  </ul>
                                </div>
                              </td>

                              <!--Delet User Confirmation Modal -->
                            <div class="modal fade" id="deletePost<?php echo $post_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"> Do You Confirm To Delete This Post.? </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">


                                    <form action="post.php?do=Delete&d_id=<?php echo $post_id; ?>" method ="POST">

                                    <input type="submit" name="deleteUser" class="btn btn-danger" value="Confirm">

                                      <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                    </form>

                                  </div>
                                </div>
                              </div>
                            </div>
                          </tr>

                           <?php }
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php }

            else if ( $do == "Add" ) 
            { ?>
              
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Add New Post</h3>
                </div>

                <div class="card-body">
                  <!--- Add Users Form Start --->
                  <form action="post.php?do=Insert" method="POST" enctype="multipart/form-data">
                    <div class="row">

                      <div class="col-lg-6">
                        <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required="required" autocomplete="off">
                        </div>

                        <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                          <option value="0">Please Select The Category / Sub Category</option>
                          <?php 
                            $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
                            $parent_cat = mysqli_query($connect, $query);
                            while ( $row = mysqli_fetch_assoc($parent_cat) ) 
                            {
                             $cat_id    = $row['cat_id'];
                             $cat_name  = $row['cat_name'];
                             $parent_id = $row['parent_id'];
                             ?>
                              <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?> </option>

                             <?php 
                             $query2 =  "SELECT * FROM category WHERE parent_id = $cat_id ORDER BY cat_name ASC";
                             $child_cat = mysqli_query($connect, $query2);
                             while ( $row = mysqli_fetch_assoc($child_cat) ) 
                              {
                               $cat_id    = $row['cat_id'];
                               $cat_name  = $row['cat_name'];
                                ?>
                                <option value="<?php echo $cat_id; ?>">-- <?php echo $cat_name; ?> </option>

                                <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>Meta Tags</label>
                        <input type="text" name="post_tags" class="form-control" required="required" autocomplete="off">
                        </div>

                         <div class="form-group">
                        <label>User Status</label>
                        <select name="status" class="form-control" >
                          <option value="2">Please Select The Status</option>
                          <option value="1">Active</option>
                          <option value="2">Inactive</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label>Photo Uplode Here</label>
                            <input type="file" name="image" class="form-control-file">
                          </div>
                      </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" id="inputDescription" rows="4" class="form-control"></textarea>
                          </div>

                          
                          <div class="form-group">
                            <input type="submit" name="publish" class="btn btn-info" value="Publish Post">
                          </div>
                      </div>
                    </div> 
                    
                  </form>
                  <!--- Add Users Form End --->
                </div>
              </div>
            <?php }

            else if ( $do == "Insert" ) 
            {
              if ( isset ( $_POST['publish'] ) ) 
              {
                $title         = mysqli_real_escape_string($connect, $_POST['title']);
                $description   = mysqli_real_escape_string($connect, $_POST['description']);
                $category_id   = $_POST['category_id'];
                $auther_id     = $_SESSION['user_id'];               
                $tags          = mysqli_real_escape_string($connect, $_POST['tags']);          
                $status        = $_POST['status'];

                // Take the image file & image name.
                $image      = $_FILES['image']['name'];
                // Take the image file & temporary folder name.
                $image_tmp  = $_FILES['image']['tmp_name'];
                  
                 if ( !empty($image) ) 
                 {
                    // Change the image name
                    $randomNumber = rand(0, 9999999);
                    $imageFile = $randomNumber.$image;

                    // Move the file to it's destination folder
                    move_uploaded_file($image_tmp, "dist/img/posts/" . $imageFile);

                    $query = "INSERT INTO post ( title, description, category_id, auther_id, tags, status, image, post_date) VALUES ('$title','$description','$category_id','$auther_id','$tags','$status', '$imageFile', now() )";

                    $publishPost = mysqli_query($connect, $query);

                    if ( $publishPost) 
                    {
                      header("Location: post.php?do=Manage");
                    }
                    else
                    {
                      die("MySQL Database Error" . mysqli_error($connect));
                    }
                  } 

                  else 
                 {
                   
                    $query = "INSERT INTO post ( title, description, category_id, auther_id, tags, status, post_date) VALUES ('$title','$description','$category_id','$auther_id','$tags','$status', now() )";

                    $publishPost = mysqli_query($connect, $query);

                      if ( $publishPost) 
                      {
                        header("Location: post.php?do=Manage");
                      }
                      else
                      {
                        die("MySQL Database Error" . mysqli_error($connect));
                      }
                  } 
              }   
            }
            
            else if ( $do == "Edit" ) 
            {
              if (isset($_GET['p_id']) ) 
              {
                $p_id = $_GET['p_id'];

                $query = "SELECT * FROM post WHERE post_id = '$p_id'";

                $selectPost = mysqli_query($connect, $query);

                while ( $row = mysqli_fetch_assoc($selectPost) )
                {
                  $post_id       = $row['post_id'];
                  $title         = $row['title'];
                  $description   = $row['description'];
                  $category_id   = $row['category_id'];
                  $auther_id     = $row['adder_id'];
                  $tags          = $row['tags'];
                  $status        = $row['status'];
                  $post_date     = $row['post_date'];
                  $image         = $row['image'];
                ?>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Update Post Information</h3>
                </div>

                <div class="card-body">
                  <!--- Add Users Form Start --->
                  <form action="post.php?do=Update" method="POST" enctype="multipart/form-data">
                    <div class="row">

                      <div class="col-lg-6">
                        <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" required="required" autocomplete="off" value="<?php echo $title; ?>">
                        </div>

                        <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control">
                          <option value="0">Please Select The Category / Sub Category</option>
                          
                          <?php 
                            $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
                            $parent_cat = mysqli_query($connect, $query);
                            while ( $row = mysqli_fetch_assoc($parent_cat) ) 
                            {
                             $cat_id    = $row['cat_id'];
                             $cat_name  = $row['cat_name'];
                             $parent_id = $row['parent_id'];
                             ?>
                              <option value="<?php echo $cat_id; ?>" <?php if ($category_id == $cat_id) { echo 'selected'; } ?> ><?php echo $cat_name; ?> </option>

                             <?php 
                             $query2 =  "SELECT * FROM category WHERE parent_id = $cat_id ORDER BY cat_name ASC";
                             $child_cat = mysqli_query($connect, $query2);
                             while ( $row = mysqli_fetch_assoc($child_cat) ) 
                              {
                               $cat_id    = $row['cat_id'];
                               $cat_name  = $row['cat_name'];
                                ?>
                              <option value="<?php echo $cat_id; ?>" <?php if ($category_id == $cat_id) { echo 'selected'; } ?> >-- <?php echo $cat_name; ?> </option>

                                <?php 
                              }
                            }
                          ?>
                        </select>
                        </div>

                        <div class="form-group">
                        <label>Meta Tags</label>
                        <input type="text" name="tags" class="form-control" value="<?php echo $tags; ?>" required="required" autocomplete="off">
                        </div>

                         <div class="form-group">
                        <label>Post Status</label>
                        <select name="status" class="form-control" >
                          <option value="2">Please Select The Status</option>
                          <option value="1" <?php if ( $status == 1){ echo 'selected';} ?>>Active</option>
                          <option value="2" <?php if ( $status == 2){ echo 'selected';} ?>>Inactive</option>
                        </select>
                        </div>

                         <div class="form-group">
                            <label>Photo Uplode Here</label>

                            <?php 
                            if ( !empty($image) ) 
                            { ?>
                            <img src="dist/img/posts/<?php echo $image; ?>" style="display: block; margin-bottom: 15px; width: 160px;">
                            <?php }

                            else 
                            { ?>
                              <h4>No Post Thumbnail Found</h4>
                            <?php }
                             ?>

                            <input type="file" name="image" class="form-control-file">
                          </div>
                      </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                          <label>Description</label>
                          <textarea name="description" id="inputDescription" rows="4" class="form-control"><?php echo $description; ?></textarea>
                          </div>

                          <div class="form-group">
                            <input type="hidden" name="postUpdateID" value="<?php echo $post_id; ?>">
                            <input type="submit" name="updatepost" class="btn btn-info" value="Save Changes">
                          </div>
                      </div>
                    </div> 
                    
                  </form>
                  <!--- Add Users Form End --->
                </div>
              </div>

               <?php }
              }
            }

            else if ( $do == "Update" ) 
            {
              if ( isset ( $_POST['updatepost'] ) ) 
              {
                $updatePostID  = $_POST['postUpdateID'];
                $title         = mysqli_real_escape_string($connect, $_POST['title']);
                $description   = mysqli_real_escape_string($connect, $_POST['description']);
                $category_id   = $_POST['category_id'];
                $auther_id     = $_SESSION['user_id'];               
                $tags          = mysqli_real_escape_string($connect, $_POST['tags']);          
                $status        = $_POST['status'];

                // Take the image file & image name.
                $image      = $_FILES['image']['name'];
                // Take the image file & temporary folder name.
                $image_tmp  = $_FILES['image']['tmp_name'];

                if ( !empty($image) ) 
                {
                  // Change the image name
                  $randomNumber = rand(0, 9999999);
                  $imageFile = $randomNumber.$image;

                  // Move the file to it's destination folder
                  move_uploaded_file($image_tmp, "dist/img/posts/" . $imageFile);

                  // Old Image Delete
                  $deletePostThumbnail = "SELECT * FROM post WHERE post_id = '$updatePostID'";
                  $removeImage = mysqli_query($connect, $deletePostThumbnail);
                  while ($row = mysqli_fetch_assoc($removeImage))
                  {
                  $rImage = $row['image'];
                  unlink("dist/img/posts/" . $rImage);
                  }

                  $query = "UPDATE post SET title='$title', description='$description', category_id='$category_id', adder_id='$adder_id', tags='$tags', status='$status', image='$imageFile' WHERE post_id = '$updatePostID'";

                  $updatePostInfo = mysqli_query($connect, $query);
                  if ($updatePostInfo) 
                  {
                    header("Location: post.php?do=Manage");
                  }
                  else
                  {
                    die("MySQL Database Error." . mysqli_error($connect));
                  }
                }
                
                else
                {
                  $query = "UPDATE post SET title='$title', description='$description', category_id='$category_id', adder_id='$adder_id', tags='$tags', status='$status' WHERE post_id = '$updatePostID'";

                  $updatePostInfo = mysqli_query($connect, $query);
                  if ($updatePostInfo) 
                  {
                    header("Location: post.php?do=Manage");
                  }
                  else
                  {
                    die("MySQL Database Error." . mysqli_error($connect));
                  }
                }  
              }
            } 

            else if ( $do == "Delete" ) 
            {

              // Dalete User
              if ( isset($_GET['d_id']) ) 
              {
                $deletePostID = $_GET['d_id'];


                  //Remove the old image Form the folder
                  $removeQuery = "SELECT * FROM post WHERE post_id = '$deletePostID'";
                  $removeImage = mysqli_query($connect, $removeQuery);
                  while ($row = mysqli_fetch_assoc($removeImage))
                  {
                    $rImage = $row['image'];
                    unlink("dist/img/posts/" . $rImage);
                  }

                  $query = "DELETE FROM post WHERE post_id = '$deletePostID'";

                  $delPost = mysqli_query($connect, $query);


                  if ( $delPost) 
                  {
                    header("Location: post.php?do=Manage");
                  }
                  else{
                    die("MySQL Database Error." . mysqli_error($connect));
                  }
              }
            }

            else{
              header("Location: 404.php");
            }
           ?>



        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include "inc/admin/footer.php"; ?>