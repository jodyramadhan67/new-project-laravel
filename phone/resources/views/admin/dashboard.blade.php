@extends('layouts.admin')
@section('header', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_watch }}</h3>
                    <p>Total Watches</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('watches.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $total_member }}</h3>
                    <p>Total Members</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('members.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_laptop }}</h3>
                    <p>Total Laptop</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('laptops.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">

<div class="small-box bg-danger">
    <div class="inner">
        <h3>{{ $total_transaction }}</h3>
        <p>Total Transaction</p>
    </div>
    <div class="icon">
        <i class="ion ion-donut-graph"></i>
    </div>
    <a href="{{ route('transactions.index') }}" class="small-box-footer">More info <i
            class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

</div>

    <div class="row">

        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Laptop Graph</h3>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="donutChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Transaction Graph</h3>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="barChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tablet Graph</h3>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="pieChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>

    <script type="text/javascript">
        const data_donut = '{!! json_encode($data_donut) !!}'
        const label_donut = '{!! json_encode($label_donut) !!}'
        const dataBar = '{!! json_encode($dataBar) !!}'
        $(() => {
            const donutChartCanvas = $('#donutChart').get(0).getContext('2d');
            const donutData = {
                labels: JSON.parse(label_donut),
                datasets: [{
                    data: JSON.parse(data_donut),
                    backgroundColor: ['red', 'blue', 'red', 'blue', 'red', 'blue', 'red', 'blue', 'red',
                        'blue', 'red', 'blue', 'red', 'blue'
                    ]
                }]
            }
            const donutOptions = {
                maintainAspectRatio: false,
                responsive: true
            }
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                option: donutOptions
            })
            // End Donut Chart
            // Start Bar Chart
            const areaChartData = {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: JSON.parse(dataBar)
            }
            const barChartCanvas = $('#barChart').get(0).getContext('2d')
            const barChartData = areaChartData
            // const temp0 = areaChartData.datasets[0]
            // const temp1 = areaChartData.datasets[1]
            // barChartData.datasets[0] = temp1
            // barChartData.datasets[1] = temp0
            const barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }
            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                option: barChartOptions
            })
        })
        // End Bar Chart
        // Start Pie Chart
        const pieChart = $('#pieChart').get(0).getContext('2d')
        const pieData = {
            labels: JSON.parse('{!! json_encode($labelPie) !!}'),
            datasets: [{
                data: JSON.parse('{!! json_encode($dataPie) !!}'),
                backgroundColor: ['red', 'blue', 'red', 'blue', 'red', 'blue', 'red', 'blue', 'red', 'blue',
                    'red', 'blue', 'red', 'blue'
                ]
            }]
        }
        const pieChartOptions = {
            responsive: true,
            maintainAspectRatio: false
        }
        new Chart(pieChart, {
            type: 'pie',
            data: pieData,
            option: pieChartOptions
        })
    </script>
@endsection