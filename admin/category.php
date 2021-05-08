

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
            <h1 class="m-0">Manage All Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage All Category</li>
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
        
        <!------ Add New Category Start----->
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add New Category</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body" style="display: block;">

              <form action="" method="POST">
                <!--- Category Name--->
                  <div class="form-group">
                    <label for="inputName">Category / Sub-Category Name</label>
                    <input type="text" id="inputName" class="form-control" name="cat_name">
                  </div>

                <!--- Category Description--->
                  <div class="form-group">
                    <label for="inputDescription">Category Description</label>
                    <textarea id="inputDescription" class="form-control" rows="4" name="cat_desc"></textarea>
                  </div>

                  <!--- Parent Category --->
                  <div class="form-group">
                    <label for="inputParent">Parent Category [ Optional ]</label>
                    <select id="inputParent" class="form-control custom-select" name="parent_id">
                      <option value="0">Select The Parent Category</option>
                      
                      <?php 
                        $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
                        $readParent = mysqli_query($connect, $query);

                        while ($row = mysqli_fetch_assoc($readParent) ) 
                        {
                         $parent_cat_id   = $row['cat_id'];
                         $parent_cat_name = $row['cat_name'];
                         ?>
 
                         <option value="<?php echo $parent_cat_id; ?>"><?php echo $parent_cat_name; ?></option>
                         <?php 
                        }
                       ?>

                    </select>
                  </div>

                <!--- Category Status--->
                  <div class="form-group">
                    <label for="inputStatus">Status</label>
                    <select id="inputStatus" class="form-control custom-select" name="status">
                      <option value="0">Plase Select The Active Status</option>
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <input type="submit" name="add_cat" class="btn btn-primary" value="Add New Category">
                  </div>
              </form>  
            </div>
          </div>
        </div>

        <!---- Insert the  Category info the DB------->
         <?php 
           if (isset($_POST['add_cat']) ) 
           {
             $cat_name  = $_POST['cat_name'];
             $cat_desc  = $_POST['cat_desc'];
             $parent_id = $_POST['parent_id'];
             $status    = $_POST['status'];

             $query = "INSERT INTO category (cat_name, cat_desc, parent_id, status)  
                        VALUES ('$cat_name', '$cat_desc', '$parent_id', '$status')";

             $addCategory = mysqli_query($connect, $query);

             if ($addCategory) {
               header("Location: category.php");
             }
            else{
                die("Databese Connection Faild. " . mysqli_error($connect));
             }
           }
          ?>
        <!------ Add New Category End----->

          <!------ Manage All The Category Start ----->
            <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Manage All Category</h3>
              </div>
              <div class="card-body">

                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Primary / Sub</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>

                  <tbody>

                      <?php 
                        $query = "SELECT * FROM category WHERE parent_id = 0 ORDER BY cat_name ASC";
                        $allcat = mysqli_query($connect, $query);
                        $i = 0;

                        while ($row = mysqli_fetch_assoc($allcat) ) 
                        {
                         $cat_id    = $row['cat_id'];
                         $cat_name  = $row['cat_name'];
                         $cat_desc  = $row['cat_name'];
                         $parent_id = $row['parent_id'];
                         $status    = $row['status'];
                         $i++;
                         ?>
                          
                          <tr>
                            <th scope="row"> <?php echo $i; ?> </th>
                            <td><?php echo $cat_name; ?></td>
                            <td>
                              <?php 
                                echo '<span class="badge badge-info">Primary</span>';
                              ?>
                            </td>
                            <td>

                              <?php 
                              if ($status == 0) 
                              {
                                echo '<span class="badge badge-danger">Inactive</span>';
                              }
                              else if ($status == 1)  
                              {
                                echo '<span class="badge badge-success">Active</span>';
                              }
                              ?>
                            </td>
                            <td>
                              <div class="action-bar">
                                <ul>
                                  <li><a href=""><i class="fa fa-edit"></i></a></li>
                                  <li><a href=""><i class="fa fa-trash"></i></a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>

                         <?php 

                         $childCatQuery = "SELECT * FROM category WHERE parent_id = $cat_id  ORDER BY cat_name ASC";
                         $childCat = mysqli_query($connect, $childCatQuery);
                         while ($row = mysqli_fetch_assoc($childCat) ) {
                           $cat_id    = $row['cat_id'];
                           $cat_name  = $row['cat_name'];
                           $cat_desc  = $row['cat_name'];
                           $parent_id = $row['parent_id'];
                           $status    = $row['status']
                           ?>


                          <tr>
                            <th scope="row"> <?php echo $i; ?> </th>
                            <td>-- <?php echo $cat_name; ?></td>
                            <td>
                              <?php 
                                echo '<span class="badge badge-dark">Child</span>';
                              ?>
                            </td>
                            <td>

                              <?php 
                              if ($status == 0) 
                              {
                                echo '<span class="badge badge-danger">Inactive</span>';
                              }
                              else if ($status == 1)  
                              {
                                echo '<span class="badge badge-success">Active</span>';
                              }
                              ?>
                            </td>
                            <td>
                              <div class="action-bar">
                                <ul>
                                  <li><a href=""><i class="fa fa-edit"></i></a></li>
                                  <li><a href=""><i class="fa fa-trash"></i></a></li>
                                </ul>
                              </div>
                            </td>
                          </tr>
                        <?php }
                        }
                       ?>
                    </tbody>
                </table>
                
              </div>
            </div>
          <!------ Manage All The Category End ----->
        </div>

        </div>
      </div>
    </section>
  </div>

<?php include "inc/admin/footer.php"; ?>
