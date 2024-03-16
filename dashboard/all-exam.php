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

  <!--**********************************
            Content body start
        ***********************************-->
  <div class="content-body">
    <?php
if(isset($_GET['Exams'])){
  ?>
    <div class="row page-titles mx-0">
      <div class="col-sm-6 p-md-0">
        <div class="welcome-text">
          <h4>Available Exams</h4>

        </div>
      </div>
      <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active"><a href="javascript:void(0)">All Exams</a></li>
        </ol>
      </div>
    </div>
    <div class="container-fluid">

      <div class="row">
        <?php
                  $no = 1;
                  $select = mysqli_query($con, "SELECT * FROM exam WHERE status = 1 ORDER BY id DESC");
                  if(mysqli_num_rows($select) > 0){
                 
                   while($row = mysqli_fetch_array($select)){
                      $examID = $row['exam_id'];
                      $examType = $row['type'];
                      $duration = $row['duration'];
                      $exam_start_date = strtotime($row['exam_start']);
                      $new_start_date = date('d M Y', $exam_start_date);
                      $exam_start_time = strtotime($row['exam_start_time']);
                      $new_start_time = date('h:i A',$exam_start_time);
                      $exam_end_date = strtotime($row['exam_end']);
                      $new_end_date = date('d M Y', $exam_end_date);
                      $exam_end_time = strtotime($row['exam_end_time']);
                      $new_end_time = date('h:i A',$exam_end_time);
                      // current time
                      date_default_timezone_set("Asia/Dhaka");
                      $date = date('Y-m-d H:i');
                      $current_time = strtotime($date);

                      // convert into timestamp
                        $examStartDate = $row['exam_start']." ".$row['exam_start_time'];
                        $examEndDate = $row['exam_end']." ".$row['exam_end_time'];
  
                        $examStartTimestamp = strtotime($examStartDate);
                        $examEndTimestamp = strtotime($examEndDate);
                      ?>

        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=$row['exam_name']?></h5>
              <?php 
                      if($current_time >= $examStartTimestamp && $current_time < $examEndTimestamp){
                        ?>
              <span class="float-right text-light"><img src="./images/live.png" width="50px" height="40px"
                  alt=""></span>
              <?php
                      }
                      ?>
            </div>
            <div class="card-body">

              <div class="card-text">
                <p class="badge badge-rounded badge-outline-dark">MCQ Marks: <?=$row['mcq_marks']?></p> <br>
                <p class="badge badge-rounded badge-outline-dark">Number of questions: <?php 
                    $countQuestion = mysqli_query($con, "SELECT * FROM questions WHERE exam_id='$examID'");
                    $countNumbers = mysqli_num_rows($countQuestion);
                    if($countNumbers > 0){
                      $fetchQuestion = mysqli_fetch_array($countQuestion);
                      $questionNegativeMark = $fetchQuestion['negative_mark'];
                    }else{
                      $questionNegativeMark = 0;
                    }
                    echo $countNumbers;
                    ?></p> <br>
                <p class="badge badge-rounded badge-outline-dark">Exam Start: <?=$new_start_date." ".$new_start_time?>
                </p> <br>
                <p class="badge badge-rounded badge-outline-dark">Exam End: <?=$new_end_date." ".$new_end_time?></p>
                <br>
                <p class="badge badge-rounded badge-outline-dark">Exam Duration: <?php
                      if(((int)($duration/3600)) == 0 && ((int)($duration%3600)/60) != 0 && (($duration%3600)%60) != 0){
                        echo ((int)(($duration%3600)/60)." min ".(($duration%3600)%60)." Sec");
                      }elseif (((int)($duration/3600)) != 0 && ((int)($duration%3600)/60) != 0 && (($duration%3600)%60) == 0) {
                        echo ((int)($duration/3600)." hour ".(int)(($duration%3600)/60)." min " );
                      }elseif (((int)($duration/3600)) == 0 && (($duration%3600)%60) == 0 && ((int)($duration%3600)/60) != 0) {
                        echo ((int)(($duration%3600)/60)." min " );
                      }elseif (((int)($duration/3600)) != 0 && ((int)($duration%3600)/60) == 0 && (($duration%3600)%60)==0) {
                        echo ((int)($duration/3600)." hour ");
                      } else{
                        echo ((int)($duration/3600)." hour ".(int)(($duration%3600)/60)." min ".(($duration%3600)%60)." Sec");
                      }
                      ?></p>
                <br>

              </div>

              <div class="card-text">
                <span class="badge badge-rounded badge-success"><?=$row['mcq_marks']?> marks</span>
                <span class="badge badge-rounded badge-danger">Negative marking: <?=$questionNegativeMark?></span>

              </div>
            </div>
            <div class="card-footer">
              <div class="my-2">
                <?php 
                       // exam type condition 
                       if($examType == 1){
                      // check is user already give exam or not
                      $checkStudent = mysqli_query($con, "SELECT * FROM result WHERE student_id='$student_id' AND exam_id='$examID'");
                      if(mysqli_num_rows($checkStudent) > 0){
                      ?>
                <button class="btn btn-warning btn-sm">Already Given</button>
                <a href="result.php?Exam-History=<?=$row['exam_id']?>"><button class="btn btn-danger mx-2 my-2">View
                    Result
                  </button></a>
                <?php
                      }else{
                      
                      if($current_time < $examStartTimestamp){
                        ?>
                <button style="max-width:100%; color:#000000; font-size:0.6rem;" class="badge bg-warning">Exam
                  will started at
                  <?=$new_start_date." ".$new_start_time?></button>
                <?php
                      }elseif($current_time >= $examStartTimestamp && $current_time < $examEndTimestamp){
                        ?>
                <a href="exam.php?Exam-ID=<?=$row['exam_id']?>"><button class="btn btn-primary mr-2">Start
                  </button></a>
                <a href="result.php?Leader-Board=<?=$row['exam_id']?>"><button class="btn btn-info my-2 mx-2">Leader
                    Board</button></a>
                <?php
                      }elseif($current_time >= $examEndTimestamp){
                        ?>
                <button class="btn btn-light btn-sm">Finished</button>
                <a href="result.php?Leader-Board=<?=$row['exam_id']?>"><button class="btn btn-info my-2 mx-2">Leader
                    Board</button></a>
                <?php
                      }
                      ?>
                <!-- <a href="exam.php?Exam-ID=<?=$row['exam_id']?>"><button class="btn btn-success mr-2">Start
                        </button></a> -->
                <?php
                      }
                       }else{     
                        if($current_time < $examStartTimestamp){
                          ?>
                <button style="max-width:100%; color:#000000; font-size:0.6rem;" class="badge bg-warning">Exam
                  will started at
                  <?=$new_start_date." ".$new_start_time?></button>
                <?php
                        }elseif($current_time >= $examStartTimestamp && $current_time < $examEndTimestamp){
                          ?>
                <a href="exam.php?Exam-ID=<?=$row['exam_id']?>"><button class="btn btn-primary mr-2">Start
                  </button></a>
                <a href="result.php?Leader-Board=<?=$row['exam_id']?>"><button class="btn btn-info my-2 mx-2">Leader
                    Board</button></a>
                <?php
                        }elseif($current_time >= $examEndTimestamp){
                          ?>
                <button class="btn btn-light btn-sm">Finished</button>
                <a href="result.php?Leader-Board=<?=$row['exam_id']?>"><button class="btn btn-info my-2 mx-2">Leader
                    Board</button></a>
                <?php
                        }
                        ?>
                <!-- <a href="exam.php?Exam-ID=<?=$row['exam_id']?>"><button class="btn btn-success mr-2">Start
                          </button></a> -->
                <?php
                       
                       }
                       
                       ?>

              </div>

            </div>
          </div>
        </div>


        <?php
                   }
                  }else{
                    echo "<p class='alert alert-danger'>No data found!</p>";
                  }
              ?>

      </div>
    </div>
    <?php
}elseif(isset($_GET['Given-Exams'])){
 
        $no = 1;
        $searchGivenExam = mysqli_query($con, "SELECT * FROM result WHERE student_id='$student_id' ORDER BY id DESC");
        if(mysqli_num_rows($searchGivenExam) > 0){
      ?>
    <div class="container-fluid">

      <div class="row">
        <?php
         while( $givenExamRow = mysqli_fetch_array($searchGivenExam)){
          $givenExamId = $givenExamRow['exam_id'];
          
          $select = mysqli_query($con, "SELECT * FROM exam WHERE exam_id='$givenExamId' ORDER BY id DESC");
          $selectCustomExam = mysqli_query($con, "SELECT * FROM custom_exam WHERE exam_id='$givenExamId' ORDER BY id DESC");
          if(mysqli_num_rows($select) > 0){
         
              $row = mysqli_fetch_array($select);
              $examID = $row['exam_id'];
              $duration = $row['duration'];
              ?>
        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=$row['exam_name']?></h5>
            </div>
            <div class="card-body">
              <div class="card-text">
                <p class="badge badge-rounded badge-outline-dark">MCQ Marks: <?=$row['mcq_marks']?></p> <br>
                <p class="badge badge-rounded badge-outline-dark">Number of questions: <?php 
                    $countQuestion = mysqli_query($con, "SELECT * FROM questions WHERE exam_id='$examID'");
                    $countNumbers = mysqli_num_rows($countQuestion);
                    if($countNumbers > 0){
                      $fetchQuestion = mysqli_fetch_array($countQuestion);
                      $questionNegativeMark = $fetchQuestion['negative_mark'];
                    }else{
                      $questionNegativeMark = 0;
                    }
                    echo $countNumbers;
                    ?></p> <br>
                <p class="badge badge-rounded badge-outline-dark">Exam Start: <?=$row['exam_start']?>
                </p> <br>
                <p class="badge badge-rounded badge-outline-dark">Exam End: <?=$row['exam_end']?></p>
                <br>
                <p class="badge badge-rounded badge-outline-dark">Exam Duration: <?php
                      if(((int)($duration/3600)) == 0 && ((int)($duration%3600)/60) != 0 && (($duration%3600)%60) != 0){
                        echo ((int)(($duration%3600)/60)." min ".(($duration%3600)%60)." Sec");
                      }elseif (((int)($duration/3600)) != 0 && ((int)($duration%3600)/60) != 0 && (($duration%3600)%60) == 0) {
                        echo ((int)($duration/3600)." hour ".(int)(($duration%3600)/60)." min " );
                      }elseif (((int)($duration/3600)) == 0 && (($duration%3600)%60) == 0 && ((int)($duration%3600)/60) != 0) {
                        echo ((int)(($duration%3600)/60)." min " );
                      }elseif (((int)($duration/3600)) != 0 && ((int)($duration%3600)/60) == 0 && (($duration%3600)%60)==0) {
                        echo ((int)($duration/3600)." hour ");
                      } else{
                        echo ((int)($duration/3600)." hour ".(int)(($duration%3600)/60)." min ".(($duration%3600)%60)." Sec");
                      }
                      ?></p>
                <br>

              </div>
            </div>
            <div class="card-footer">
              <div class="my-2">
                <a href="result.php?Exam-History=<?=$row['exam_id']?>"><button class="btn btn-dark mr-2">View
                    Result
                  </button></a>
                <a href="leaderboard.php?Leader-Board=<?=$row['exam_id']?>"><button class="btn btn-primary my-2">Leader
                    Board</button></a>
              </div>

            </div>
          </div>
        </div>
        <?php
          }
        // Custom exam
          if(mysqli_num_rows($selectCustomExam)){
            $customRow = mysqli_fetch_array($selectCustomExam);
            $examID = $customRow['exam_id'];
            $duration = $customRow['duration'];
            $totalQuestions = $givenExamRow['wrong_answered'] + $givenExamRow['right_answered'] + $givenExamRow['not_answered'];
            ?>
        <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title"><?=$customRow['exam_name']?></h5>

            </div>
            <div class="card-body">
              <div class="card-text">
                <p class="badge badge-rounded badge-outline-dark">MCQ Marks: <?=$customRow['mcq_marks']?></p> <br>
                <p class="badge badge-rounded badge-outline-dark">Number Of Questions: <?=$totalQuestions?></p>
                <br>
                <p class="badge badge-rounded badge-outline-dark">Exam Date: <?=$customRow['exam_start']?>
                </p>
                <br>
                <p class="badge badge-rounded badge-outline-dark">Exam Duration: <?php
                    if(((int)($duration/3600)) == 0 && ((int)($duration%3600)/60) != 0 && (($duration%3600)%60) != 0){
                      echo ((int)(($duration%3600)/60)." min ".(($duration%3600)%60)." Sec");
                    }elseif (((int)($duration/3600)) != 0 && ((int)($duration%3600)/60) != 0 && (($duration%3600)%60) == 0) {
                      echo ((int)($duration/3600)." hour ".(int)(($duration%3600)/60)." min " );
                    }elseif (((int)($duration/3600)) == 0 && (($duration%3600)%60) == 0 && ((int)($duration%3600)/60) != 0) {
                      echo ((int)(($duration%3600)/60)." min " );
                    }elseif (((int)($duration/3600)) != 0 && ((int)($duration%3600)/60) == 0 && (($duration%3600)%60)==0) {
                      echo ((int)($duration/3600)." hour ");
                    } else{
                      echo ((int)($duration/3600)." hour ".(int)(($duration%3600)/60)." min ".(($duration%3600)%60)." Sec");
                    }
                    ?></p>
                <br>
                <br>
                <br>
                <br>

              </div>
            </div>
            <div class="card-footer">
              <div class="my-2">
                <a href="result.php?Custom-Exam-History=<?=$customRow['exam_id']?>"><button
                    class="btn btn-dark mr-2">View
                    Result
                  </button></a>

                <span class="float-right badge badge-sm badge-secondary">Custom Exam</span>

              </div>

            </div>
          </div>
        </div>
        <?php
          }

          
        }
        ?>
      </div>
    </div>
    <?php
      }else{
        echo "<p class='alert alert-danger'>No data found!</p>";
      }             
}else{
  echo "<p class='alert alert-danger'>No data found!</p>";
}
?>
  </div>
  <!--**********************************
Content body end
***********************************-->

  <?php include("includes/footer.php"); ?>

</body>

</html>