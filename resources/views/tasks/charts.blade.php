@extends('layouts.app')

@section('content')
    <div class="container col-md-4">
        <canvas id="pieChart" width="300" height="300"></canvas>
        <div id="pie-data" data-todo="{{ $toDoCount }}" data-done="{{ $doneCount }}"data-total="{{ $total }}"></div>
    </div>

    <div class="container col-md-4">
        <canvas id="barChart" width="300" height="300"></canvas>
        <div id="bar-data"
        data-names={!! json_encode($names, JSON_UNESCAPED_UNICODE) !!}
        data-counts={!! json_encode(TasksCountArray($projects)) !!}
        ></div>
    </div>

    <div class="container col-md-4">
        <canvas id="radarChart" width="300" height="300"></canvas>
    </div>


@endsection

@section('customJS')
    <script src="{{ asset('js/charts.js') }}"></script>

    <script>
        var ctxRadar = $('#radarChart');
        var data = {
            labels: ["任务总数", "未完成的", "完成的"],
            datasets: [
                <?php
                    $i = 0;
                    foreach($projects as $project) :
                        $name = $project->name;
                        $totalPP = $project->tasks()->count();
                        $toDoPP = $project->tasks()->where('completed', 0)->count();
                        $donePP = $project->tasks()->where('completed', 1)->count();
                        echo '{'; //此处括号是datasets数据模板里的，也需要遍历一下
                ?>
                
                    label: "<?php echo $name ?>",
                    backgroundColor: "{{ rand_color() }}",
                    borderColor: "{{ rand_color() }}",
                    pointBackgroundColor: "{{ rand_color() }}",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#fff",
                    data: [ <?php echo $totalPP . ',' . $toDoPP . ',' . $donePP ?> ]
                
                <?php
                    ($i+1) == $project->count() ? print '}' : print '},';
                    $i++;
                    endforeach;
                ?>
            ]
        };
        var myRadarChart = new Chart(ctxRadar, {
            type: 'radar',
            data: data
        });
    </script>  
@endsection