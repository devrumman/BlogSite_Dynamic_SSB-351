<?php
  include "inc/header.php";
?>
 <!-- :::::::::: Page Banner Section Start :::::::: -->
 <section class="blog-bg background-img">
  <div class="container">
   <!-- Row Start -->
   <div class="row">
    <div class="col-md-12">
     <h2 class="page-title">
      <?php
        if (isset($_GET['category'])) {
          echo $_GET['category'];
        }

      ?>
     </h2>
     <!-- Page Heading Breadcrumb Start -->
     <nav class="page-breadcrumb-item">
      <ol>
       <li><a href="index.php">Home <i class="fa fa-angle-double-right"></i></a></li>
       <!-- Active Breadcrumb -->
       <li class="active">Category</li>
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
        if (isset($_GET['category'])) {
            $searchQ = $_GET['category'];
            // Read category id
            $catIdQ = "SELECT * FROM category WHERE cat_name='$searchQ'";
            $redCat = mysqli_query($connect,$catIdQ);
            $data = mysqli_fetch_assoc($redCat);
            $cat_ID = $data['cat_id'];
        
            $query="SELECT * FROM post WHERE category_id='$cat_ID' AND status=1";
            $allPosts=mysqli_query($connect,$query);

            if (mysqli_num_rows($allPosts) > 0) {
              while($row=mysqli_fetch_assoc($allPosts)){
              $post_id      = $row['post_id'];
              $image        = $row['image'];
              $title        = $row['title'];
              $description  = $row['description'];
              $category_id  = $row['category_id'];
              $author       = $row['adder_id'];
              $tags         = $row['tags'];
              $date         = $row['post_date'];
              $status       = $row['status'];
    ?>

    <!-- Single Item Blog Post Start -->
    <div class="blog-post">
      <!-- Blog Banner Image -->
      <div class="blog-banner">
        <a href="single.php?article=<?php echo $post_id; ?>">
            <img src="admin/dist/img/posts/<?php if(!empty($image)){echo $image;}else{echo "default.png";} ?>">
        </a>
        <!-- Post Category Names -->
        <div class="blog-category-name">
         <h6>
            <?php
                $getCat = "SELECT * FROM category WHERE cat_id='$category_id'";
                $catQ   = mysqli_query($connect,$getCat);
                if ($catQ) {
                    while($val=mysqli_fetch_assoc($catQ)){
                        $catName = $val['cat_name'];
                        echo "<a href='category.php?category=".$catName."'>$catName</a>";
                    }
                }
            ?>
         </h6>
        </div>
       
      </div>
      <!-- Blog Title and Description -->
      <div class="blog-description">
       <a href="single.php?article=<?php echo $post_id; ?>">
        <h3 class="post-title"><?php echo $title; ?></h3>
       </a>
       <p>
           <?php echo substr($description, 0, 500)."..."; ?>
       </p>
       <!-- Blog Info, Date and Author -->
       <div class="row">
        <div class="col-md-8">
         <div class="blog-info">
          <ul>
           <li><i class="fa fa-calendar"></i><?php echo $date; ?></li>
           <li><i class="fa fa-user"></i>
            <?php
                $getAuthor  = "SELECT * FROM users WHERE user_id='$author'";
                $readAuthor = mysqli_query($connect,$getAuthor);
                while ($data = mysqli_fetch_assoc($readAuthor)) {
                    echo $data['fullname'];
                }
            ?>
           </li>
           <li><i class="fa fa-heart"></i>(50)</li>
          </ul>
         </div>
        </div>

        <div class="col-md-4 read-more-btn">
         <a href="single.php?article=<?php echo $post_id; ?>" style="color:#fff;" class="btn-main">Read More <i class="fa fa-angle-double-right"></i></a>
        </div>
       </div>
      </div>
    </div>
     <!-- Single Item Blog Post End -->
    <?php } }else{

      echo "<div class='alert alert-danger text-center h4'> Ooooppppsss...!!! No post found in this category!</div>  <br> <br> <br>";

    } } ?>

     

     <!-- Blog Paginetion Design Start -->
     <div class="paginetion">
      <ul>
       <!-- Next Button -->
       <li class="blog-prev">
        <a href=""><i class="fa fa-long-arrow-left"></i> Previous</a>
       </li>
       <li><a href="">1</a></li>
       <li><a href="">2</a></li>
       <li class="active"><a href="">3</a></li>
       <li><a href="">4</a></li>
       <li><a href="">5</a></li>
       <!-- Previous Button -->
       <li class="blog-next">
        <a href=""> Next <i class="fa fa-long-arrow-right"></i></a>
       </li>
      </ul>
     </div>
     <!-- Blog Paginetion Design End -->
    </div>



    <!-- Blog Right Sidebar -->
    <?php
      include "inc/sidebar.php";
    ?>
    <!-- Right Sidebar End -->
   </div>
  </div>
 </section>
 <!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->


<?php
  include "inc/footer.php";
?>
