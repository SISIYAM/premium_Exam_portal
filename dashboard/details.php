<?php 
include './Admin/includes/dbcon.php';
include './includes/login_required.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
include 'includes/head.php';
?>
</head>

<body>

  <!-- Nav bar -->
  <?php include 'includes/nav.php'; ?>
  <!--**********************************
            Content body start
        ***********************************-->
  <?php
 if(isset($_GET['Profile'])){
  ?>
  <div class="content-body">
    <div class="container-fluid">
      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            <h4>Hi, <?=$studentUserName?></h4>
          </div>
        </div>

      </div>
      <!-- row -->


      <div class="row">
        <div class="col-12">
          <div class="card">

            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <!-- Form Basic -->
                  <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                      <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                    </div>
                    <div class="card-body">
                      <?php ?>
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="">Full Name</label>
                          <input type="text" class="form-control" value="<?=$studentFullName?>" id="" name="full_name">
                        </div>
                        <div class="form-group">
                          <label for="">Username</label>
                          <input type="text" class="form-control" value="<?=$studentUserName?>" id="" name="username"
                            required>
                        </div>
                        <div class="form-group">
                          <label for="">Mobile Number</label>
                          <input type="text" class="form-control" value="<?=$studentMobile?>" id="" name="mobile">
                        </div>
                        <div class="form-group">
                          <label for="">Email address</label>
                          <input type="email" class="form-control" value="<?=$studentEmail?>" id="" name="email"
                            required>
                        </div>
                        <div class="form-group">
                          <label for="">Institute</label>
                          <input type="text" class="form-control" value="<?=$studentInstitute?>" id="" name="college">
                        </div>
                        <div class="form-group">
                          <label for="">HSC</label>
                          <input type="text" class="form-control" value="<?=$studentHsc?>" id="" name="hsc">
                        </div>

                        <button type="submit" name="updateStudentsInformation" class="btn btn-primary">Update</button>
                        <button type="button" value="<?=$student_id?>" class="btn btn-info mx-2"
                          href="javascript:void(0);" data-toggle="modal" data-target="#passwordModal">
                          Change Password
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
                <!--Row-->




              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php
 }
 ?>


  </div>

  <?php 
  include './includes/footer.php';
  include './includes/code.php'; ?>

</body>

</html>