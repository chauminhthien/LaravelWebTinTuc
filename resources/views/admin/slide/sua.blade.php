@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide Ảnh
                    <small>Sửa: {{$slide->Ten}}</small>
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
                <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Tên Ảnh</label>
                        <input class="form-control" name="Ten" placeholder="Nhập Tên Slide Ảnh" value="{{$slide->Ten}}" />
                    </div>
                    <div class="form-group">
                        <label>Chọn Ảnh</label>
                        <input type="file" class="form-control" name="Hinh" />
                        <img src="upload/slide/{{$slide->Hinh}}" width="200" height="200">
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <input class="form-control" name="NoiDung" placeholder="Nhập Nội Dung" value="{{$slide->NoiDung}}"/>
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" placeholder="Nhập Link" value="{{$slide->link}}"/>
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