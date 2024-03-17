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
    <!-- row -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Live Exams</div>
                <div class="stat-digit"><?php
                echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM exam WHERE status=1 AND type=1"));
                ?></div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Given Exam</div>
                <div class="stat-digit"><?php
                echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM result WHERE student_id='$student_id'"));
                ?></div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Given Custom Exam</div>
                <div class="stat-digit"><?php
                echo mysqli_num_rows(mysqli_query($con, "SELECT * FROM custom_exam WHERE student_id='$student_id'"));
                ?> </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Subscription Left</div>
                <div class="stat-digit">30 days</div>
              </div>
            </div>
          </div>
          <!-- /# card -->
        </div>
        <!-- /# column -->
      </div>

      <div class="row">
        <div class="col-lg-5 col-sm-6">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Student Status</h4>
            </div>
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--**********************************
            Content body end
        ***********************************-->
  <?php 
  $pieExam = mysqli_query($con, "SELECT * FROM result WHERE student_id='$student_id'");
  $correctAnsweredSum = 0;
  $WrongAnsweredSum = 0;
  $NotAnsweredSum = 0;
  $AnsweredSum = 0;
  if(mysqli_num_rows($pieExam) > 0){
    while($pieRow = mysqli_fetch_array($pieExam)){
      $correctAnsweredSum = $correctAnsweredSum + $pieRow['right_answered'];
      $WrongAnsweredSum = $WrongAnsweredSum + $pieRow['wrong_answered'];
      $NotAnsweredSum = $NotAnsweredSum + $pieRow['not_answered'];
      $AnsweredSum = $AnsweredSum + $pieRow['answered'];
    }
    ?>
  <input type="hidden" id="correctAnswered" value="<?=$correctAnsweredSum?>">
  <input type="hidden" id="WrongAnswered" value="<?=$WrongAnsweredSum?>">
  <input type="hidden" id="NotAnswered" value="<?=$NotAnsweredSum?>">
  <input type="hidden" id="TotalAnswered" value="<?=$AnsweredSum?>">
  <?php
  }


?>


  <?php include("includes/footer.php"); ?>
  <!-- Chartjs -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
  let correctAnswered = $('#correctAnswered').val();
  let WrongAnswered = $('#WrongAnswered').val();
  let NotAnswered = $('#NotAnswered').val();
  let TotalAnswered = $('#TotalAnswered').val();

  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Total Answered', 'Correct Answered', 'Wrong Answered', 'Not Answered'],
      datasets: [{
        label: '',
        data: [TotalAnswered, correctAnswered, WrongAnswered, NotAnswered],
        backgroundColor: [
          '#FFC300',
          '#0EE134',
          'rgb(255, 99, 132)',
          'rgb(54, 162, 235)'

        ],
        hoverOffset: 4
      }]
    },

  });
  </script>

</body>

</html>