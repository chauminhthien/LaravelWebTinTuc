@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Sửa: {{$user->name}}</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
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
                @if(session('loi'))
                    <div class="alert alert-danger">
                        {{session('loi')}}
                    </div>
                @endif
                <form action="admin/user/sua/{{$user->id}}" method="POST">
                    <div class="form-group">
                        <label>Tên User</label>
                        <input class="form-control" name="name" placeholder="Nhập Tên User" value="{{$user->name}}" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p>{{$user->email}}</p>
                    </div>
                    <div class="form-group">
                        <label>PassWord</label>
                        <input type="password" class="form-control" name="password" placeholder="Nhập PassWord" />
                    </div>
                    
                    <div class="form-group">
                        <label>Chọn quyền cho User</label>
                        <label class="radio-inline">
                            <input name="quyen" value="1"
                            @if($user->quyen == 1)
                                checked="" 
                            @endif
                             type="radio">Admin
                        </label>
                        <label class="radio-inline">
                            <input name="quyen" value="0" 
                            @if($user->quyen == 0)
                                checked="" 
                            @endif
                            type="radio">Thường
                        </label>
                    </div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm Mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection