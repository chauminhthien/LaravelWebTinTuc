<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\TheLoai;

Route::get('/', 'PagesController@getIndex');

Route::get('loai-tin/{id}/{url}.html', 'PagesController@getLoaiTin');
Route::get('chi-tiet/{id}/{url}.html', 'PagesController@getChiTiet')->where(['url' => '[a-zA-z0-9\-\.]+']);
Route::get('gioi-thieu.html', 'PagesController@getGoiThieu');
Route::get('lien-he.html', 'PagesController@getLienHe');
Route::get('dang-nhap.html', 'PagesController@getDangNhap');
Route::post('dang-nhap.html', 'PagesController@postDangNhap');
Route::get('dangxuat.html', 'PagesController@getDangXuat');
Route::get('dang-ky.html', 'PagesController@getDangKy');
Route::post('dang-ky.html', 'PagesController@postDangKy');
Route::post('tim-kiem.html', 'PagesController@postTimKiem');
Route::get('tim-kiem.html', 'PagesController@getTimKiem');
Route::get('thong-tin-ca-nhan.html',['middleware' => 'userlogin' , 'uses' => 'PagesController@getThongTin']);
Route::post('thong-tin-ca-nhan.html',['middleware' => 'userlogin' , 'uses' => 'PagesController@postThongTin']);
Route::post('comment/{id}',['middleware' => 'userlogin' , 'uses' => 'PagesController@postComment']);






Route::get('admin/login', 'UserController@getLoginAd');
Route::post('admin/login', 'UserController@postLoginAd');
Route::get('admin/logout', 'UserController@getLogoutAd');
Route::get('admin/', function(){
	return redirect('admin/user/danhsach');
});

Route::group(['prefix' => 'admin', 'middleware' => 'adminlogin'], function(){
	Route::group(['prefix' => 'loaitin'], function(){
		Route::get('danhsach', 'LoaiTinController@getDanhSach');

		Route::get('them', 'LoaiTinController@getThem');
		Route::post('them', 'LoaiTinController@postThem');

		Route::get('sua/{id}', 'LoaiTinController@getSua');
		Route::post('sua/{id}', 'LoaiTinController@postSua');

		Route::get('xoa/{id}', 'LoaiTinController@getXoa');
	});

	Route::group(['prefix' => 'theloai'], function(){
		Route::get('danhsach', 'TheLoaiController@getDanhSach');

		Route::get('them', 'TheLoaiController@getThem');
		Route::post('them', 'TheLoaiController@postThem');

		Route::get('sua/{id}', 'TheLoaiController@getSua');
		Route::post('sua/{id}', 'TheLoaiController@postSua');

		Route::get('xoa/{id}', 'TheLoaiController@getXoa');
	});

	Route::group(['prefix' => 'tintuc'], function(){
		Route::get('danhsach', 'TinTucController@getDanhSach');

		Route::get('them', 'TinTucController@getThem');
		Route::post('them', 'TinTucController@postThem');

		Route::get('sua/{id}', 'TinTucController@getSua');
		Route::post('sua/{id}', 'TinTucController@postSua');

		Route::get('xoa/{id}', 'TinTucController@getXoa');	
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('danhsach', 'UserController@getDanhSach');

		Route::get('them', 'UserController@getThem');
		Route::post('them', 'UserController@postThem');

		Route::get('sua/{id}', 'UserController@getSua');
		Route::post('sua/{id}', 'UserController@postSua');

		Route::get('xoa/{id}', 'UserController@getXoa');
	});

	Route::group(['prefix' => 'slide'], function(){
		Route::get('danhsach', 'SlideController@getDanhSach');

		Route::get('them', 'SlideController@getThem');
		Route::post('them', 'SlideController@postThem');

		Route::get('sua/{id}', 'SlideController@getSua');
		Route::post('sua/{id}', 'SlideController@postSua');

		Route::get('xoa/{id}', 'SlideController@getXoa');	
	});

	Route::group(['prefix' => 'ajax'], function(){
		Route::get('loaitin/{id}', 'AjaxController@getLoaiTin');
	});
});