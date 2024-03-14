<?php 
session_start();
include './Admin/includes/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
  <?php include 'includes/head.php'; ?>

</head>

<body class="h-100">
  <div class="authincation h-100">
    <div class="container-fluid h-100">
      <div class="row justify-content-center h-100 align-items-center">
        <div class="col-md-6">
          <div class="authincation-content">
            <div class="row no-gutters">
              <div class="col-xl-12">
                <?php 
                if(isset($_GET['login'])){
                  ?>
                <div class="auth-form">
                  <h4 class="text-center mb-4">Sign in your account</h4>
                  <form action="" method="post">
                    <div class="form-group">
                      <label><strong>Username</strong></label>
                      <input type="text" class="form-control" placeholder="Enter username" name="username">
                    </div>
                    <div class="form-group">
                      <label><strong>Password</strong></label>
                      <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-row d-flex justify-content-between mt-4 mb-2">

                      <div class="form-group">
                        <a href="page-forgot-password.html">Forgot Password?</a>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="LoginBtn" class="btn btn-primary btn-block">Sign me in</button>
                    </div>
                  </form>
                  <div class="new-account mt-3">
                    <p>Don't have an account? <a class="text-primary" href="login.php?register">Sign up</a></p>
                  </div>
                </div>
                <?php
                }elseif(isset($_GET['register'])){
                  ?>
                <div class="auth-form">
                  <h4 class="text-center mb-4">Sign up your account</h4>
                  <form action="" method="post">
                    <div class="form-group">
                      <label>Full Name</label>
                      <input type="text" class="form-control" id="exampleInputFirstName" name="full_name"
                        placeholder="Enter Full Name" required>
                    </div>
                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" id="exampleInputLastName"
                        placeholder="Enter Unique Username" required>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" id="exampleInputEmail"
                        aria-describedby="emailHelp" placeholder="Enter Email Address" required>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password" id="exampleInputPassword"
                        placeholder="Password" required>
                    </div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" class="form-control" name="confirm_password"
                        id="exampleInputPasswordConfirm" placeholder="Confirm Password" required>
                    </div>
                    <div class="text-center mt-4">
                      <button type="submit" name="registerBtn" class="btn btn-primary btn-block">Sign me up</button>
                    </div>
                  </form>
                  <div class="new-account mt-3">
                    <p>Already have an account? <a class="text-primary" href="login.php?login">Sign in</a></p>
                  </div>
                </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php include './includes/code.php'; ?>

</body>

</html>