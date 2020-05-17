<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Publish Center</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        Facebook Data - {{$username}}
        <div class="title m-b-md">
        </div>


        <div class="links">
{{--            <a href="https://laravel.com/docs">Docs</a>--}}
{{--            <a href="https://laracasts.com">Laracasts</a>--}}
{{--            <a href="https://laravel-news.com">News</a>--}}
{{--            <a href="https://blog.laravel.com">Blog</a>--}}
{{--            <a href="https://nova.laravel.com">Nova</a>--}}
{{--            <a href="https://forge.laravel.com">Forge</a>--}}
{{--            <a href="https://vapor.laravel.com">Vapor</a>--}}
{{--            <a href="https://github.com/laravel/laravel">GitHub</a>--}}
        </div>
    </div>
    <div>
        <canvas id="dailyChart" width="400" height="400"></canvas>
    </div>
    <div>
        <canvas id="postChart" width="400" height="400"></canvas>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
    var index = 0;
    var colors = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
    ];
    var dailyChart = document.getElementById('dailyChart');
    var dailyColumn = [];
    var todayData =[];
    var yesterdayData =[];
    var dailyColors =[];

    @foreach($data->daily as $key => $value)
        dailyColumn.push('{{$key}}');
        todayData.push('{{$value}}');
        dailyColors.push(colors[index++]);
    @endforeach
    @foreach($data->yesterday as $key => $value)
        yesterdayData.push('{{$value}}');
    @endforeach
    new Chart(dailyChart, {
        type: 'bar',
        data: {
            labels: dailyColumn,
            datasets: [{
                label: 'Today',
                data: todayData,
                backgroundColor: dailyColors
            }, {
                label: 'Yesterday',
                data: yesterdayData
            }],
            borderWidth: 1
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


    var postChart = document.getElementById('postChart');
    commnetData = {
        datasets: [{
            data: todayData,
            backgroundColor: dailyColors
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: dailyColumn
    };
    new Chart(postChart, {
        data: commnetData,
        type: 'pie'
    });
</script>
</html>
