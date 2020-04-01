@extends('layouts.admin')

@section('title', 'Сводка')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-premium-dark">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Общая прибыль</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-warning"><span>{{\App\UserTransaction::getSumInPeriod(0, 1945346334)}}₽</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-arielle-smile">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Прибыль за период</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$sumInPeriod}}₽</span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-night-fade">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Ключей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span>{{$totalKeys}}</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card mb-3 widget-content bg-happy-green">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Пользователей</div>

                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers"><span>{{$totalUsers}}</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-2 col-sm-6">
            от: <input type="text" id="datepicker-from">

        </div>
        <div class="col-md-2 col-sm-6">
            до: <input type="text" id="datepicker-to">
        </div>
        <div class="col-md-2">
            <button type="button" id="summary-date-filter" class="btn btn-info ">поиск</button>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">

                        <div class="widget-chart p-3">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-md-12 col-lg-6">
            <div class="mb-3 card">
                <div class=" card-header">
                    <div class="card-header-title">
                        <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
                        ТОП ПОЛЬЗОВАТЕЛИ
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab-eg-55">

                        <div class="widget-chart p-3">
                            <div class="scroll-area-sm">
                                <div class="scrollbar-container">
                                    <ul class="rm-list-borders rm-list-borders-scroll list-group list-group-flush">
                                        @foreach($topUsers as $topUser)
                                            <li class="list-group-item">
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <img width="42" class="rounded-circle"
                                                                 src="/uploads/{{$topUser->avatar}}" alt="">

                                                        </div>
                                                        <div class="widget-content-left">
                                                            <div
                                                                class="widget-heading">{{$topUser->name}} {{$topUser->surname}}</div>
                                                            <div class="widget-subheading">{{$topUser->email}}</div>
                                                        </div>
                                                        <div class="widget-content-right">
                                                            <div class="font-size-xlg text-muted">
                                                                <small class="opacity-5 pr-1">₽</small>
                                                                <span>{{$topUser->tsum}}</span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="/js/dp-ru.js"></script>
    <script src="/js/summary/index.js"></script>
    <script src="/chartjs/js/Chart.js"></script>
    <link rel="stylesheet" href="/chartjs/css/Chart.css">
    <?php
    $labels = '';
    $data = '';
    foreach ($sumInDays as $day => $sum) {
            $labels .= "'" . $day . "',";
            $data .= $sum . ",";
    }
    ?>
    <script>
        let ctx = document.getElementById('myChart');
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $labels;?>],
                datasets: [{
                    label: '# график функции',
                    data: [<?php echo $data; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
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
@endsection
