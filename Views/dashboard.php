<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php
                // echo '<pre>';
                // print_r(all("categorie"));
                // exit;
            ?>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3><?= count(all("categorie")) ?></h3>

                        <p class="font-weight-bold">Catégories</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th"></i>
                    </div>
                    <a class="small-box-footer bg-info"></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3><?= count(all("scategorie")) ?></h3>

                        <p class="font-weight-bold">Sous catégories</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-code-branch"></i>
                    </div>
                    <a class="small-box-footer bg-info"></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3><?= count(all("indicateur")) ?></h3>

                        <p class="font-weight-bold">Indicateurs</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a class="small-box-footer bg-info"></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-white">
                    <div class="inner">
                        <h3><?= count(all("collecte")) ?></h3>

                        <p class="font-weight-bold">Données collectées</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <a class="small-box-footer bg-info"></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-md-12">
            <canvas id="myChart"></canvas>
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['2019', '2020', '2021'],
                        datasets: [
                            {
                                label: 'Banikanni',
                                data: [12, 13, 15],
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Zongo',
                                data: [40, 20, 19],
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            },
                            {
                                label: 'Wore',
                                data: [10, 14, 9],
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            </script>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Recap Report</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Goal Completion</strong>
                                </p>

                                <div class="progress-group">
                                    Add Products to Cart
                                    <span class="float-right"><b>160</b>/200</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->

                                <div class="progress-group">
                                    Complete Purchase
                                    <span class="float-right"><b>310</b>/400</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Visit Premium Page</span>
                                    <span class="float-right"><b>480</b>/800</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" style="width: 60%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    Send Inquiries
                                    <span class="float-right"><b>250</b>/500</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                        17%</span>
                                    <h5 class="description-header">$35,210.43</h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i>
                                        0%</span>
                                    <h5 class="description-header">$10,390.90</h5>
                                    <span class="description-text">TOTAL COST</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block border-right">
                                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i>
                                        20%</span>
                                    <h5 class="description-header">$24,813.53</h5>
                                    <span class="description-text">TOTAL PROFIT</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-6">
                                <div class="description-block">
                                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i>
                                        18%</span>
                                    <h5 class="description-header">1200</h5>
                                    <span class="description-text">GOAL COMPLETIONS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Online Store Visitors</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">820</span>
                                <span>Visitors Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 12.5%
                                </span>
                                <span class="text-muted">Since last week</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="visitors-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This Week
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last Week
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Sales</h3>
                            <a href="javascript:void(0);">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">$18,230.00</span>
                                <span>Sales Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> 33.1%
                                </span>
                                <span class="text-muted">Since last month</span>
                            </p>
                        </div>
                        <!-- /.d-flex -->

                        <div class="position-relative mb-4">
                            <canvas id="sales-chart" height="200"></canvas>
                        </div>

                        <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                                <i class="fas fa-square text-primary"></i> This year
                            </span>

                            <span>
                                <i class="fas fa-square text-gray"></i> Last year
                            </span>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="areaChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- DONUT CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Pie Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (LEFT) -->
            <div class="col-md-6">
                <!-- LINE CHART -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- STACKED BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>

<!-- Page specific script -->
<script>
	$(function() {
		/* ChartJS
		* -------
		* Here we will create a few charts using ChartJS
		*/

		//--------------
		//- AREA CHART -
		//--------------

		// Get context with jQuery - using jQuery's .get() method.
		var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

		var areaChartData = {
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
					label: 'Digital Goods',
					backgroundColor: 'rgba(60,141,188,0.9)',
					borderColor: 'rgba(60,141,188,0.8)',
					pointRadius: false,
					pointColor: '#3b8bba',
					pointStrokeColor: 'rgba(60,141,188,1)',
					pointHighlightFill: '#fff',
					pointHighlightStroke: 'rgba(60,141,188,1)',
					data: [28, 48, 40, 19, 86, 27, 90]
				},
				{
					label: 'Electronics',
					backgroundColor: 'rgba(210, 214, 222, 1)',
					borderColor: 'rgba(210, 214, 222, 1)',
					pointRadius: false,
					pointColor: 'rgba(210, 214, 222, 1)',
					pointStrokeColor: '#c1c7d1',
					pointHighlightFill: '#fff',
					pointHighlightStroke: 'rgba(220,220,220,1)',
					data: [65, 59, 80, 81, 56, 55, 40]
				},
			]
		}

		var areaChartOptions = {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false
			},
			scales: {
				xAxes: [{
					gridLines: {
						display: false,
					}
				}],
				yAxes: [{
					gridLines: {
						display: false,
					}
				}]
			}
		}

		// This will get the first returned node in the jQuery collection.
		new Chart(areaChartCanvas, {
			type: 'line',
			data: areaChartData,
			options: areaChartOptions
		})

		//-------------
		//- LINE CHART -
		//--------------
		var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
		var lineChartOptions = $.extend(true, {}, areaChartOptions)
		var lineChartData = $.extend(true, {}, areaChartData)
		lineChartData.datasets[0].fill = false;
		lineChartData.datasets[1].fill = false;
		lineChartOptions.datasetFill = false

		var lineChart = new Chart(lineChartCanvas, {
			type: 'line',
			data: lineChartData,
			options: lineChartOptions
		})

		//-------------
		//- DONUT CHART -
		//-------------
		// Get context with jQuery - using jQuery's .get() method.
		var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
		var donutData = {
			labels: [
				'Chrome',
				'IE',
				'FireFox',
				'Safari',
				'Opera',
				'Navigator',
			],
			datasets: [{
				data: [700, 500, 400, 600, 300, 100],
				backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
			}]
		}
		var donutOptions = {
			maintainAspectRatio: false,
			responsive: true,
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		new Chart(donutChartCanvas, {
			type: 'doughnut',
			data: donutData,
			options: donutOptions
		})

		//-------------
		//- PIE CHART -
		//-------------
		// Get context with jQuery - using jQuery's .get() method.
		var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
		var pieData = donutData;
		var pieOptions = {
			maintainAspectRatio: false,
			responsive: true,
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		new Chart(pieChartCanvas, {
			type: 'pie',
			data: pieData,
			options: pieOptions
		})

		//-------------
		//- BAR CHART -
		//-------------
		var barChartCanvas = $('#barChart').get(0).getContext('2d')
		var barChartData = $.extend(true, {}, areaChartData)
		var temp0 = areaChartData.datasets[0]
		var temp1 = areaChartData.datasets[1]
		barChartData.datasets[0] = temp1
		barChartData.datasets[1] = temp0

		var barChartOptions = {
			responsive: true,
			maintainAspectRatio: false,
			datasetFill: false
		}

		new Chart(barChartCanvas, {
			type: 'bar',
			data: barChartData,
			options: barChartOptions
		})

		//---------------------
		//- STACKED BAR CHART -
		//---------------------
		var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
		var stackedBarChartData = $.extend(true, {}, barChartData)

		var stackedBarChartOptions = {
			responsive: true,
			maintainAspectRatio: false,
			scales: {
				xAxes: [{
					stacked: true,
				}],
				yAxes: [{
					stacked: true
				}]
			}
		}

		new Chart(stackedBarChartCanvas, {
			type: 'bar',
			data: stackedBarChartData,
			options: stackedBarChartOptions
		})
	})
</script>

<script src="<?= ASSETS ?>dist/js/pages/dashboard.js"></script>
<script src="<?= ASSETS ?>dist/js/pages/dashboard2.js"></script>
<script src="<?= ASSETS ?>dist/js/pages/dashboard3.js"></script>