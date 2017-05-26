@extends('layout.index')
@section('title')
	Đăng Nhập Thành Viên
@endsection
	
@section('content')

<div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Đăng nhập</div>
                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $loi)
                                {{$loi}}<br/>
                            @endforeach
                        </div>
                    @endif

                    @if(session('loi'))
                        <div class="alert alert-danger">
                            {{session('loi')}}
                        </div>
                    @endif
                    <form action="dang-nhap.html" method="post">
                        <div>
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" 
                            >
                        </div>
                        <br>    
                        <div>
                            <label>Mật khẩu</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <br>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-default">Đăng nhập
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- end slide -->
</div>
@endsection

