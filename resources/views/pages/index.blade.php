@extends('layout.index')
@section('title')
	Trang Chủ - Tin Tức
@endsection
	
@section('content')
<div class="container">

	<!-- slider -->
	
    @include('layout.slide')
    <!-- end slide -->

    <div class="space20"></div>


    <div class="row main-left">
        @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
            		<h2 style="margin-top:0px; margin-bottom:0px;">Web Tin Tức</h2>
            	</div>

            	<div class="panel-body">
            		<!-- item -->
            		@foreach($theloai as $tl)
	            		@if(count($tl->loaitin))
						    <div class="row-item row">
			                	<h3>
			                		<a href="/">{{$tl->Ten}}</a> | 	
			                		@foreach($tl->loaitin as $lt)
			                			<small><a href="loai-tin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
			                		@endforeach
			                	</h3>
			                	<?php 
			                		$data = $tl->tintuc->where('NoiBat',1)->sortByDesc('id')->take(5);
			                		$tin1 = $data->shift();
			                	?>
			                	
			                	
			                	<div class="col-md-8 border-right">
			                		<div class="col-md-5">
			                			@if($tin1->Hinh)
					                        <a href="chi-tiet/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">
					                            <img class="img-responsive" src="upload/tintuc/{{$tin1->Hinh}}" alt="">
					                        </a>
				                        @endif
				                    </div>
				                    <div class="col-md-7">
				                        <h3>{{$tin1->TieuDe}}</h3>
				                        <p>{!!$tin1->TomTat!!}</p>
				                        <a class="btn btn-primary" href="chi-tiet/{{$tin1->id}}/{{$tin1->TieuDeKhongDau}}.html">View Project <span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>

			                	</div>
			                    

								<div class="col-md-4">
									@foreach($data as $t)
										<a href="chi-tiet/{{$t->id}}/{{$t->TieuDeKhongDau}}.html">
											<h4>
												<span class="glyphicon glyphicon-list-alt"></span>
												{{$t->TieuDe}}
											</h4>
										</a>
									@endforeach
								</div>
								
								
								<div class="break"></div>
			                </div>
		                @endif
                	@endforeach
	                <!-- end item -->

				</div>
            </div>
    	</div>
    </div>
    <!-- /.row -->
</div>
@endsection

