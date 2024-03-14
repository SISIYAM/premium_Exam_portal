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
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Element</a></li>
          </ol>
        </div>
      </div>
      <!-- row -->
      <div class="row">
        <div class="col-xl-6 col-xxl-12">

          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Create Your Exam</h4>
            </div>
            <div class="card-body">
              <div class="basic-form">
                <form>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Exam Name</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" placeholder="Exam Name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Subject</div>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                          Physics
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                          Chemistry
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                          Math
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox">
                        <label class="form-check-label">
                          Biology
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Qustion Distribution</div>
                    <div class="col-sm-10">
                      <div class="row">
                        <div class="col-sm-3">
                          <input type="number" class="form-control" placeholder="Physics">
                        </div>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" placeholder="Math">
                        </div>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" placeholder="Chemistry">
                        </div>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" placeholder="Biology">
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Marks Per Qustion</div>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" placeholder="Marks Per Qustion">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-2">Negative Marking</div>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" placeholder="Negative Marking">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-sm-10">
                      <button type="submit" class="btn btn-primary">Create Exam</button>
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