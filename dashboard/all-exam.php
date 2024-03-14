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

  <!--**********************************
            Content body start
        ***********************************-->
  <div class="content-body">

    <div class="container-fluid">
      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            <h4>Hi, welcome back!</h4>
            <span class="ml-1">Card</span>
          </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Bootstrap</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Card</a></li>
          </ol>
        </div>
      </div>
      <div class="row">

        <?php 
            $exam_no = 5;
            for ($i = 1; $i <= $exam_no; $i++) {
        ?>

        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Live Exam-1</h5>
            </div>
            <div class="card-body">
              <p class="card-text">
                <span class="badge badge-rounded badge-outline-dark">Physics</span>
                <span class="badge badge-rounded badge-outline-dark">Chemistry</span>
                <span class="badge badge-rounded badge-outline-dark">Math</span>
                <span class="badge badge-rounded badge-outline-dark">Biology</span>
              </p>
              <p class="card-text">
                <span class="badge badge-rounded badge-success">30 Marks</span>
                <span class="badge badge-rounded badge-danger">Negatiive marking 0.25</span>

              </p>
            </div>
            <div class="card-footer">
              <a class="d-inline btn btn-dark text-light mt-1" href="exam.php?Exam-ID=65ed8a7b5b451">Start Exam</a>
              <a class="d-inline btn btn-dark text-light mt-1" href="#">View Solution</a>
              <a class="d-inline btn btn-dark text-light mt-3" href="#">Leaderboard</a>
              <a class="d-inline btn btn-dark text-light mt-3" href="#">Result</a>

            </div>
          </div>
        </div>

        <?php } ?>


      </div>
    </div>
  </div>
  <!--**********************************
Content body end
***********************************-->

  <?php include("includes/footer.php"); ?>

</body>

</html>