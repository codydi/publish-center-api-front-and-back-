@extends('menu')

@section('body')
    <div class="col-lg-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <strong>Normal</strong> Form
                </div>
                <div class="card-body card-block">
                    <div class="form-group"><label class=" form-control-label">Api Key</label><input type="email" value="{{env('FB_APP_ID')}}" class="form-control" disabled></div>
                    <div class="form-group"><label class=" form-control-label">Api SECRET</label><input type="email" value="{{env('FB_APP_SECRET')}}" class="form-control" disabled></div>
                    <div class="form-group"><label class=" form-control-label">Api ID</label><input type="email" value="{{env('FB_USER_ID')}}" class="form-control" disabled></div>
                </div>
            </div>
    </div>


@endsection