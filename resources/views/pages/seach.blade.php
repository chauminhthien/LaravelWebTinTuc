@extends('layout.index')
@section('title')
    Tìm Kiếm
@endsection

@section('content')

<div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Nhập Thông Tin Tìm Kiếm</div>
                <div class="panel-body">
                    
                    <form action="tim-kiem.html" method="post" class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                      <input type="text" name="seach" class="form-control" placeholder="Search">
                    </div>
                    <input type="hidden" value="{{csrf_token()}}" name="_token">
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
        </div>
    </div>
    <!-- end slide -->
</div>
@endsection

