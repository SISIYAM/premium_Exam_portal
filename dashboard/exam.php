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
    padding: 20px 10px 20px 60px;
    border: 2px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    cursor: pointer;
    font-size: 18px;
    font-weight: 400;
    position: relative;
    border: 2px solid #CACACA;
  }

  .radio-item label:after,
  .radio-item label:before {
    content: "";
    position: absolute;
    border-radius: 50%;
  }

  .radio-item label:after {
    height: 20px;
    width: 20px;
    border: 2px solid #524eee;
    left: 20px;
    top: calc(50% - 12px);
  }

  .radio-item label:before {
    background: #585855;
    height: 17px;
    width: 17px;
    left: 21.5px;
    top: calc(50% - 10px);
    transform: scale(5);
    transition: .4s ease-in-out 0s;
    opacity: 0;
    visibility: hidden;
  }

  .radio-item [type="radio"]:checked~label {
    border-color: #59D933;
    background: #C1F0DB;
  }

  .radio-item [type="radio"]:checked~label:before {
    opacity: 1;
    visibility: visible;
    transform: scale(1);
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
  </style>
</head>

<body>

  <!-- Nav bar -->
  <?php include 'includes/nav.php'; ?>

  <?php 
    if(isset($_GET['Exam-ID'])){
      $examId= $_GET['Exam-ID'];
      $selectExam = mysqli_query($con,"SELECT * FROM exam WHERE exam_id = '$examId'");
      if(mysqli_num_rows($selectExam) > 0){
        $resultRow = mysqli_fetch_array($selectExam);
        $examNme = $resultRow['exam_name'];
        $duration = $resultRow['duration'];
        $mcqMarks = $resultRow['mcq_marks'];
        $writtenMarks = $resultRow['written_marks'];
        $exam_start_date = strtotime($resultRow['exam_start']);
        $new_start_date = date('d M Y', $exam_start_date);
        $exam_start_time = strtotime($resultRow['exam_start_time']);
        $new_start_time = date('h:i A',$exam_start_time);
        $exam_end_date = strtotime($resultRow['exam_end']);
        $new_end_date = date('d M Y', $exam_end_date);
        $exam_end_time = strtotime($resultRow['exam_end_time']);
        $new_end_time = date('h:i A',$exam_end_time);
        // current time
        date_default_timezone_set("Asia/Dhaka");
        $date = date('Y-m-d H:i');
        $current_time = strtotime($date);

        // convert into timestamp
        $examStartDate = $resultRow['exam_start']." ".$resultRow['exam_start_time'];
        $examEndDate = $resultRow['exam_end']." ".$resultRow['exam_end_time'];
  
        $examStartTimestamp = strtotime($examStartDate);
        $examEndTimestamp = strtotime($examEndDate);
      }
      ?>
  <div class="content-body">
    <div class="container-fluid">
      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            <h4><?=$examNme?></h4>

          </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Exam</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?=$examNme?></a></li>
          </ol>
        </div>
      </div>

      <?php
      if($current_time < $examStartTimestamp){
        ?>
      <div class="row">
        <div class="col-xl-12 col-xxl-12">
          <div class="card">
            <div class="card-body">
              <div class="card-header text-dark font-weight-bold">
                <h3> <?=$examNme?></h3>
              </div>


              <span class="badge bg-warning" style="color:#000000;width:100%;">Exam Will Started at
                <?=$new_start_date." ".$new_start_time?></span>

              <div class="text-dark">
                <p>Total marks: <?=$mcqMarks+$writtenMarks?></p>
                <p>MCQ marks: <?=$mcqMarks?></p>
                <?php
              if($writtenMarks != 0){
                ?>
                <p>Written marks: <?=$writtenMarks?></p>
                <?php
                }
              ?>
                <p>Time: <?php
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
                <p>Number of Questions: <?php 
                    $countQuestion = mysqli_query($con, "SELECT * FROM questions WHERE exam_id='$examId'");
                    $countNumbers = mysqli_num_rows($countQuestion);
                    echo $countNumbers;
                    ?></p>
              </div>
              <a href="list.php?Exams" class="btn btn-primary">Go Back</a>
            </div>




          </div>
        </div>
      </div>
      <?php
      }elseif($current_time >= $examStartTimestamp && $current_time < $examEndTimestamp){
        ?>
      <div class="row">
        <div class="col-xl-12 col-xxl-12">
          <form action="" method="post">
            <input type="hidden" value="<?=$examId?>" name="exam_id">
            <input type="hidden" value="<?=$duration?>" id="timeLeft">
            <div class="card">

              <?php 
          $i = 0;
          $select = mysqli_query($con, "SELECT * FROM questions WHERE exam_id='$examId'");
          if(mysqli_num_rows($select) > 0){
            while($row = mysqli_fetch_array($select)){
              $i++;
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
                  <?php
                 if(isset($row['option_1'])){
                  ?>
                  <div class="radio-item">
                    <input type="radio" name="<?=$row['id']?>" value="1 " id="radio1<?=$i?>">
                    <label for="radio1<?=$i?>"><?=$row['option_1']?></label>
                  </div>
                  <?php
                 }
                 ?>
                  <?php
                 if(isset($row['option_2'])){
                  ?>
                  <div class="radio-item">
                    <input type="radio" name="<?=$row['id']?>" value="2" id="radio2<?=$i?>">
                    <label for="radio2<?=$i?>"><?=$row['option_2']?></label>
                  </div>
                  <?php
                 }
                 ?>
                  <?php
                 if(isset($row['option_3'])){
                  ?>
                  <div class="radio-item">
                    <input type="radio" name="<?=$row['id']?>" value="3" id="radio3<?=$i?>">
                    <label for="radio3<?=$i?>"><?=$row['option_3']?></label>
                  </div>
                  <?php
                 }
                 ?>
                  <?php
                 if(isset($row['option_4'])){
                  ?>
                  <div class="radio-item">
                    <input type="radio" name="<?=$row['id']?>" value="4" id="radio4<?=$i?>">
                    <label for="radio4<?=$i?>"><?=$row['option_4']?></label>
                  </div>
                  <?php
                 }
                 ?>
                  <input type="radio" checked value="5" name="<?=$row['id']?>" style="display:none;">
                </div>

              </div>
              <?php
            }
          }
          ?>
              <button type="submit" name="submitExam" class="btn btn-primary btn-lg col-xl-12 text-light">Final
                Submission</button>
            </div>

          </form>
        </div>
      </div>
      <?php
      }elseif($current_time >= $examEndTimestamp){  
        ?>
      <div class="card text-center col-lg-12">
        <div class="card-header text-dark font-weight-bold">
          <h3> <?=$examNme?></h3>
        </div>
        <div class="card-body">
          <h6 class="card-title mb-4"><span class="alert alert-light">Opps! The exam was finished.</span></h6>

          <a href="result.php?Leader-Board=<?=$examId?>" class="btn btn-info">Leader Board</a>
        </div>
      </div>
      <?php
      }
      ?>

      <?php
    }else{
        echo '<div class="alert alert-danger text-light">Page not found</div>';
    }
    ?>

    </div>
  </div>



  <!--  Footer ---->
  <?php include "includes/footer.php"; ?>
  <?php include './includes/code.php';?>

</body>

</html>