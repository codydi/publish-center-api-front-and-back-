<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Facebook Data</title>

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
    <form method="post">
        @csrf
        <div class="content">
            <a href="{{url('/')}}">主页</a>
            <div class="title m-b-md">
                今日数据
                <br>
            </div>
            <label for="daily-read">今日浏览</label>
            <input id="daily-read" name="daily-read" type="number">
            <label for="daily-comment">今日评论</label>
            <input id="daily-comment" name="daily-comment" type="number">
            <label for="daily-fans">今日粉丝</label>
            <input id="daily-fans" name="daily-fans" type="number">
            <label for="daily-shar  e">今日转发</label>
            <input id="daily-share" name="daily-share" type="number">
            <label for="daily-like">今日点赞</label>
            <input id="daily-like" name="daily-like" type="number">
            <div class="title m-b-md">
                昨日数据
                <br>
            </div>
            <label for="yesterday-read">昨日浏览</label>
            <input id="yesterday-read" name="yesterday-read" type="number">
            <label for="yesterday-comment">昨日评论</label>
            <input id="yesterday-comment" name="yesterday-comment" type="number">
            <label for="yesterday-fans">昨日粉丝</label>
            <input id="yesterday-fans" name="yesterday-fans" type="number">
            <label for="yesterday-share">昨日转发</label>
            <input id="yesterday-share" name="yesterday-share" type="number">
            <label for="yesterday-like">昨日点赞</label>
            <input id="yesterday-like" name="yesterday-like" type="number">
            <button>保存</button>
        </div>
    </form>
</div>
</body>
<script>
    @foreach($data as $type)
        @foreach($type as $key => $value)
            document.getElementById('{{$key}}').value = '{{$value}}';
        @endforeach
    @endforeach
</script>
</html>
