@extends('layout.index')
@section('title')
   {{$thongtin->name}}
@endsection

@section('content')

<div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Thông tin Cá Nhân: {{$thongtin->name}}</div>
                <div class="panel-body">
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
                    <form action="thong-tin-ca-nhan.html" method="post">
                        <div>
                            <label>Họ tên</label>
                            <input type="text" value="{{$thongtin->name}}" class="form-control" placeholder="Username" name="name" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" value="{{$thongtin->email}}" class="form-control" placeholder="Email" name="email" aria-describedby="basic-addon1" disabled="" 
                            >
                        </div>
                        <br>    
                        <div>
                            <label>Nhập mật khẩu</label>
                            <input type="password" class="form-control" name="password" aria-describedby="basic-addon1">
                        </div>
                        <br>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-default">Sửa</button>

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

