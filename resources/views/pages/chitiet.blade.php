@extends('layout.index')
@section('title')
	{{$tin->TieuDe}}
@endsection
	
@section('content')

<div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tin->TieuDe}}</h1>

                <!-- Author -->
               

                <!-- Preview Image -->
                @if($tin->Hinh)
                    <img class="img-responsive" src="upload/tintuc/{{$tin->Hinh}}" alt="" style="height: 300px; width: 900px;">
                @endif
                <!-- Date/Time -->
                @if($tin->created_at)
                    <p><span class="glyphicon glyphicon-time"></span> {{$tin->created_at}}</p>
                @endif
                <hr>

                <!-- Post Content -->
                {!!$tin->NoiDung!!}

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                 @if(isset($nguoidung))
                    <div class="well">
                        <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $loi)
                                    {{$loi}}<br/>
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="comment/{{$tin->id}}" method="post" role="form">
                            <div class="form-group">
                                <textarea name="NoiDung" class="form-control" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="url" value="chi-tiet/{{$tin->id}}/{{$tin->TieuDeKhongDau}}.html">
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    </div>
                @endif
                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($comment as $cmt)
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$cmt->user->name}}
                                <small>{{$cmt->created_at}}</small>
                            </h4>
                            {{$cmt->NoiDung}}
                        </div>
                    </div>
                @endforeach
                <!-- Comment -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinMore as $tlq)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                @if($tlq->Hinh)
                                <a href="chi-tiet/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html">
                                    <img style="width: 320px; height: 70px;" class="img-responsive" src="upload/tintuc/{{$tlq->Hinh}}" alt="">
                                </a>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <a href="chi-tiet/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($tinMore as $tm)
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-5">
                                    @if($tm->Hinh)
                                        <a href="chi-tiet/{{$tm->id}}/{{$tm->TieuDeKhongDau}}.html">
                                            <img style="width: 320px; height: 70px;" class="img-responsive" src="upload/tintuc/{{$tm->Hinh}}" alt="">
                                        </a>
                                    @endif
                                </div>
                                <div class="col-md-7">
                                    <a href="chi-tiet/{{$tm->id}}/{{$tm->TieuDeKhongDau}}.html"><b>{{$tm->TieuDe}}</b></a>
                                </div>
                                
                                <div class="break"></div>
                            </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
@endsection

