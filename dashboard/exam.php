<?php include "includes/header.php"; ?>

<!-- 
    - #HEADER
  -->

<!-- 
        - #DEPARTMENTS
      -->



<!-- Exam page CSS --->
<link rel="stylesheet" href="../assets/css/exam-page.css">

<!--=============== FONT AWESOME ===============-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

<div class="content-body">
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <span class="ml-1">Element</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Form</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Element</a></li>
                </ol>
            </div>
        </div>

        <div class="timer">
            <span class="badge badge-rounded badge-danger">Time left 1:30:23</span>
        </div>



        <div class="exam-ques">

            <form action="">
                <?php
                $total_qus = 5;
                for ($i = 1; $i <= $total_qus; $i++) {
                    ?>

                    <div class="quiz-container mt-3" id="quiz<?= $i ?>">
                        <h2 id="question<?= $i ?>">
                            <?= $i ?> Question
                        </h2>
                        <div class="loading-bar">
                            <div class="loading-bar-progress" id="loading-bar-progress"></div>
                        </div>
                        <ul>
                            <li>
                                <input type="radio" name="answer" id="a<?= $i ?>" class="answer">
                                <label for="a<?= $i ?>" id="a_text">Answer</label>
                            </li>
                            <li>
                                <input type="radio" name="answer" id="b<?= $i ?>" class="answer">
                                <label for="b<?= $i ?>" id="b_text">Answer</label>
                            </li>
                            <li>
                                <input type="radio" name="answer" id="c<?= $i ?>" class="answer">
                                <label for="c<?= $i ?>" id="c_text">Answer</label>
                            </li>
                            <li>
                                <input type="radio" name="answer" id="d<?= $i ?>" class="answer">
                                <label for="d<?= $i ?>" id="d_text">Answer</label>
                            </li>
                        </ul>
                    </div>

                <?php } ?>
                <center>
                    <button class="btn btn-primary my-3">Submit</button>
                </center>
            </form>
        </div>

    </div>
</div>



        <!--  Footer ---->
        <?php include "includes/footer.php"; ?>