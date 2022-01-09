
<!-- Blog Right Sidebar -->
<div class="col-md-4">

    <!-- Latest News -->
    <div class="widget">
        <h4>Latest News</h4>
        <div class="title-border"></div>

        <!-- Sidebar Latest News Slider Start -->
        <div class="sidebar-latest-news owl-carousel owl-theme">
            <?php 
                $query = "SELECT * FROM post ORDER BY post_id DESC LIMIT 5";
                $allPosts = mysqli_query($connect, $query);

                while( $row = mysqli_fetch_assoc($allPosts) )
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

                        <!-- Latest News Start -->
                        <div class="item">
                            <div class="latest-news">
                                <!-- Latest News Slider Image -->
                                <div class="latest-news-image">
                                    <a href="single.php?article=<?php echo $post_id;?>">
                                    <img src="admin/dist/img/posts/<?php if(!empty($image)){echo $image;}else{echo "default.png";} ?>">
                                    </a>
                                </div>
                                <!-- Latest News Slider Heading -->
                                <h5><?php echo $title; ?></h5>
                                <!-- Latest News Slider Paragraph -->
                                <p><?php echo substr($description, 0, 180); ?>......</p>
                            </div>
                        </div>
                        <!-- Latest News End -->
              <?php }
            ?> 
        </div>
        <!-- Sidebar Latest News Slider End -->
    </div>


    <!-- Search Bar Start -->
    <div class="widget"> 
        <!-- Search Bar -->
        <h4>Blog Search</h4>
        <div class="title-border"></div>
        <div class="search-bar">
            <!-- Search Form Start -->
            <form action="search.php" method="POST">
                <div class="form-group">
                    <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
                    <i class="fa fa-paper-plane-o"></i>
                </div>
                <div class="form-group">
                    <input type="submit" name="searchContent" class="btn btn-primary btn-block" value="Search">
                </div>
            </form>
            <!-- Search Form End -->
        </div>
    </div>
    <!-- Search Bar End -->

    <!-- Recent Post -->
    <div class="widget">
        <h4>Recent Posts</h4>
        <div class="title-border"></div>

        <?php 
            $query = "SELECT * FROM post ORDER BY post_id DESC LIMIT 4";
            $allPosts = mysqli_query($connect, $query);

            while( $row = mysqli_fetch_assoc($allPosts) )
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

                    <div class="recent-post">
                        <div class="recent-post">
                            <!-- Recent Post Item Content Start -->
                            <div class="recent-post-item">
                                <div class="row">
                                    <!-- Item Image -->
                                    <div class="col-md-4">
                                    <a href="single.php?article=<?php echo $post_id;?>">
                                    <img src="admin/dist/img/posts/<?php if(!empty($image)){echo $image;}else{echo "default.png";} ?>">
                                    </a>
                                    </div>
                                    <!-- Item Tite -->
                                    <div class="col-md-8 no-padding">
                                        <a href="single.php?article=<?php echo $post_id;?>">
                                            <h5 class="post-title"><?php echo $title; ?></h5>
                                            <p><?php echo substr($description, 0, 50); ?></p>
                                            </a>
                                        <ul>
                                            <li><i class="fa fa-clock-o"></i>Dec 15, 2018</li>
                                            <?php 
                                                $sql = "SELECT * FROM comment WHERE post_id ='$post_id' AND status = 1";
                                                $readcomments = mysqli_query($connect, $sql);
                                                $total_comment = mysqli_num_rows($readcomments);
                                            ?>
                                            <li><i class="fa fa-comment-o"></i><?php echo $total_comment;?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>        
          <?php } 
        ?>
                
    </div>
        <!-- Recent Post Item Content End -->


    <!-- All Category -->
    <div class="widget">
        <h4>Blog Categories</h4>
        <div class="title-border"></div>
        <!-- Blog Category Start -->
        <div class="blog-categories">
            <ul>
                <?php 
                $catquery="SELECT * FROM category WHERE parent_id=0 AND status=1 ORDER BY cat_name ASC";
                $passcatquery=mysqli_query($connect,$catquery);
                $i=0;
                while ($row=mysqli_fetch_assoc($passcatquery)) 
                {
                    $maincat_id         = $row['cat_id'];
                    $maincat_name       = $row['cat_name'];
                    $maincat_desc       = $row['cat_desc'];
                    $maincat_parent     = $row['parent_id'];
                    $maincat_status     = $row['status'];
                    $i++;
                    ?>
                    <li> 
                        <i class="fa fa-check"></i>
                        <?php echo $maincat_name; ?>    
                        <span>
                            <?php
                            $postQuery="SELECT * FROM post WHERE post_id='$maincat_id'";
                            $passpostQuery = mysqli_query($connect,$postQuery);
                            $countcat = mysqli_num_rows($passpostQuery);
                            echo $countcat;
                            ?>
                        </span>
                    </li>
                        <?php
                        $subcatQuery="SELECT * FROM category WHERE parent_id='$maincat_id' AND status=1 ORDER BY cat_name ASC";
                        $passSubcatquery=mysqli_query($connect,$subcatQuery);
                    
                        while ($row=mysqli_fetch_assoc($passSubcatquery)) 
                        {
                            $subcat_id     = $row['cat_id'];
                            $subcat_name   = $row['cat_name'];
                            $subcat_desc   = $row['cat_desc'];
                            $subcat_parent = $row['parent_id'];
                            $subcat_status = $row['status'];
                            $i++;
                            ?>
                            <li>
                                <a href="single.php?article=<?php echo $subcat_id;?>">
                                <i class="fa fa-square" style="margin-left: 20px;"></i>
                                <?php echo $subcat_name; ?> 
                                </a> 
                                <span>
                                    <?php
                                    $subPostquery="SELECT * FROM post WHERE post_id='$subcat_id'";
                                    $passSubpostquery=mysqli_query($connect,$subPostquery);
                                    $countsubcat=mysqli_num_rows($passSubpostquery);
                                    echo $countsubcat;
                                    ?>
                                </span>
                            </li>
                <?php   }
                }
                ?>          
            </ul>
        </div>
            <!-- Blog Category End -->
    </div>

    <!-- Recent Comments -->
    <div class="widget">
        <h4>Recent Comments</h4>
        <div class="title-border"></div>
        <div class="recent-comments">

            <?php 
                $sql = "SELECT * FROM comment WHERE status = 1 ORDER BY cmt_id DESC LIMIT 5";
                $read_Comments = mysqli_query($connect, $sql);
                while( $row = mysqli_fetch_assoc($read_Comments) )
                   {
                        $cmt_id        = $row['cmt_id'];
                        $cmt_post_id   = $row['post_id'];
                        $cmt_user_id   = $row['user_id'];
                        $cmt_email     = $row['cmt_email'];
                        $cmt_desc      = $row['cmt_desc'];
                        $reply_cmt_id  = $row['reply_cmt_id'];
                        $cmt_status    = $row['status'];
                        $cmt_date      = $row['cmt_date'];
                        ?>

                        <!-- Recent Comments Item Start -->
                        <div class="recent-comments-item">
                            <div class="row">
                                <!-- Comments Thumbnails -->
                                <div class="col-md-4">
                                    <i class="fa fa-comments-o"></i>
                                </div>
                                <!-- Comments Content -->
                                <div class="col-md-8 no-padding">
                                    <h5><?php echo $cmt_desc; ?></h5>
                                    <!-- Comments Date -->
                                    <ul>
                                        <li>
                                            <i class="fa fa-clock-o"></i><?php echo $cmt_date; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Recent Comments Item End -->

              <?php }
            ?>  
        </div>
    </div>

    <!-- Meta Tag Start -->
    <div class="widget">
        <h4>Tags</h4>
        <div class="title-border"></div>
        <!-- Meta Tag List Start -->
        <div class="meta-tags">
            <?php 
                $query = "SELECT * FROM post LIMIT 10 ";
                $allPosts = mysqli_query($connect, $query);

                while( $row = mysqli_fetch_assoc($allPosts) )
                {
                        $tags = $row['tags']; 

                       $tt = explode(",", $tags);

                       foreach ($tt as $t ) 
                       { ?>

                        <a href="Search.php?tags=<?php echo $t ?>"><span><?php echo $t; ?></span></a> 
                 <?php  }
                }        
             ?>         
        </div>
        <!-- Meta Tag List End -->
        </div>
        <!-- Meta Tag End -->
    </div>
    
</div>
<!-- Sidebar End -->