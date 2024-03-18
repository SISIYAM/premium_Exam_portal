<?php
// Register New Admin
if(isset($_POST['registerAdminBtn'])){
  $full_name = mysqli_real_escape_string($con, $_POST['full_name']) ;
  $username = mysqli_real_escape_string($con, $_POST['username']) ;
  $email = mysqli_real_escape_string($con, $_POST['email']) ;
  $post = mysqli_real_escape_string($con, $_POST['post']) ;
  $password = mysqli_real_escape_string($con, $_POST['password']) ;
  $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']) ;

  $pass = password_hash($password,  PASSWORD_BCRYPT);
  $cpass = password_hash($confirm_password, PASSWORD_BCRYPT);

    $user_count = "select * from admin where username= '$username' ";
    $userQuery = mysqli_query($con,$user_count);
    $userCount = mysqli_num_rows($userQuery);

    if($userCount > 0){
      ?>
<script>
Swal.fire({
  icon: "warning",
  title: "This username already exist, Please use another username",
}).then(() => {
  location.replace("login.php?register");
});
</script>
<?php 
    }else{
      $emailQuery = " select * from admin where email= '$email'";
      $query = mysqli_query($con,$emailQuery);

      $emailCount = mysqli_num_rows($query);

    if($emailCount > 0){
      ?>
<script>
Swal.fire({
  icon: "warning",
  title: "This email already exist, Please use another email.",
}).then(() => {
  location.replace("login.php?register");
});
</script>
<?php 
    }else{
      if($password === $confirm_password){

          $insertQuery = "INSERT INTO `admin` ( `full_name`, `username`, `email`,`post`, `password`, `confirm_password`)
          VALUES ( '$full_name', '$username', '$email','$post', '$pass', '$cpass')";

            $iQuery = mysqli_query($con, $insertQuery);

          if($iQuery){
            ?>
<script>
Swal.fire({
  icon: "success",
  title: "Congratulations <?=$username?>! Your account created successfully. Now you can log in!",
}).then(() => {
  location.replace("login.php?login");
});
</script>
<?php
          }else{
            ?>
<script>
Swal.fire({
  icon: "error",
  title: "Registration Failed",
}).then(() => {
  location.replace("login.php?register");
});
</script>
<?php    
          }

      }else{

        ?>
<script>
Swal.fire({
  icon: "warning",
  title: "Password and confirm password doesn't matched!",
}).then(() => {
  location.replace("login.php?register");
});
</script>
<?php 

          }
    }
  }
}

