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
            <h1 class="m-0">View All Comments</h1>
          </div><!-- /.col -->

          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage Comments</li>
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

        if ( $_SESSION['user_role'] == 1 ) 
        { ?>

          <?php 
          // Tarnary Condition - Its an if else
          // Condition ? True : False ;
          $do = isset($_GET['do']) ? $_GET['do'] : 'Manage'; 

          // Read All The Users
            if ($do == "Manage") 
            { ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Manage All Comments</h3>
              </div>
                <div class="card-body" >
                  <table class="table table-bordered"> 
                    <thead class="thead-dark">
                        <tr>
                          <th scope="col">#SL</th>
                          <th scope="col">Post Titles</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Comments</th>
                          <th scope="col">Status</th>
                          <th scope="col">Date</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                        <tbody>
                          <?php 
                          $query = "SELECT * FROM comment ORDER BY cmt_id DESC";
                          $allComment = mysqli_query($connect, $query);
                          $i = 0;

                          while( $row = mysqli_fetch_assoc($allComment) )
                           {
                            $cmt_id        = $row['cmt_id'];
                            $cmt_post_id   = $row['cmt_post_id'];
                            $cmt_user_id   = $row['cmt_user_id'];
                            $cmt_email     = $row['cmt_email'];
                            $cmt_desc      = $row['cmt_desc'];
                            $reply_cmt_id  = $row['reply_cmt_id'];
                            $cmt_status    = $row['cmt_status'];
                            $cmt_date      = $row['cmt_date'];
                            $i++;
                            ?>

                            <tr>
                              <th scope="row"><?php echo $i; ?></th>
                              <th scope="row">
                                <?php 
                                $sql = "SELECT * FROM post WHERE post_id = '$cmt_post_id'";
                                $post_title_by_id = mysqli_query($connect, $sql);
                                while ( $row = mysqli_fetch_assoc($post_title_by_id) )
                                  {
                                    $post_id  = $row['post_id'];
                                    $title    = $row['title'];
                                    echo substr($title, 0, 25); 
                                  }

                                ?>....
                              </th>
                              <th scope="row"><?php echo $cmt_user_id; ?> </th>
                              <th scope="row"><?php echo $cmt_email; ?> </th>
                              <th scope="row"><?php echo $cmt_desc; ?> </th>
                              <th scope="row">
                                <?php
                                if ( $cmt_status == 1 ) 
                                { ?>
                                 <span class="badge badge-success">Active</span>
                                <?php }
                                elseif ( $cmt_status == 2 ) 
                                { ?>
                                   <span class="badge badge-danger">In-Active</span>
                                 <?php } ?>  </th>
                              <th scope="row"><?php echo $cmt_date; ?> </th>
                              <td>
                                <div class="action-bar">
                                  <ul>
                                    <li><a href="allcomments.php?do=Edit&c_id=<?php echo $cmt_id; ?>"><i class="fa fa-edit"></i></a></li>
                                    <li><a href="" data-toggle="modal" data-target="#deleteUser<?php echo $cmt_id; ?>"><i class="fa fa-trash"></i></a></li>
                                  </ul>
                                </div></td>

                                  <!--Delet User Confirmation Modal -->
                                <div class="modal fade" id="deleteUser<?php echo $cmt_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> Do You Confirm To Delete This Comment.? </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <form action="allcomments.php?do=Delete&d_id=<?php echo $cmt_id; ?>" method ="POST">
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

            else if ( $do == "Edit" ) 
            {
              if (isset($_GET['c_id']) ) 
              {
                $c_id = $_GET['c_id'];

                $query = "SELECT * FROM comment WHERE cmt_id = '$c_id'";

                $selectUserComment = mysqli_query($connect, $query);

                while ( $row = mysqli_fetch_assoc($selectUserComment) )
                {

                  $cmt_id        = $row['cmt_id'];
                  $cmt_post_id   = $row['cmt_post_id'];
                  $cmt_post_id   = $row['cmt_post_id'];
                  $cmt_user_id   = $row['cmt_user_id'];
                  $cmt_email     = $row['cmt_email'];
                  $cmt_desc      = $row['cmt_desc'];
                  $reply_cmt_id  = $row['reply_cmt_id'];
                  $cmt_status    = $row['cmt_status'];
                  $cmt_date      = $row['cmt_date']; 
                  ?>

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Update Userr Information</h3>
                </div>

                <div class="card-body">
                  <!--- Add Users Form Start --->
                  <form action="allcommentS.php?do=Update" method="POST" enctype="multipart/form-data">
                    <div class="row">

                      <div class="col-lg-6">

                        <div class="form-group">
                          <label>Post Titles</label>
                          <input type="text" name="posttitle" class="form-control" required="required" autocomplete="off" readonly="readonly" value="<?php 
                                  $sql = "SELECT * FROM post WHERE post_id = '$cmt_post_id'";
                                  $post_title_by_id = mysqli_query($connect, $sql);
                                  while ( $row = mysqli_fetch_assoc($post_title_by_id) )
                                    {
                                      $post_id  = $row['post_id'];
                                      $title    = $row['title'];
                                      echo $title; 
                                    }
                          ?>">
                        </div>

                        <div class="form-group">
                          <label>Full Name</label>
                          <input type="text" name="fullname" class="form-control" required="required" autocomplete="off" value="<?php echo $cmt_user_id; ?>" readonly="readonly">
                        </div>

                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" class="form-control" required="required" autocomplete="off" value="<?php echo $cmt_email; ?>" readonly="readonly">
                        </div>

                        <div class="form-group">
                          <label style="font-size: 20px;">Profile Picture</label> 
                          <br>
                          <?php 
                                if ( !empty($image) ) 
                                { ?>
                                <img src="dist/img/users/<?php echo $image; ?>" width="90" style="border-radius: 80%;">
                                <?php }

                                else
                                { 
                                  echo "No Picture Uploaded";
                                }
                          ?>
                          <br>
                        </div>

                      </div>  

                      <div class="col-lg-6">

                        <div class="form-group">
                          <label>Comment</label>
                          <input type="text" name="comments" class="form-control" value="<?php echo $cmt_desc; ?>">
                        </div>

                        <div class="form-group">
                          <label>Comment Status</label>
                          <select name="cmt_status" class="form-control">
                            <option value="2">Please Select The Status</option>
                            <option value="1" <?php if ($cmt_status == 1) {echo 'selected';} ?> >Active</option>
                            <option value="2" <?php if ($cmt_status == 2) {echo 'selected';} ?> >Inactive</option>
                          </select>
                        </div>
                        
                        <div class="form-group">
                          <label>Date</label>
                          <input type="Date" name="date" class="form-control"value="<?php echo $cmt_date; ?>" readonly="readonly">
                        </div>

                        <div class="form-group">
                          <input type="hidden" name="updateCommentID" value="<?php echo $cmt_id ?>">
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
            }

            else if ( $do == "Update" ) 
            {
              if ( isset ( $_POST['savechange'] ) ) 
              {
                $updateCommentID = $_POST['updateCommentID'];

                $cmt_status    = $_POST['cmt_status'];

                $query = "UPDATE comment SET cmt_status = '$cmt_status' WHERE cmt_id = '$updateCommentID'";

                // echo $query;

                $updateCommentInfo = mysqli_query($connect, $query);

               if ( !$updateCommentInfo ) 
                {
                 die( "Qurey Failed" . mysqli_error($connect) );
                }
                else
                {
                  header("Location: allcomments.php?do=Manage");
                }
              }
            } 

            else if ( $do == "Delete" ) 
            {

              // Dalete User
              if ( isset($_GET['d_id']) ) 
              {
                $deleteCommentID = $_GET['d_id'];

                  if ( $deleteCommentID) 
                  {
                    header("Location: allcomments.php?do=Manage");
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

        <?php }
        else
        {
          echo'<div class="alert alert-warning"> Oppssss!!!!! You have no access to this page. Get Lost Form Here.</div>';
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