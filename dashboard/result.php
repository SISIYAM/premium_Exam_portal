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

  <style>
  .radio-item [type="radio"] {
    display: none;
  }

  .radio-item+.radio-item {
    margin-top: 15px;
  }

  .radio-item label {
    width: 100%;
    color: #000000;
    display: block;
    padding: 20px 20px;
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 400;
    position: relative;
    border: 2px solid #CACACA;

  }

  .correct {
    border-color: #59D933;
    background: #C1F0DB;
  }

  .wrong {
    border-color: #59D933;
    background: #F8D7DA;
  }

  /* responsive cke-editor uploaded image */
  .radio-list img {
    max-width: 100%;
    height: auto !important;
  }

  .radio-item {
    max-width: 100%;
    height: auto !important;
  }

  .solution img {
    max-width: 100%;
    height: auto !important;
  }
  </style>
</head>

<body>

  <!-- Nav bar -->
  <?php include 'includes/nav.php'; ?>
  <!--**********************************
            Content body start
        ***********************************-->
  <div class="content-body">
    <!-- row -->
    <?php 
    if(isset($_GET['Exam-History'])){
      $exam_id = $_GET['Exam-History'];
      $select = mysqli_query($con, "SELECT * FROM exam WHERE exam_id='$exam_id'");
      if(mysqli_num_rows($select) > 0){
        $ExamRow = mysqli_fetch_array($select);

        $examName = $ExamRow['exam_name'];
        $totalMarks = $ExamRow['mcq_marks'] + $ExamRow['written_marks'];
        $mcq_marks = $ExamRow['mcq_marks'];
        $written_marks = $ExamRow['written_marks'];
        $examStart = $ExamRow['exam_start'];
        $examEnd = $ExamRow['exam_end']; 
        $duration = $ExamRow['duration'];
      }else{
        $examName = "N/A";
        $totalMarks = "N/A";
        $mcq_marks = "N/A";
        $written_marks = "N/A";
        $examStart = "N/A";
        $examEnd = "N/A";
        $duration = "N/A";
      }
    
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
                  $showResult = mysqli_query($con, "SELECT * FROM result WHERE student_id='$student_id' AND exam_id='$exam_id'");
                  if(mysqli_num_rows($showResult) > 0){
                    $showResultRow = mysqli_fetch_array($showResult);
                    ?>

        <!-- Pie chart section value -->
        <input type="hidden" id="total_mark" value="<?=$showResultRow['result']?>">
        <input type="hidden" id="right_answer" value="<?=$showResultRow['right_answered']?>">
        <input type="hidden" id="wrong_answer" value="<?=$showResultRow['wrong_answered']?>">
        <input type="hidden" id="not_answer" value="<?=$showResultRow['not_answered']?>">

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Obtained Marks </div>
                <div class="stat-digit"><?=$showResultRow['result']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Correct Answer</div>
                <div class="stat-digit"><?=$showResultRow['right_answered']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Wrong Answer</div>
                <div class="stat-digit"><?=$showResultRow['wrong_answered']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Not Answered</div>
                <div class="stat-digit"><?=$showResultRow['not_answered']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <!-- /# card -->
        </div>
        <!-- /# column -->
      </div>


      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Your Marks</h4>
                </div>
                <div class="card-body">
                  <div id="morris_donught" class="morris_chart_height"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"><?=$examName?></h4>
                </div>
                <div class="card-body">
                  <p class="badge badge-rounded badge-outline-dark">Total Marks: <?=$mcq_marks?></p> <br>
                  <p class="badge badge-rounded badge-outline-dark">Exam Date: <?=$examStart?></p> <br>
                  <p class="badge badge-rounded badge-outline-dark">Exam End: <?=$examEnd?></p> <br>
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
                      ?></p> <br>
                  <p class="badge badge-rounded badge-outline-dark">Biology</p>
                  <div class="my-2">
                    <a href="result.php?Solution=<?=$exam_id?>"><button class="btn btn-primary mr-2">View
                        Solution</button></a>
                    <a href="leaderboard.php?Leader-Board=<?=$exam_id?>"> <button class="btn btn-dark my-2">Leader
                        Board</button></a>
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
    }elseif (isset($_GET['Custom-Exam-History'])) {
      $exam_id = $_GET['Custom-Exam-History'];
      $select = mysqli_query($con, "SELECT * FROM custom_exam WHERE exam_id='$exam_id'");
      if(mysqli_num_rows($select) > 0){
        $ExamRow = mysqli_fetch_array($select);

        $examName = $ExamRow['exam_name'];
        $mcq_marks = $ExamRow['mcq_marks'];
        $examStart = $ExamRow['exam_start'];
        $duration = $ExamRow['duration'];
      }else{
        $examName = "N/A";
        $mcq_marks = "N/A";
        $examStart = "N/A";
        $duration = "N/A";
      }
    
    ?>
    <div class="container-fluid">
      <div class="row">
        <?php
                  $showResult = mysqli_query($con, "SELECT * FROM result WHERE student_id='$student_id' AND exam_id='$exam_id'");
                  if(mysqli_num_rows($showResult) > 0){
                    $showResultRow = mysqli_fetch_array($showResult);
                    ?>
        <!-- Pie chart section value -->
        <input type="hidden" id="total_mark" value="<?=$showResultRow['result']?>">
        <input type="hidden" id="right_answer" value="<?=$showResultRow['right_answered']?>">
        <input type="hidden" id="wrong_answer" value="<?=$showResultRow['wrong_answered']?>">
        <input type="hidden" id="not_answer" value="<?=$showResultRow['not_answered']?>">

        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Obtained Marks </div>
                <div class="stat-digit"><?=$showResultRow['result']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Correct Answer</div>
                <div class="stat-digit"><?=$showResultRow['right_answered']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Wrong Answer</div>
                <div class="stat-digit"><?=$showResultRow['wrong_answered']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6">
          <div class="card">
            <div class="stat-widget-two card-body">
              <div class="stat-content">
                <div class="stat-text">Not Answered</div>
                <div class="stat-digit"><?=$showResultRow['not_answered']?></div>
              </div>
              <div class="progress">
                <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65"
                  aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
          <!-- /# card -->
        </div>
        <!-- /# column -->
      </div>


      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-lg-6 col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Your Marks</h4>
                </div>
                <div class="card-body">
                  <div id="morris_donught" class="morris_chart_height"></div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-sm-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"><?=$examName?></h4>
                </div>
                <div class="card-body">
                  <p class="badge badge-rounded badge-outline-dark">Total Marks: <?=$mcq_marks?></p> <br>
                  <p class="badge badge-rounded badge-outline-dark">Exam Date: <?=$examStart?></p> <br>
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
                      ?></p> <br>
                  <p class="badge badge-rounded badge-outline-dark">Biology</p>
                  <div class="my-2">
                    <a href="result.php?Custom-Solution=<?=$exam_id?>"><button class="btn btn-primary mr-2">View
                        Solution</button></a>
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
    }elseif(isset($_GET['Solution'])){
      $examId = $_GET['Solution'];
      $select = mysqli_query($con, "SELECT * FROM exam WHERE exam_id='$examId'");
      if(mysqli_num_rows($select) > 0){
        $examName = mysqli_fetch_array($select)['exam_name'];
      }else{
        $examName = "N/A";
      }
      ?>
    <div class="row">
      <div class="col-xl-12 col-xxl-12">
        <div class="card">

          <?php 
              $i = 1;
              $select = mysqli_query($con, "SELECT * FROM questions WHERE exam_id='$examId'");
              if(mysqli_num_rows($select) > 0)
              {
                while($row = mysqli_fetch_array($select)){
                  $questionID = $row['id'];
                  $correctAnswer = $row['answer'];
                  $matchQuestion = mysqli_query($con, "SELECT * FROM record WHERE exam_id='$examId' AND student_id='$student_id' AND question_id='$questionID'");
                  if(mysqli_num_rows($matchQuestion) > 0){
                    $answeredOption = mysqli_fetch_array($matchQuestion)['answered'];
                  }else{
                    $answeredOption = 5;
                  }
                  ?>

          <div class="card-body">
            <h6 class="badge bg-primary text-light" style="font-size:13px">Question : <?=$i?> </h6>
            <span class="badge bg-light text-dark"
              style="float: right; margin-right:20px; color:#000000; font-weight:bold">Mark
              :
              <?=$row['mark']?></span>
            <div class="radio-list col-xl-12">
              <p for="" class="font-weight-bold text-dark my-3 h4" style="color:#000000;">
                <?=$row['question']?>
              </p>
              <!-- if user answered correct answer then -->
              <?php
                  if($answeredOption == $correctAnswer){
                  ?>
              <div class="radio-item">
                <label <?php if($answeredOption == 1){
                      ?> class="correct" <?php
                    } ?> for="radio1<?=$i?>"><?=$row['option_1']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 2){
                      ?> class="correct" <?php
                    } ?> for="radio2<?=$i?>"><?=$row['option_2']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 3){
                      ?> class="correct" <?php
                    } ?> for="radio3<?=$i?>"><?=$row['option_3']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 4){
                      ?> class="correct" <?php
                    } ?> for="radio4<?=$i?>"><?=$row['option_4']?></label>
              </div>
              <?php  
            }elseif($answeredOption == 5){
              ?>
              <span class="btn btn-dark mb-4">Not Answered</span>
              <div class="radio-item">
                <label <?php if($correctAnswer == 1){
                      ?> class="correct" <?php
                    } ?> for="radio1<?=$i?>"><?=$row['option_1']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($correctAnswer == 2){
                      ?> class="correct" <?php
                    } ?> for="radio2<?=$i?>"><?=$row['option_2']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($correctAnswer == 3){
                      ?> class="correct" <?php
                    } ?> for="radio3<?=$i?>"><?=$row['option_3']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($correctAnswer == 4){
                      ?> class="correct" <?php
                    } ?> for="radio4<?=$i?>"><?=$row['option_4']?></label>
              </div>
              <?php
            }else{
              ?>
              <div class="radio-item">
                <label <?php if($answeredOption == 1){
                        ?> class="wrong" <?php
                      } if($correctAnswer == 1){
                        ?> class="correct" <?php
                      } ?> for="radio1<?=$i?>"><?=$row['option_1']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 2){
                        ?> class="wrong" <?php
                      } if($correctAnswer == 2){
                        ?> class="correct" <?php
                      } ?> for="radio2<?=$i?>"><?=$row['option_2']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 3){
                        ?> class="wrong" <?php
                      } if($correctAnswer == 3){
                        ?> class="correct" <?php
                      } ?> for="radio3<?=$i?>"><?=$row['option_3']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 4){
                        ?> class="wrong" <?php
                      } if($correctAnswer == 4){
                        ?> class="correct" <?php
                      } ?> for="radio4<?=$i?>"><?=$row['option_4']?></label>
              </div>
              <?php
            }
              ?>
            </div>

          </div>
          <?php
                  if($row['solution'] > 0){
                    ?>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <div class="card bg-light text-dark">
                  <div class="card-body rounded" style="border:2px solid #2EAD1E">
                    <span class="font-weight-bold text-dark">Solution:</span>
                    <div class="solution">
                      <?=$row['solution']?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
                  }
                  ?>
          <?php
          $i++;
            }
          }
          ?>
        </div>

        </form>
      </div>
    </div>
    <?php
    }elseif (isset($_GET['Custom-Solution'])) {
      $examId = $_GET['Custom-Solution'];
      $select = mysqli_query($con, "SELECT * FROM custom_exam WHERE exam_id='$examId'");
      if(mysqli_num_rows($select) > 0){
        $examName = mysqli_fetch_array($select)['exam_name'];
      }else{
        $examName = "N/A";
      }
      ?>
    <div class="row">
      <div class="col-xl-12 col-xxl-12">
        <div class="card">

          <?php 
              
              $select = mysqli_query($con, "SELECT * FROM questions");
              if(mysqli_num_rows($select) > 0)
              {
                while($row = mysqli_fetch_array($select)){
                  $questionID = $row['id'];
                  $correctAnswer = $row['answer'];
                  $record_questions = mysqli_query($con, "SELECT * FROM record WHERE exam_id='$examId' AND student_id='$student_id'");
                  if(mysqli_num_rows($record_questions) > 0){
                    $i = 0;
                    while($record_question_id = mysqli_fetch_array($record_questions)){
                    $i++;
                      if($questionID == $record_question_id['question_id']){
                        $matchQuestion = mysqli_query($con, "SELECT * FROM record WHERE exam_id='$examId' AND student_id='$student_id' AND question_id='$questionID'");
                        if(mysqli_num_rows($matchQuestion) > 0){
                          $answeredOption = mysqli_fetch_array($matchQuestion)['answered'];
                        }else{
                          $answeredOption = 5;
                        }
                        ?>

          <div class="card-body">
            <h6 class="badge bg-primary text-light" style="font-size:13px">Question : <?=$i?> </h6>
            <span class="badge bg-light text-dark"
              style="float: right; margin-right:20px; color:#000000; font-weight:bold">Mark
              :
              <?=$row['mark']?></span>
            <div class="radio-list col-xl-12">
              <p for="" class="font-weight-bold text-dark my-3 h4" style="color:#000000;">
                <?=$row['question']?>
              </p>
              <!-- if user answered correct answer then -->
              <?php
                        if($answeredOption == $correctAnswer){
                        ?>
              <div class="radio-item">
                <label <?php if($answeredOption == 1){
                            ?> class="correct" <?php
                          } ?> for="radio1<?=$i?>"><?=$row['option_1']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 2){
                            ?> class="correct" <?php
                          } ?> for="radio2<?=$i?>"><?=$row['option_2']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 3){
                            ?> class="correct" <?php
                          } ?> for="radio3<?=$i?>"><?=$row['option_3']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 4){
                            ?> class="correct" <?php
                          } ?> for="radio4<?=$i?>"><?=$row['option_4']?></label>
              </div>
              <?php  
                  }elseif($answeredOption == 5){
                    ?>
              <span class="btn btn-dark mb-4">Not Answered</span>
              <div class="radio-item">
                <label <?php if($correctAnswer == 1){
                            ?> class="correct" <?php
                          } ?> for="radio1<?=$i?>"><?=$row['option_1']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($correctAnswer == 2){
                            ?> class="correct" <?php
                          } ?> for="radio2<?=$i?>"><?=$row['option_2']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($correctAnswer == 3){
                            ?> class="correct" <?php
                          } ?> for="radio3<?=$i?>"><?=$row['option_3']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($correctAnswer == 4){
                            ?> class="correct" <?php
                          } ?> for="radio4<?=$i?>"><?=$row['option_4']?></label>
              </div>
              <?php
                  }else{
                    ?>
              <div class="radio-item">
                <label <?php if($answeredOption == 1){
                              ?> class="wrong" <?php
                            } if($correctAnswer == 1){
                              ?> class="correct" <?php
                            } ?> for="radio1<?=$i?>"><?=$row['option_1']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 2){
                              ?> class="wrong" <?php
                            } if($correctAnswer == 2){
                              ?> class="correct" <?php
                            } ?> for="radio2<?=$i?>"><?=$row['option_2']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 3){
                              ?> class="wrong" <?php
                            } if($correctAnswer == 3){
                              ?> class="correct" <?php
                            } ?> for="radio3<?=$i?>"><?=$row['option_3']?></label>
              </div>

              <div class="radio-item">
                <label <?php if($answeredOption == 4){
                              ?> class="wrong" <?php
                            } if($correctAnswer == 4){
                              ?> class="correct" <?php
                            } ?> for="radio4<?=$i?>"><?=$row['option_4']?></label>
              </div>
              <?php
                  }
                    ?>
            </div>

          </div>
          <?php
                        if($row['solution'] > 0){
                          ?>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12 mb-4">
                <div class="card bg-light text-dark">
                  <div class="card-body rounded" style="border:2px solid #2EAD1E">
                    <span class="font-weight-bold text-dark">Solution:</span>
                    <div class="solution">
                      <?=$row['solution']?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
                        }
                      }
                      
          }
        }


         
            }
          }
          ?>
        </div>

        </form>
      </div>
    </div>
    <?php
    }else{
      echo "<p class='alert alert-danger'>Page Not Found!</p>";
    }
    ?>
  </div>
  <!--**********************************
            Content body end
        ***********************************-->







  <?php include("includes/footer.php"); ?>
  <!-- Chart Morris plugin files -->
  <script src="./vendor/raphael/raphael.min.js"></script>
  <script src="./vendor/morris/morris.min.js"></script>
  <!-- <script src="./js/plugins-init/morris-init.js"></script>  -->
  <script>
  let total_mark = $('#total_mark').val();
  let right_answer = $('#right_answer').val();
  let wrong_answer = $('#wrong_answer').val();
  let not_answer = $('#not_answer').val();
  (function($) {
    "use strict"


    Morris.Donut({
      element: 'morris_donught',
      data: [{
          label: "\xa0 \xa0 Total marks \xa0 \xa0",
          value: total_mark,

        },
        {
          label: "\xa0 \xa0 Right Answered \xa0 \xa0",
          value: right_answer,

        }, {
          label: "\xa0 \xa0 Wrong Answered \xa0 \xa0",
          value: wrong_answer
        }, {
          label: "\xa0 \xa0 Not Answered \xa0 \xa0",
          value: not_answer
        }
      ],
      resize: true,
      colors: ['#7ED321', '#593bdb', '#FFAA16', '#FF1616']
    });






  })(jQuery);
  </script>

</body>

</html>