// admin login
if(isset($_POST['adminLoginBtn'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

    $username_search = " select * from admin where username='$username'";
    $query = mysqli_query($con,$username_search);

    $username_count = mysqli_num_rows($query);

    if($username_count){
        $username_pass = mysqli_fetch_assoc($query);

        $db_pass = $username_pass['password'];

        $_SESSION['username'] = $username_pass['username'];
        $_SESSION['email'] = $username_pass['email'];
        $_SESSION['id'] = $username_pass['id'];
        $_SESSION['post'] = $username_pass['post'];
        
        $pass_decode = password_verify($password, $db_pass);

        if($pass_decode){
          ?>
<script>
location.replace("index.php");
</script>
<?php
         }else{
          ?>
<script>
Swal.fire({
  icon: "error",
  title: "Incorrect Password!",
}).then(() => {
  location.replace("login.php?login");
});
</script>
<?php 
         }

     }else{
      ?>
<script>
Swal.fire({
  icon: "warning",
  title: "Invalid Username!",
}).then(() => {
  location.replace("login.php?login");
});
</script>
<?php 
     }

}

// add exam
if (isset($_POST['submitExamBtn'])) {
  $ChangeExam_name = $_POST['exam_name'];
  $exam_name = str_replace("'","\'", $ChangeExam_name);
  $exam_id = uniqid();
  $duration = (($_POST['duration_hour'] * 3600) + ($_POST['duration_minute'] * 60) + ($_POST['duration_seconds']));
  $exam_start = $_POST['start_date'];
  $exam_start_time = $_POST['start_time'];
  $exam_end = $_POST['end_date'];
  $exam_end_time = $_POST['end_time'];
  $mcq_marks = $_POST['mcq_marks'];
  $exam_type = $_POST['exam_type'];
  $added_by = $_SESSION['username'];
  
    $sql = "INSERT INTO `exam`(`exam_name`, `exam_id`, `duration`, `exam_start`, `exam_start_time`, `exam_end`,`exam_end_time`,`mcq_marks`,`type`,`added_by`) 
    VALUES ('$exam_name','$exam_id','$duration','$exam_start','$exam_start_time','$exam_end','$exam_end_time','$mcq_marks','$exam_type','$added_by')";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      $_SESSION['message'] = "Success";
      ?>
<script>
location.replace("list.php?Exam");
</script>
<?php
    } else {
      $_SESSION['error'] = "Failed";
      ?>
<script>
location.replace("list.php?Exam");
</script>
<?php
  
    }
}

// add custom exam
if (isset($_POST['submitCustomExam'])) {
  $ChangeExam_name = $_POST['exam_name'];
  $exam_name = str_replace("'","\'", $ChangeExam_name);
  $exam_id = uniqid();
  $duration = (($_POST['duration_hour'] * 3600) + ($_POST['duration_minute'] * 60) + ($_POST['duration_seconds']));
  $exam_start = $_POST['start_date'];
  $exam_start_time = $_POST['start_time'];
  $exam_end = $_POST['end_date'];
  $exam_end_time = $_POST['end_time'];
  $marks = $_POST['marks'];
  $negative_mark = $_POST['negative_marks'];
  $exam_type = $_POST['exam_type'];
  $custom_exam_type = 1;
  $added_by = $_SESSION['username'];
 
    $sql = "INSERT INTO `exam`(`exam_name`, `exam_id`, `duration`, `exam_start`, `exam_start_time`, `exam_end`,`exam_end_time`,`type`,`added_by`,`custom_exam_type`,`negative_mark`,`marks`) 
    VALUES ('$exam_name','$exam_id','$duration','$exam_start','$exam_start_time','$exam_end','$exam_end_time','$exam_type','$added_by','$custom_exam_type','$negative_mark','$marks')";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      $sumMarks=0;
      $searchSubjectColumn= mysqli_query($con, "SELECT * FROM subjects");
      if(mysqli_num_rows($searchSubjectColumn) > 0){
        while ($subjectRow = mysqli_fetch_array($searchSubjectColumn)) {
          if($_POST[$subjectRow['id']] != 0 && $_POST[$subjectRow['id']] != NULL){
            $subject = $subjectRow['subject'];
            $limit = $_POST[$subjectRow['id']];
            $sumMarks = ($sumMarks + $limit);
            $updateExamSql = mysqli_query($con, "UPDATE exam SET $subject='$limit' WHERE exam_id='$exam_id'");
          }
        }
      }
      $TotalMarks = $sumMarks * $marks;
      mysqli_query($con, "UPDATE exam SET mcq_marks='$TotalMarks' WHERE exam_id='$exam_id'");

      $_SESSION['message'] = "Success";
      ?>
<script>
location.replace("list.php?Exam");
</script>
<?php
    } else {
      $_SESSION['error'] = "Failed";
      ?>
<script>
location.replace("list.php?Exam");
</script>
<?php
  
    }
}

// Add MCQ Question
if (isset($_POST['addQuestion'])) {
  $exam_id = $_POST['exam_id'];
  $subject_id = $_POST['subject_id'];
  $marks = $_POST['marks'];
  $question_type= 1;
  $negative_marks = $_POST['negative_marks'];
  $changeQuestion = $_POST['question'];
  $question = str_replace("'","\'", $changeQuestion);
  $changeOption_1 = $_POST['option_1'];
  $option_1 = str_replace("'","\'", $changeOption_1);
  $changeOption_2 = $_POST['option_2'];
  $option_2 = str_replace("'","\'", $changeOption_2);
  $changeOption_3 = $_POST['option_3'];
  $option_3 = str_replace("'","\'", $changeOption_3);
  $changeOption_4 = $_POST['option_4'];
  $option_4 = str_replace("'","\'", $changeOption_4);
  $changeSolution = $_POST['solution'];
  $solution = str_replace("'","\'", $changeSolution);
  $answer = $_POST['answer'];
  $added_by = $_SESSION['username'];
  
    $sql = "INSERT INTO `questions`(`exam_id`,`subject_id`, `question_type`,`question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `mark`, `negative_mark`,`solution`,`added_by`)
    VALUES ('$exam_id','$subject_id','$question_type','$question','$option_1','$option_2','$option_3','$option_4','$answer','$marks','$negative_marks','$solution','$added_by')";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      $_SESSION['mcq_message'] = "Success";
      ?>
<script>
location.replace("list.php?Questions");
</script>
<?php
    } else {
      $_SESSION['error'] = "Failed";
      $_SESSION['replace_url'] = "add.php?Questions";
      ?>
<script>
location.replace("list.php?Questions");
</script>
<?php
  
    }
}

