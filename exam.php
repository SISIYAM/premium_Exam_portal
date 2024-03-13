<!DOCTYPE html>
<html lang="en">

<?php include "includes/head.php"; ?>

<body id="top">

    <!-- 
    - #HEADER
  -->

    <?php include "includes/header.php"; ?>

    <!-- 
        - #DEPARTMENTS
      -->

    <section class="departments">
        <div class="container">
            <div class="departments-card mt-4">

                <a href="#" class="card-banner">

                </a>

                <a href="#">
                    <h3 class="h3 card-title">Live Exam-1</h3>
                </a>

                <p class="card-text">
                    <span class="badge badge-pill badge-dark">Physics</span>
                    <span class="badge badge-pill badge-dark">Math</span>
                    <span class="badge badge-pill badge-dark">Chemistry</span>
                    <span class="badge badge-pill badge-success">total: 30 marks</span>
                    <span class="badge badge-pill badge-warning">30 minutes</span>
                    <span class="badge badge-pill badge-danger">Negative marking</span>
                </p>

                

            </div>
            <span class="badge badge-pill badge-danger timer">Time left 1:30:39</span>

        </div>
    </section>
   
   <!-- Exam page CSS --->
    <link rel="stylesheet" href="assets/css/exam-page.css">

    <!--=============== FONT AWESOME ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

    

    <div class="exam-ques">
        
        <form action="">
        <?php 
                    $total_qus = 5;
                    for ($i = 1; $i <= $total_qus; $i++){
        ?>
        
            <div class="quiz-container mt-3" id="quiz<?=$i?>">
                <h2 id="question<?=$i?>"><?= $i ?> Question</h2>
                <div class="loading-bar">
                    <div class="loading-bar-progress" id="loading-bar-progress"></div>
                </div>
                <ul>
                    <li>
                        <input type="radio" name="answer" id="a<?=$i ?>" class="answer">
                        <label for="a<?=$i ?>" id="a_text">Answer</label>
                    </li>
                    <li>
                        <input type="radio" name="answer" id="b<?=$i ?>" class="answer">
                        <label for="b<?=$i ?>" id="b_text">Answer</label>
                    </li>
                    <li>
                        <input type="radio" name="answer" id="c<?=$i ?>" class="answer">
                        <label for="c<?=$i ?>" id="c_text">Answer</label>
                    </li>
                    <li>
                        <input type="radio" name="answer" id="d<?=$i ?>" class="answer">
                        <label for="d<?=$i ?>" id="d_text">Answer</label>
                    </li>
                </ul>
            </div>

            <?php } ?>
           <center>
            <button class="btn btn-primary my-3">Submit</button>
           </center> 
        </form>
    </div>
    
    



    <!--  Footer ---->
    <?php include "includes/footer.php"; ?>