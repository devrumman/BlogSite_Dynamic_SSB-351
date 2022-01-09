<?php 
    include"inc/header.php"; 
?>
 
    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h2 class="page-title">Single Blog Page</h2>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.php">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Single Right Sidebar</li>
                        </ol>
                    </nav>
                    <!-- Page Heading Breadcrumb End -->
                </div>
                  
            </div>
            <!-- Row End -->
        </div>
    </section>
    <!-- ::::::::::: Page Banner Section End ::::::::: -->



    <!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
    <section>
        <div class="container">
            <div class="row">
                <!-- Blog Single Posts -->
                <div class="col-md-8">



                    <?php 
                        if (isset($_GET['article'])) 
                        {
                            $post_ID = $_GET['article'];
                            $query = "SELECT * FROM post WHERE post_id = '$post_ID'";
                            $postR = mysqli_query($connect, $query);

                            while( $row = mysqli_fetch_assoc($postR) )
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
                                <div class="blog-single">
                                    <!-- Blog Title -->
                                    <a href="#">
                                        <h3 class="post-title"><?php echo $title; ?></h3>
                                    </a>

                                    <!-- Blog Categories -->
                                    <div class="single-categories">

                                          <?php
                                                $query = "SELECT * FROM category WHERE cat_id='$category_id'";
                                                $category_name   = mysqli_query($connect,$query);
                                                while( $row=mysqli_fetch_array($category_name) )
                                                {
                                                    $cat_id   = $row['cat_id'];
                                                    $cat_name = $row['cat_name'];
                                                    ?>
                                                    <span><?php echo $cat_name; ?></span>
                                            <?php }
                                            ?>

                                    </div>
                                    
                                    <!-- Blog Thumbnail Image Start -->
                                    <div class="blog-banner">
                                       <?php 
                                          if ( !empty($image) ) 
                                          { ?>
                                            <img src="admin/dist/img/posts/<?php echo $image;?>">
                                          <?php }

                                          else 
                                          { ?>
                                            <img src="admin/dist/img/posts/default.png">
                                          <?php }
                                        ?>
                                    </div>
                                    <!-- Blog Thumbnail Image End -->

                                    <!-- Blog Description Start -->
                                    <p><?php echo $description; ?></p>

                                    <!--- <div class="blog-description-quote">
                                        <p><i class="fa fa-quote-left"><?php echo substr($description, 0, 300); ?>......<i class="fa fa-quote-right"></i></p>
                                    </div>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est eserunt mollit anim id labor laborumlabor laborum est.
                                    </p> -->

                                    <!-- Blog Description End -->
                                </div>
                     <?php  }  
                        }
                    ?>


                    <!-- Single Comment Section Start -->
                    <div class="single-comments">
                        <!-- Comment Heading Start -->
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                $sql = "SELECT * FROM comment WHERE post_id ='$post_id' AND status = 1";
                                $readcomments = mysqli_query($connect, $sql);
                                $total_comment = mysqli_num_rows($readcomments);
                                 ?>
                                <h4>All Latest Comments (<?php echo $total_comment; ?>)</h4>
                                <div class="title-border"></div>
                                <p>Read Today All Latest Comments.</p>
                            </div>
                        </div>
                        <!-- Comment Heading End -->

                        <?php 
                            $sql = "SELECT * FROM comment WHERE post_id ='$post_id' AND status = 1 ORDER BY cmt_id DESC";
                            $readcomments = mysqli_query($connect, $sql);
                            $result = mysqli_num_rows($readcomments);

                            if ( $result == 0) 
                            { ?>
                                <div class="alert alert-warning">No Comments Found In This Post</div>
                         <?php }
                            else
                            {
                                while( $row = mysqli_fetch_assoc($readcomments) )
                                {
                                    $cmt_id        = $row['cmt_id'];
                                    $post_id   = $row['post_id'];
                                    $cmt_user_id   = $row['user_id'];
                                    $cmt_email     = $row['cmt_email'];
                                    $cmt_desc      = $row['cmt_desc'];
                                    $reply_cmt_id  = $row['reply_cmt_id'];
                                    $cmt_status    = $row['status'];
                                    $cmt_date      = $row['cmt_date'];
                                    ?>
                                    <!-- Single Comment Post Start -->
                                    <div class="row each-comments">
                                        <div class="col-md-2">
                                            <!-- Commented Person Thumbnail -->
                                            <div class="comments-person">
                                                <?php 
                                                    if ( !empty($image) ) 
                                                    { ?>
                                                    <img src="admin/dist/img/users/<?php echo $image; ?>">
                                                    <?php }

                                                    else
                                                    { ?>
                                                      <img src="admin/dist/img/users/default.png">
                                                    <?php }
                                                     ?> 
                                            </div>
                                        </div>
                                        <div class="col-md-10 no-padding">
                                            <!-- Comment Box Start -->
                                            <div class="comment-box">
                                                <div class="comment-box-header">
                                                    <ul>
                                                        <li class="post-by-name"><?php echo $cmt_user_id; ?></li>
                                                        <li class="post-by-hour"><?php echo $cmt_date; ?></li>
                                                    </ul>
                                                </div>
                                                <p><?php echo $cmt_desc; ?></p>
                                            </div>
                                            <!-- Comment Box End -->
                                        </div>
                                    </div>
                                    <!-- Single Comment Post End -->
                          <?php }
                            }
                        ?>
                    </div>
                    <!-- Single Comment Section End -->


                    <!-- Post New Comment Section Start -->
                    <div class="post-comments">
                        <h4>Post Your Comments</h4>
                        <div class="title-border"></div>
                        <!-- Form Start -->
                        <form action="" method="POST" class="contact-form">
                            <!-- Left Side Start -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- First Name Input Field -->
                                    <div class="form-group">
                                        <input type="text" name="user_name" placeholder="Your Name" class="form-input" autocomplete="off" required="required">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                </div>
                                <!-- Email Address Input Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off" required="required">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- Left Side End -->

                            <!-- Right Side Start -->
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Comments Textarea Field -->
                                    <div class="form-group">
                                        <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </div>
                                    <!-- Post Comment Button -->
                                    <input type="submit" name="addComment" class="btn-main" value="Post Your Comment">
                                </div>
                            </div>
                            <!-- Right Side End -->
                        </form>
                        <!-- Form End -->
                    </div>
                    <!-- Post New Comment Section End -->              
                </div>

                <?php 
                    if (isset($_POST['addComment'])) 
                    {
                        $user_name   = $_POST['user_name'];
                        $email       = $_POST['email'];
                        $comments    = $_POST['comments'];

                        $query = "INSERT INTO comment (cmt_desc, post_id, user_id, cmt_email, status, reply_cmt_id, cmt_date) VALUES('$comments', '$post_id ', '$user_name', '$email', '1', '$reply_cmt_id', now() )";
                        
                        $add_comment = mysqli_query($connect, $query);

                        if ( $add_comment ) 
                        {
                            header("Location: single.php?id=$post_id");
                        }
                        else 
                        {
                            die("Data Not Inserted." . mysqli_error($connect));
                        }
                    }
                 ?>
                 <?php 
                    include"inc/sidebar.php"; 
                ?>
            </div>
        </div>
    </section>
    <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->
<?php 
    include"inc/footer.php"; 
?>