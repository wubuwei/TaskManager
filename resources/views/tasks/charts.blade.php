@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <canvas id="pieChart" width="300" height="300"></canvas>
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
                    "Red",
                    "Blue",
                    "Yellow"
                ],
                datasets: [
                    {
                        data: [300, 50, 100],
                        backgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"
                        ],
                        hoverBackgroundColor: [
                            "#FF6384",
                            "#36A2EB",
                            "#FFCE56"                            
                        ]
                    }]
            };

            var myPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: data
            });
        });
    </script>
@endsection