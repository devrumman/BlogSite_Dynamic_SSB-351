  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
            $imgread = $_SESSION['user_id'];
            $imgShown = "SELECT * FROM users WHERE user_id = '$imgread'";
            $imgSeen = mysqli_query($connect, $imgShown);

            while($row = mysqli_fetch_array($imgSeen))
            {
              $image = $row['image'];
              if (!empty($image)) 
              {
                ?>
                <img src="dist/img/users/<?php echo $image; ?>" class="img-circle elevation-2" alt="User Image" style ="width:45px; ">
                  
              <?php
            }
              else
              {
                $fileName = "default.png";
                ?>
                <img src="dist/img/users/<?php echo $fileName; ?>" class="img-circle elevation-2" alt="User Image" style ="width:45px; ">
                <?php
              }
            }
           ?>
        </div>

        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['fullname']  ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-header">EXAMPLES</li>

          <!---------- Profile Manage ------------------->
            <li class="nav-item">
              <a href="profile.php?do=View" class="nav-link">
                <?php 
            $imgread = $_SESSION['user_id'];
            $imgShown = "SELECT * FROM users WHERE user_id = '$imgread'";
            $imgSeen = mysqli_query($connect, $imgShown);

            while($row = mysqli_fetch_array($imgSeen))
            {
              $image = $row['image'];
              if (!empty($image)) 
              {
                ?>
                <img src="dist/img/users/<?php echo $image; ?>" class="img-circle elevation-2" alt="User Image" style ="width:35px;">
              <?php
            }
              else
              {
                $fileName = "default.png";
                ?>
                <img src="dist/img/users/<?php echo $fileName; ?>" class="img-circle elevation-2" alt="User Image" style ="width:35px;">
                <?php
              }
            }
           ?>
               <!--  <i class="nav-icon fas fa-chart-pie"></i> -->
                <p style="margin-left: 10px; font-weight: 900;">
                  Profile
                </p>
              </a>
            </li>


          <!------------- Manage Users ------------------->
          <?php 
            if ($_SESSION['user_role'] == 1) 
            {?>
              
              <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
              </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="users.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Users</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="users.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Users</p>
                </a>
              </li>

            </ul>
          </li>          
            <?php }
           ?>

           
          <!---------- Manage Category And Sub-catagory ------------------->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Category
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Category</p>
                </a>
              </li>
            </ul>
          </li>

          <!---------- Manage Category And Sub-catagory ------------------->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-industry"></i>
              <p>
                Blog Post 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="post.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Post</p>
                </a>
              </li>
            </ul>
          </li>


          <!------------- Manage Profaile ------------------->
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
               <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>  

         </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside



