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
  table {
    width: 100%;
  }

  .t-row,
  .thead {
    display: flex;
    justify-content: space-around;
    padding: 20px 5px;
    color: black;
    /* border: 1px solid #6f6afc;; */
    margin: 10px;
    max-width: 100%;
    box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1);

  }

  .t-row:hover {
    background-color: #6f6afc42;

  }

  .search-box {
    width: 100%;
    padding: 10px 25px;
    border-radius: 5px;
    border: 1px solid #444;
  }

  .t-row td:nth-child(1),
  .thead th:nth-child(1) {
    max-width: 20%;
    text-align: center;
  }

  .t-row td:nth-child(2),
  .thead th:nth-child(2) {
    max-width: 25%;
    text-align: center;
  }

  .t-row td:nth-child(3),
  .thead th:nth-child(3) {
    max-width: 30%;
    text-align: center;
  }

  .t-row td:nth-child(4),
  .thead th:nth-child(4) {
    max-width: 25%;
    text-align: center;
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

    <?php
    if(isset($_GET['Leader-Board'])){
      $no =1;
      $LeaderBoardExamId = $_GET['Leader-Board'];
      $select = mysqli_query($con, "SELECT * FROM leaderboard WHERE exam_id='$LeaderBoardExamId' ORDER BY result DESC");

      // select exam name
      $selectExamName = mysqli_query($con, "SELECT * FROM exam WHERE exam_id='$LeaderBoardExamId'");
      if(mysqli_num_rows($selectExamName) > 0){
        $NameOfExam = mysqli_fetch_array($selectExamName)['exam_name'];
      }else{
        $NameOfExam = "";
    }


      ?>
    <div class="container-fluid">
      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <div class="welcome-text">
            <h4><?=$NameOfExam?></h4>
          </div>
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Leaderboard</a></li>
          </ol>
        </div>
      </div>
      <!-- row -->




      <!-- search-box  -->
      <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
          <input type="text" class="search-box" id="myInput" onkeyup="myFunction()" placeholder="Search for names.."
            title="Type in a name">
        </div>

      </div>



      <div class="row">
        <div class="col-xl-12 col-xxl-12">
          <div class="card">
            <div class="card-body">
              <?php
        if(mysqli_num_rows($select) > 0){
        ?>
              <table id="myTable">
                <tr class="thead">
                  <th>Rank</th>
                  <th>Name</th>
                  <th>Institution</th>
                  <th>Marks</th>
                </tr>
                <?php
      while($row=mysqli_fetch_array($select)){
        $student_id = $row['student_id'];
        $searchStudentInfo = mysqli_query($con, "SELECT * FROM students WHERE student_id='$student_id'");
        if(mysqli_num_rows($searchStudentInfo) > 0){
          $studentRow = mysqli_fetch_array($searchStudentInfo);
          $studentFullName = $studentRow['full_name'];
          $studentCollege = $studentRow['college'];
        }
        ?>
                <tr class="t-row">
                  <td><?=$no?></td>
                  <td><?=$studentFullName?></td>
                  <td><?=$studentCollege?></td>
                  <td><?=$row['result']?></td>
                </tr>
                <?php
      $no++;
      }
      ?>
              </table>
            </div>
          </div>
        </div>
      </div>
      </tbody>
      </table>
      <?php
      }else{
        echo "<p class='alert alert-danger'>No data found!</p>";
      }
      ?>
    </div>
  </div>
  </div>
  </div>

  </div>
  <?php
}
    ?>
  </div>
  <!--**********************************
            Content body end
        ***********************************-->
  <script>
  function myFunction() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[1];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>



  <!--  Footer ---->
  <?php include "includes/footer.php"; ?>
  <?php include './includes/code.php';?>

</body>

</html>