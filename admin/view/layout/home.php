<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Header Section -->
            <section class="header-section mb-3 pb-1">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
                                <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <div class="input-group">
                                                <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-soft-success"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-soft-info btn-icon"><i class="ri-pulse-line"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                        <p class="text-uppercase fw-medium text-muted mb-0">Total Earnings</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">+16.24 %</h5>
                                    </div>
                                </div>
                                <h4 class="fs-22 fw-semibold ff-secondary my-3"><span class="counter-value" data-target="<?= $sumStatusSucces ?>">0</span>VND</h4>
                                <a href="#" class="text-decoration-underline">View net earnings</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <p class="text-uppercase fw-medium text-muted mb-0">Order today</p>
                                <h5 class="text-danger fs-14 mb-0">-3.57 %</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary my-3"><span class="counter-value" data-target="<?= $orderToday ?>">0</span></h4>
                                <a href="#" class="text-decoration-underline">View all orders</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <p class="text-uppercase fw-medium text-muted mb-0">Customers</p>
                                <h5 class="text-success fs-14 mb-0">+29.08 %</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary my-3"><span class="counter-value" data-target="183.35">0</span>M</h4>
                                <a href="#" class="text-decoration-underline">See details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <p class="text-uppercase fw-medium text-muted mb-0">My Balance</p>
                                <h5 class="text-muted fs-14 mb-0">+0.00 %</h5>
                                <h4 class="fs-22 fw-semibold ff-secondary my-3">$<span class="counter-value" data-target="165.89">0</span>k</h4>
                                <a href="#" class="text-decoration-underline">Withdraw money</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script
                    src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
                </script>
                <div class="col-12 d-">
                    <div class="col-6"><canvas id="myChart" style="width:100%;max-width:600px"></canvas></div>
                    <div class="col-6"><canvas id="myChart1" style="width:100%;max-width:600px"></canvas></div>
                </div>
                
                
                <script>
                    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
                    var yValues = [55, 49, 44, 24, 15];
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
                                text: "World Wine Production 2018"
                            }
                        }
                    });
                </script>


            </section>
            

            <script>
                var stmt = <?=json_encode($data['cancelled'])?>;
                var xValues = ["Italy", "France"];
                var yValues = [<?=$data['cancelled']?>,<?=$data['success']?>];
                var barColors = [
                    "#b91d47",
                    "#00aba9",
                    "#2b5797",
                    "#e8c3b9",
                    "#1e7145"
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
                            text: "World Wide Wine Production 2018"
                        }
                    }
                });
            </script>
            <script>
                console.log(stmt);
            </script>
        </div>
    </div>
</div>