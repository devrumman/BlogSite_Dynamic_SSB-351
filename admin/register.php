<?php include "inc/auth/header.php";?>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="fullname" placeholder="Full name" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="User name" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="repassword" placeholder="Retype password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <input type="submit" class="btn btn-primary btn-block" name="register" value="Register">
          </div>
          <!-- /.col -->
        </div>
      </form>

             
      <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="index.php" class="text-center">I already have a membership</a>
    </div>
    
  </div>
   <?php

              if (isset($_POST['register']))
                  {
                    $fullname      = $_POST['fullname'];
                    $username      = $_POST['username'];
                    $email         = $_POST['email'];
                    $phone         = $_POST['phone'];
                    $password      = $_POST['password'];
                    $repassword    = $_POST['repassword'];
                    if ($password == $repassword )
                    {
                        //Encrypted password
                        $hashedPass = sha1($password);
                        
                        $addUser = "INSERT INTO users (fullname, username, email, password, phone, join_date) VALUES ('$fullname', '$username', '$email', '$hashedPass', '$phone', now() )";
                      
                        $registerUser = mysqli_query($connect, $addUser);
                        // echo $registerUser;
                        if ($registerUser)
                        {
                          echo '<div class="btn btn-success" style="margin-top: 15px; text-align: center;" >Sorry! New MEMBER have been Successfully Added </div>';
                          // header("Location: index.php") . "New Mamber Added";
                        }
                        else
                        {
                          header("Location: index.php");
                          // echo '<div class="btn btn-danger" style="margin-top: 15px;b text-align: center;" >Sorry! New MEMBER Successfully Added </div>';
                        }
                    }
                  }

              ?>  


</div>
<!-- /.register-box -->

<?php include "inc/auth/footer.php";?>