<?php include("includes/header.php"); ?>

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
                                    <div class="stat-text">Today Marks </div>
                                    <div class="stat-digit">20</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-success w-85" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Correct Answer</div>
                                    <div class="stat-digit">19</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-primary w-75" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Wrong Answer</div>
                                    <div class="stat-digit">5</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning w-50" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card">
                            <div class="stat-widget-two card-body">
                                <div class="stat-content">
                                    <div class="stat-text">Not Answered</div>
                                    <div class="stat-digit">6</div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger w-65" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
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
                         
                        </div>
                    </div>
                </div>

               
                

            </div>
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
        (function($) {
    "use strict"

    
    Morris.Donut({
        element: 'morris_donught',
        data: [{
            label: "\xa0 \xa0 Total marks \xa0 \xa0",
            value: 12,

        }, {
            label: "\xa0 \xa0 Wrong Answer \xa0 \xa0",
            value: 30
        }, {
            label: "\xa0 \xa0 Not Answered \xa0 \xa0",
            value: 20
        }],
        resize: true,
        colors: ['#75B432', 'rgb(192, 10, 39)', '#4400eb']
    });
    

    



})(jQuery);
    </script>