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
  <div class="content-body">
    <div class="container-fluid">
      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            <h4>Hi, welcome back!</h4>
            <span class="ml-1">Create Exam</span>
          </div>
        </div>

      </div>
      <!-- row -->
      <div class="row">
        <div class="col-xl-12 col-xxl-12">

          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Create Your Exam</h4>
            </div>
            <div class="card-body">
              <div class="basic-form">
                <form action="exam.php?CustomExam" method="post">
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Exam Name</label>
                    <div class="col-sm-10">
                      <input type="name" name="exam_name" class="form-control" placeholder="Exam Name" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-2">Question Distribution</div>
                    <div class="col-sm-10">
                      <div class="row">
                        <?php
                        $search_subject = mysqli_query($con, "SELECT * FROM subjects");
                        if(mysqli_num_rows($search_subject) > 0){
                          while($row = mysqli_fetch_array($search_subject)){
                            ?>
                        <div class="col-sm-3">
                          <input type="number" name="<?=$row['id']?>" class="form-control"
                            placeholder="<?=$row['subject']?>" value="1">
                        </div>
                        <?php
                          }
                        }
                        ?>


                      </div>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Marks Per Qustion</div>
                    <div class="col-sm-10">
                      <input type="number" name="custom_mark" class="form-control" placeholder="Marks Per Question"
                        required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Negative Marking</div>
                    <div class="col-sm-10">
                      <input type="number" step="any" name="negative_mark" class="form-control" value="0"
                        placeholder="Negative Marking" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Exam Duration(Minutes)</div>
                    <div class="col-sm-10">
                      <input type="number" name="duration" class="form-control" placeholder="Exam Duration in minutes"
                        required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" name="create_exam" class="btn btn-primary btn-lg">Create Exam</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>


    <?php include("includes/footer.php"); ?>


</body>

</html>