<?php

function TasksCountArray($projects)
{
    $counts = [];
    //$projects传过来的是一个集合
    //$project是foreach遍历出来的集合的值,每一个都是Project的实例
    //$project->tasks()通过模型关系查出所有的该项目下的task，然后 count() 方法统计数量
    foreach ($projects as $project) {
        $perCount = $project->tasks->count();
        array_push($counts, $perCount);
    }
    
    return $counts;
}

function rand_color()
{
    $R = rand(0,255);
    $G = rand(0,255);
    $B = rand(0,255);

    return 'rgba(' . $R . ',' . $G . ',' . $B . ',0.5)';
}