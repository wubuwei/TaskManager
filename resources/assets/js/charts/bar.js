//bar chart
var ctxBar = $('#barChart');
var dataBar = {
    //{!! json_encode($names, JSON_UNESCAPED_UNICODE) !!}
    //有的电脑中文会报错，上面是解决方式
    //labels后面跟的是数组，$names就是数组，不用再考虑加[]
    labels: $('#bar-data').data('names'),
    datasets: [
        {
            backgroundColor: [
                'rgba(255,92,132,0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderColor: 1,
            //data: [65,59,80,81,56],
            //TasksCountArray方法返回的键值对数组，需要的格式是上面那种，所以json_encode
            data: $('#bar-data').data('counts'),
        }
    ]
};
var myBarChart = new Chart(ctxBar, {
    type: 'bar',
    data: dataBar,
    options: {
        responsive:true,
        title: {
            display: true,
            text: '项目之间的任务总数对比'
        },
        legend: {
            display: false
        }
    }
});