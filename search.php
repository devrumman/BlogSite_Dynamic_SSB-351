<?php 
    include"inc/header.php"; 
?>


    <!-- :::::::::: Page Banner Section Start :::::::: -->
    <section class="blog-bg background-img">
        <div class="container">
            <!-- Row Start -->
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-title">Your Search Result</h1>
                    <!-- Page Heading Breadcrumb Start -->
                    <nav class="page-breadcrumb-item">
                        <ol>
                            <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
                            <!-- Active Breadcrumb -->
                            <li class="active">Search</li>
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
                <!-- Blog Posts Start -->
                <div class="col-md-8">

                    <?php 

                     if (isset($_POST['searchContent'])) 
                        {
                           $data = mysqli_real_escape_string($connect, $_POST['search']);

                           // Search Query 
                          $query = "SELECT * FROM post  WHERE title LIKE '%$data%' OR description LIKE '%$data%' ORDER BY post_id DESC";
                          $allPosts = mysqli_query($connect, $query);
                          $count = mysqli_num_rows($allPosts);

                          if ( $count <= 0 ) 
                          {
                            echo '<div class=" alert alert-info font-weight-bold text-center text-gray-dark h5" > Opps!!! No Post Based  On Search -> ' . $data . ' ... </div>';
                          }
                          else
                           {
                              while( $row = mysqli_fetch_assoc($allPosts) )
                                {
                                    $post_id       = $row['post_id'];
                                    $title         = $row['title'];
                                    $description   = $row['description'];
                                    $category_id   = $row['category_id'];
                                    $auther_id     = $row['adder_id']; 
                                    $status        = $row['status'];
                                    $post_date     = $row['post_date'];
                                    $image         = $row['image'];
                                    ?>


                                    <!-- Single Item Blog Post Start -->
                                    <div class="blog-post">
                                        <!-- Blog Banner Image -->
                                        <div class="blog-banner">
                                            <a href="single.php?article=<?php echo $post_id;?>">
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
                                            </a>
                                            <!-- Post Category Names -->
                                            <div class="blog-category-name">
                                                <h6>
                                            <?php
                                                $query = "SELECT * FROM category WHERE cat_id='$category_id'";
                                                $category_name   = mysqli_query($connect,$query);
                                                if ($category_name) 
                                                {
                                                    while($row=mysqli_fetch_assoc($category_name))
                                                    {
                                                        $catName = $row['cat_name'];
                                                        echo "<a href='category.php?category=".$catName."'>$catName</a>";
                                                    }
                                                }
                                            ?>
                                        </h6>
                                            </div>
                                        </div>
                                        <!-- Blog Title and Description -->
                                        <div class="blog-description">
                                            <a href="single.php?article=<?php echo $post_id;?>">
                                                <h3 class="post-title"><?php echo $title; ?></h3>
                                            </a>
                                            <p>
                                                <?php echo substr($description, 0, 300); ?>......</p>
                                            <!-- Blog Info, Date and Author -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="blog-info">
                                                        <ul>
                                                            <li><i class="fa fa-calendar"></i>
                                                                <?php echo $post_date; ?>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-user"></i>
                                                                <?php 
                                                                  $query = "SELECT * FROM users WHERE user_id = '$auther_id'";
                                                                  $auther_name = mysqli_query($connect, $query);
                                                                  while ( $row = mysqli_fetch_array($auther_name) ) 
                                                                  {
                                                                     $user_id    = $row['user_id'];
                                                                     $user_name  = $row['fullname'];
                                                                     echo "By - " . $user_name;
                                                                  }
                                                                ?>
                                                            </li>
                                                            <li><i class="fa fa-heart"></i>(50)</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 read-more-btn">
                                                    <a href="single.php?article=<?php echo $post_id;?>" class="btn-main" style="color: white;">Read More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Item Blog Post End -->
                         <?php  }
                            }
                        } 
                     else if(isset($_GET['tags'])) 
                        {
                            $tag = $_GET['tags'];
                            $query = "SELECT * FROM post  WHERE tags LIKE '%$tag%' ORDER BY post_id DESC";
                            $allTagPosts = mysqli_query($connect, $query);
                            $count = mysqli_num_rows($allTagPosts);

                          if ( $count <= 0 ) 
                          {
                            echo '<div class=" alert alert-info font-weight-bold text-center text-gray-dark h5" > Opps!!! No Post Based  On This Mata Tag -> ' . $tag . ' ... </div>';
                          }
                          else
                          {
                            while( $row = mysqli_fetch_assoc($allTagPosts) )
                                {
                                    $post_id       = $row['post_id'];
                                    $title         = $row['title'];
                                    $description   = $row['description'];
                                    $category_id   = $row['category_id'];
                                    $auther_id     = $row['adder_id']; 
                                    $status        = $row['status'];
                                    $post_date     = $row['post_date'];
                                    $image         = $row['image'];
                                    ?>


                                    <!-- Single Item Blog Post Start -->
                                    <div class="blog-post">
                                        <!-- Blog Banner Image -->
                                        <div class="blog-banner">
                                            <a href="single.php?article=<?php echo $post_id;?>">
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
                                            </a>
                                            <!-- Post Category Names -->
                                            <div class="blog-category-name">
                                                <h6>
                                            <?php
                                                $query = "SELECT * FROM category WHERE cat_id='$category_id'";
                                                $category_name   = mysqli_query($connect,$query);
                                                if ($category_name) 
                                                {
                                                    while($row=mysqli_fetch_assoc($category_name))
                                                    {
                                                        $catName = $row['cat_name'];
                                                        echo "<a href='category.php?category=".$catName."'>$catName</a>";
                                                    }
                                                }
                                            ?>
                                        </h6>
                                            </div>
                                        </div>
                                        <!-- Blog Title and Description -->
                                        <div class="blog-description">
                                            <a href="single.php?article=<?php echo $post_id;?>">
                                                <h3 class="post-title"><?php echo $title; ?></h3>
                                            </a>
                                            <p>
                                                <?php echo substr($description, 0, 300); ?>......</p>
                                            <!-- Blog Info, Date and Author -->
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="blog-info">
                                                        <ul>
                                                            <li><i class="fa fa-calendar"></i>
                                                                <?php echo $post_date; ?>
                                                            </li>
                                                            <li>
                                                                <i class="fa fa-user"></i>
                                                                <?php 
                                                                  $query = "SELECT * FROM users WHERE user_id = '$auther_id'";
                                                                  $auther_name = mysqli_query($connect, $query);
                                                                  while ( $row = mysqli_fetch_array($auther_name) ) 
                                                                  {
                                                                     $user_id    = $row['user_id'];
                                                                     $user_name  = $row['fullname'];
                                                                     echo "By - " . $user_name;
                                                                  }
                                                                ?>
                                                            </li>
                                                            <li><i class="fa fa-heart"></i>(50)</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 read-more-btn">
                                                    <a href="single.php?article=<?php echo $post_id;?>" class="btn-main" style="color: white;">Read More <i class="fa fa-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Item Blog Post End -->
                         <?php  }
                          }
                        }
                    ?>
                </div>


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