// add subjects
if(isset($_POST['addSubject'])){
  $changeSubject = $_POST['subject'];
  $subject = str_replace("'","\'", $changeSubject);

    $sql = "INSERT INTO `subjects`(`subject`)
    VALUES ('$subject')";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      $addColumn = mysqli_query($con, "ALTER TABLE `exam` ADD $subject VARCHAR(255) NULL");
      if($addColumn){
        $_SESSION['message'] = "Success";
        ?>
<script>
location.replace("list.php?Subjects");
</script>
<?php
      }else{
        ?>
<script>
alert("Column Add Failed");
</script>
<?php
      }
    } else {
      $_SESSION['error'] = "Failed";
      $_SESSION['replace_url'] = "add.php?Subjects";
      ?>
<script>
location.replace("list.php?Subjects");
</script>
<?php
  
    }
}


// add chapters
if(isset($_POST['addChapter'])){
  $subject_id = $_POST['subject_id'];
  $changeChapter = $_POST['name'];
  $Chapter = str_replace("'","\'", $changeChapter);

    $sql = "INSERT INTO `chapter`(`subject_id`,`name`)
    VALUES ('$subject_id','$Chapter')";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      $_SESSION['message'] = "Success";
      ?>
<script>
location.replace("list.php?Chapters");
</script>
<?php
    } else {
      $_SESSION['error'] = "Failed";
      $_SESSION['replace_url'] = "add.php?Chapters";
      ?>
<script>
location.replace("list.php?Chapters");
</script>
<?php
  
    }
}

// deactivate teachers
if(isset($_POST['teacherDeactivateBtn'])){
  $id = $_POST['id'];

  $query = mysqli_query($con, "UPDATE admin SET status='1' WHERE id='$id'");
  if($query){
    ?>
<script>
location.replace("list.php?Teachers");
</script>
<?php
  }else{
    ?>
<script>
alert("Failed");
</script>
<?php
  }
}

// activate teacher
if(isset($_POST['teacherActivateBtn'])){
  $id = $_POST['id'];

  $query = mysqli_query($con, "UPDATE admin SET status='0' WHERE id='$id'");
  if($query){
    ?>
<script>
location.replace("list.php?Teachers");
</script>
<?php
  }else{
    ?>
<script>
alert("Failed");
</script>
<?php
  }
}


// update question
// Add Question
if (isset($_POST['updateQuestion'])) {
  $questionID = $_POST['questionID'];
  $exam_id = $_POST['exam_id'];
  $marks = $_POST['marks'];
  $negative_marks = $_POST['negative_marks'];
  $changeQuestion = $_POST['question'];
  $question = str_replace("'","\'", $changeQuestion);
  $changeOption_1 = $_POST['option_1'];
  $option_1 = str_replace("'","\'", $changeOption_1);
  $changeOption_2 = $_POST['option_2'];
  $option_2 = str_replace("'","\'", $changeOption_2);
  $changeOption_3 = $_POST['option_3'];
  $option_3 = str_replace("'","\'", $changeOption_3);
  $changeOption_4 = $_POST['option_4'];
  $option_4 = str_replace("'","\'", $changeOption_4);
  $changeSolution = $_POST['solution'];
  $solution = str_replace("'","\'", $changeSolution);
  $answer = $_POST['answer'];
  
    $sql = "UPDATE questions SET `exam_id`='$exam_id', `question`='$question', `option_1`='$option_1', `option_2`='$option_2', `option_3`='$option_3', `option_4`='$option_4', `answer`='$answer', `mark`='$marks', `negative_mark`='$negative_marks',`solution`='$solution' WHERE id='$questionID'";
    $query = mysqli_query($con, $sql);
  
    if ($query) {
      $_SESSION['message'] = "Success";
      ?>
<script>
location.replace("list.php?Questions");
</script>
<?php
    } else {
      $_SESSION['error'] = "Failed";
      ?>
<script>
location.replace("list.php?Questions");
</script>
<?php
  
    }
}


?>