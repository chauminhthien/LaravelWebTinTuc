@extends('layout.index')
@section('title')
	Tìm Kiếm - {{$seach}}
@endsection
	
@section('content')

<div class="container">
        <div class="row">
            @include('layout.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>{{$seach}}</b></h4>
                    </div>
					@foreach($tin as $t)
                    <div class="row-item row">
                        <div class="col-md-3">
							@if($t->Hinh)
                            <a href="chi-tiet/{{$t->id}}/{{$t->TieuDeKhongDau}}.html">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{$t->Hinh}}" alt="">
                            </a>
                            @endif
                        </div>

                        <div class="col-md-9">
                            <h3>{{$t->TieuDe}}</h3>
                            <p>{!!$t->TomTat!!}</p>
                            <a class="btn btn-primary" href="chi-tiet/{{$t->id}}/{{$t->TieuDeKhongDau}}.html">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
					@endforeach

                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                            
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
@endsection

