<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./"> Web - Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="gioi-thieu.html">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="lien-he.html">Liên hệ</a>
                    </li>
                </ul>

                <form action="tim-kiem.html" method="post" class="navbar-form navbar-left" role="search">
			        <div class="form-group">
			          <input type="text" name="seach" class="form-control" placeholder="Search">
			        </div>
                    <input type="hidden" value="{{csrf_token()}}" name="_token">
			        <button type="submit" class="btn btn-default">Submit</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    @if(!isset($nguoidung))
                        <li>
                            <a href="dang-ky.html">Đăng ký</a>
                        </li>
                        <li>
                            <a href="dang-nhap.html">Đăng nhập</a>
                        </li>
                        @elseif(isset($nguoidung))
                        <li>
                        	<a href="thong-tin-ca-nhan.html">
                        		<span class ="glyphicon glyphicon-user"></span>
                        		{{$nguoidung->name}}
                        	</a>
                        </li>

                        <li>
                        	<a href="dangxuat.html">Đăng xuất</a>
                        </li>
                    @endif
                    
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>