@extends('menu')

@section('body')
    <div class="col-6">
        <canvas id="dailyChart" width="400" height="400"></canvas>
    </div>
    <div class="col-6">
        <canvas id="postChart" width="400" height="400"></canvas>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">History Posts</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Text</th>
                        <th>Date</th>、
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{$post->text}}</td>
                            <td>{{$post->posted_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
@endsection