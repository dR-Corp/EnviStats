<section class="content">
    <div class="container-fluid">

        <?php

            $indicateurs = all("indicateur");

        ?>

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
                        <h3><?= count($indicateurs) ?></h3>

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
                <!-- AREA CHART -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tendances des valeurs d'indicateurs par zones de référence d'une année à
                            l'autre</h3>

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
                            <?php foreach($indicateurs as $indicateur): ?>
                            <canvas id="areaChart<?= $indicateur['id'] ?>"
                                style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="col-md-12">

                <!-- BAR CHART -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Comapraison des données de différentes zones de référence pour un
                            indicateur spécifique</h3>

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
                            <?php foreach($indicateurs as $indicateur): ?>
                            <canvas id="barChart<?= $indicateur['id'] ?>"
                                style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="col-md-12">

                <!-- PIE CHART -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Répartition des valeurs d'indicateurs par zone de référence</h3>

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
                            style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="col-md-12">

                <!-- RADAR CHART -->
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Répartition des valeurs d'indicateurs pour plusieurs zones de référence
                        </h3>
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
                            <canvas id="radarChart"
                                style="min-height: 700px; height: 700px; max-height: 700px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>

<!-- Page specific script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/randomcolor/0.6.1/randomColor.min.js"></script>
<script>

var areaChartOptions = "";
var barChartOptions = "";
var pieOptions = "";
var radarOptions = "";

$(function() {

    $.ajax({
        type: "GET",
        url: "./Data/data.xml",
        dataType: "xml",
        success: function(xml) {

            //chart options
            areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true,
                        },
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                legend: {
                    display: true
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            };

            radarOptions = {
                scale: {
                    ticks: {
                        beginAtZero: true
                    }
                }
            };

            // Parcourir les indicateurs
            $(xml).find('indicateur').each(function() {

                // Récupérer les données de l'indicateur
                var label = $(this).parent().attr('code');
                var code = $(this).attr('code');
                var id = $(this).attr('id');

                //--------------
                //- AREA AND BAR CHART -
                //--------------
                var areaChartData = {
                    labels: ['2019', '2020', '2021'],
                    datasets: []
                };
                $(this).find('donnee').each(function() {
                    var zone = $(this).attr('zone_reference');
                    var valeurs = [];
                    $(this).find('valeurs').each(function() {
                        valeurs.push(parseInt($(this).text()));
                    });
                    var col1 = randomColor({
                        luminosity: 'dark',
                        format: 'rgba',
                        alpha: 0.2
                    });
                    var col2 = '#' + (Math.random() * 0xFFFFFF << 0).toString(16);
                    areaChartData.datasets.push({
                        label: zone,
                        data: valeurs,
                        backgroundColor: col1,
                        borderColor: col2,
                        borderWidth: 3
                    });
                });

                if (areaChartData.datasets.length > 0) {

                    var areaChartCanvas = $('#areaChart' + id).get(0).getContext('2d')
                    var barChartCanvas = $('#barChart' + id).get(0).getContext('2d')
                    areaChartOptions.title = barChartOptions.title = {
                        display: true,
                        text: 'Indicateur ' + code,
                        fontSize: 20
                    };
                    new Chart(areaChartCanvas, {
                        type: 'line',
                        data: areaChartData,
                        options: areaChartOptions
                    })

                    $.each(areaChartData.datasets, function(index, element) {
                        element.borderWidth = 0.5
                    });
                    var barChartData = $.extend(true, {}, areaChartData)
                    // var temp0 = areaChartData.datasets[0]
                    // var temp1 = areaChartData.datasets[1]
                    // barChartData.datasets[0] = temp1
                    // barChartData.datasets[1] = temp0

                    new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })

                } else {
                    $('#areaChart' + id).hide();
                    $('#barChart' + id).hide();
                }

            });

            //--------------
            //- RADAR CHART -
            //--------------
            // var labels = [];
            // var datasets = [];
            var radarData = {
                labels: [],
                datasets: []
            }

            var num = 0;
            $(xml).find('indicateur').each(function() {

                var label = $(this).attr("code");
                var data = [];

                if (!radarData.labels.includes(label)) {
                    radarData.labels.push(label);
                }

                $(this).find("donnee").each(function() {
                    var zone = $(this).attr("zone_reference");
                    var valeur = parseInt(
                        $(this).find("valeurs").filter(function() {
                            return $(this).attr("annee") == "2021";
                        }).text()
                    );
                    data.push(valeur);
                    // if (!radarData.labels.includes(zone)) {
                    //     radarData.labels.push(zone);
                    // }
                });

                radarData.datasets.push({
                    label: label,
                    data: data,
                    backgroundColor: randomColor({
                        luminosity: 'dark',
                        format: 'rgba',
                        alpha: 0.5
                    }),
                    borderColor: '#' + (Math.random() * 0xFFFFFF << 0).toString(16),
                    borderWidth: 1,
                });

            });

            console.log("THE NEW WORLD");
            console.log(radarData);

            var radarChartCanvas = $('#radarChart').get(0).getContext('2d')
            new Chart(radarChartCanvas, {
                type: 'radar',
                data: radarData,
                options: radarOptions
            })

        }
    });


    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: ['2019', '2020', '2021'],
        datasets: [{
            label: 'Température moyenne mensuelle',
            data: [12, 13, 15],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12'],
            borderWidth: 1
        }]
    }

    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

    var radarChartCanvas = $('#radarChart').get(0).getContext('2d')
    var radarData = {
        labels: ['Température moyenne mensuelle', 'Température moyenne minimale',
            'Température moyenne mensuelle maximale'
        ],
        datasets: [
            {
                label: 'Banikanni',
                data: [12, 22, 9],
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Zongo',
                data: [4, 19, 42],
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Wore',
                data: [14, 20, 35],
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }, {
                label: 'Guema',
                data: [41, 12, 28],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    }


})
</script>