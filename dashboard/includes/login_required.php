<?php
session_start();
session_regenerate_id();
if(!isset($_SESSION['student_id'])){
?>
<script>
location.replace("login.php?login");
</script>
<?php
}

?>

<?php
$student_id = $_SESSION['student_id'];
$selectStudent = mysqli_query($con,"SELECT * FROM students WHERE student_id='$student_id'");
if(mysqli_num_rows($selectStudent) > 0){
  $studentRow = mysqli_fetch_array($selectStudent);
  $studentUserName = $studentRow['username'];
  $studentFullName = $studentRow['full_name'];
  $studentEmail = $studentRow['email'];
  $studentMobile = $studentRow['mobile'];
  $studentInstitute = $studentRow['college'];
  $studentHsc = $studentRow['hsc'];
}else{
  $studentUserName = "Not Added";
  $studentFullName = "Not Added";
}
?>