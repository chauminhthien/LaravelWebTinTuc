@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Sửa: {{$tintuc->TieuDe}}</small>
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
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" id="TheLoai" name="TheLoai">
                         @foreach($theloai as $tl)
                                <option 
                                 @if($tintuc->loaitin->theloai->id == $tl->id)
                                    selected
                                 @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                           
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" id="LoaiTin" name="LoaiTin">
                            @foreach($loaitin as $lt)
                                <option 
                                 @if($tintuc->loaitin->id == $lt->id)
                                    selected
                                 @endif
                                value="{{$lt->id}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu Đề" value="{{$tintuc->TieuDe}}" />
                    </div>
                    
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea id="demo" name="TomTat" class="form-control ckeditor" rows="3">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="3">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <input type="file" class="form-control" name="Hinh"  />
                        @if($tintuc->Hinh)
                        <img src="upload/tintuc/{{$tintuc->Hinh}}" width="200" height="200" class="img-repomsive">
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1"
                            @if($tintuc->NoiBat == 1)
                             checked="" 
                            @endif
                             type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat"
                            @if($tintuc->NoiBat == 0)
                             checked="" 
                            @endif 
                            value="0" type="radio">Không
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

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        
        $('#TheLoai').change(function(){
            var id = $(this).val();
            loaitin(id);
        });

        function loaitin(id){
            $.get(
                'admin/ajax/loaitin/'+id,
                function(data){
                    $('#LoaiTin').html(data);
                }
            );
        }
    });

</script>
<script type="text/javascript" language="javascript" src="admin_asset/ckeditor/ckeditor.js" ></script>
@endsection