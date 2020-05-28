@extends('menu')

@section('body')
    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>{{session('user')}}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
                    <ol class="breadcrumb text-right">
                        <li class="active">Welcome</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="social-box facebook">
            <i class="fa fa-facebook"></i>
            <ul>
                <li>
                    <sctrong><span class="count">40</span> k</strong>
                        <span>friends</span>
                </li>
                <li>
                    <sctrong><span class="count">450</span></strong>
                        <span>feeds</span>
                </li>
            </ul>
        </div>
        <!--/social-box-->
    </div><!--/.col-->

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>New Post</strong>
            </div>
            <div class="card-body card-block">
                <form method="post">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-12">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fa fa-facebook"></i></button>
                                </div>
                                <input type="text" id="post" name="post" placeholder="Write down some thing here" class="form-control" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Recent Posts</strong>
                        </div>
                        <div class="card-body">
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Text</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $id = 0;
                                @endphp
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->text}}</td>
                                        <td>{{$post->posted_at}}</td>
                                        <td><a href="{{url('delete/') . '/' .$id}}">Delete</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

@endsection

@section('script')
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>
@endsection