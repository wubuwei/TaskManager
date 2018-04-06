@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <canvas id="pieChart" width="300" height="300"></canvas>
    </div>
    <div class="container col-md-4">
        <canvas id="barChart" width="300" height="300"></canvas>
    </div>




@endsection

@section('customJS')
    <script src="{{ asset('js/Chart.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            var ctxPie = $('#pieChart');
            // For a pie chart
            //要使用data,需要在前面先定义
            var data = {
                labels: [
                    "未完成",
                    "已完成"
                ],
                datasets: [
                    {
                        data: [{{ $toDoCount }}, {{ $doneCount }}],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB"
                        ],
                        hoverBackgroundColor: [
                            "#FF6384",
                            "#36A2EB"                       
                        ]
                    }]
            };

            var myPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: data,
                options: {
                    responsive:true,
                    title: {
                        display: true,
                        text: '所有任务的完成比例(总数：{{ $total }})'
                    }
                }
            });

            //bar chart
            var ctxBar = $('#barChart');
            var dataBar = {
                //{!! json_encode($names, JSON_UNESCAPED_UNICODE) !!}
                //有的电脑中文会报错，上面是解决方式
                //labels后面跟的是数组，$names就是数组，不用再考虑加[]
                labels: {!! $names !!},
                datasets: [
                    {
                        label: "My First dataset",
                        backgroundColor: [
                            'rgba(255,92,132,0.2)',
                            'rgba(54,162,235,0.2)',
                            'rgba(255,206,86,0.2)',
                            'rgba(75,192,192,0.2)',
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54,162,235,1)',
                            'rgba(255,206,86,1)',
                            'rgba(75,192,192,1)',
                        ],
                        borderColor: 1,
                        data: [65,59,80,81,56],
                    }
                ]
            };
            var myBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: dataBar
            });
        });
    </script>
@endsection