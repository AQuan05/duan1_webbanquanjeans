<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Header Section -->
            <section class="header-section mb-3 pb-1">
                <div class="row">

                </div>
            </section>

            <!-- Statistics Section -->
            <section class="statistics-section">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted mb-0">total order complete</p>
                                    </div>
                                    <!-- <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">+16.24 %</h5>
                                    </div> -->
                                </div>
                                <h4 class="fs-22 fw-semibold ff-secondary my-3"><span class="counter-value" data-target="<?= $sumStatusSucces ?>">0</span>VND</h4>
                                <!-- <a href="#" class="text-decoration-underline">View net earnings</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <p class="text-uppercase fw-medium text-muted mb-0">Order today</p>
                                <!-- <h5 class="text-danger fs-14 mb-0">-3.57 %</h5> -->
                                <h4 class="fs-22 fw-semibold ff-secondary my-3"><span class="counter-value" data-target="<?= $orderToday ?>">0</span></h4>
                                <!-- <a href="#" class="text-decoration-underline">View all orders</a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                extract($data);

                ?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                <div class="col-12 d-flex">
                    <div class="col-6"><canvas id="myChart" style="width:100%;max-width:600px"></canvas></div>
                    <div class="col-6"><canvas id="myChart1" style="width:100%;max-width:450px"></canvas></div>
                </div>



                <script>
                    var xValues = <?php echo $dates; ?>;
                    var yValues = <?php echo $revenues; ?>;
                    var barColors = ["red", "green", "blue", "orange", "brown"];

                    new Chart("myChart", {
                        type: "bar",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },
                        options: {
                            legend: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Daily revenues",
                            }
                        }
                    });
                </script>

                <script>
                    var xValues = ["Cancelled", "Sucessful"];
                    var yValues = [<?= $canceled; ?>, <?= $successful; ?>];
                    var barColors = [
                        "#b91d47",
                        "#00aba9"
                    ];

                    new Chart("myChart1", {
                        type: "pie",
                        data: {
                            labels: xValues,
                            datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "Oredr cancellation rate"
                            }
                        }
                    });
                </script>


            </section>

        </div>
    </div>
</div>