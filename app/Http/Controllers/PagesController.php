<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;
use App\Comment;
use App\User;

class PagesController extends Controller
{
    //

    public function __construct(){
    	$theloai 	= TheLoai::all();
    	$slide 		= Slide::all();
    	view()->share('theloai',	$theloai);
    	view()->share('slide',	$slide);

    	if(Auth::check()){
    		view()->share('nguoidung', Auth::user());
    	}
    }

    public function getIndex(){
    	return view('pages.index');
    }

    public function getLoaiTin($id){
    	$loaitin 	= LoaiTin::find($id);
    	$tintuc 	= TinTuc::where('idLoaiTin', $id)->paginate(5);
    	return view('pages.loaitin', ['loai_tin' => $loaitin, 'tin' => $tintuc]);
    }

    public function getChiTiet($id){
    	$tin 			= TinTuc::find($id);
    	$tinNoiBat 		= TinTuc::where('NoiBat',1)->orderBy('id', 'DESC')->take(5)->get();
    	$tinMore 		= TinTuc::where('idLoaiTin', $tin->idLoaiTin)->orderBy('id', 'DESC')->take(4)->get();
    	$cmt 			= Comment::where('idTinTuc',$id)->get();
    	return view('pages.chitiet',[
    			'tin' 		=> $tin,
    			'tinNoiBat' => $tinNoiBat,
    			'tinMore' 	=> $tinMore,
    			'comment' 	=> $cmt
    		]);
    }

    public function getGoiThieu(){
    	return view('pages.gioithieu');
    }

    public function getLienhe(){
    	return view('pages.lienhe');
    }

    public function getDangNhap(){
    	return view('pages.login');
    }

    public function postDangNhap(Request $request){
    	$this->validate($request,[
                'email'          => 'required|email|max:50',
                'password'      => 'required|min:3|max:50',
            ], [
                'email.required'        => 'Email không được để trống',
                'email.email'           => 'Email Không đúng định dạng',
                'email.max'             => 'Name quá ngắn',
                'password.min'          => 'Mật khẩu quá ngắn',
                'password.max'          => 'Mật khẩu quá dài',
                'password.required'     => 'Mật khẩu không được để trống',
            ]);
    	if(Auth::attempt(['email' => $request->email,'password' => $request->password])){
    		return redirect('./');
    	}else{
    		return redirect('dang-nhap.html')->with('loi', 'Tài Khoảng hoặc mật khẩu không đúng');
    	}
    }

    public function getDangXuat(){
    	Auth::logout();

    	return redirect('./');
    }
    public function getThongTin(){
    	$thongtin = User::find(Auth::user()->id);
    	return view('pages.suathongtin', ['thongtin' => $thongtin]);
    }

    public function getDangKy(){
    	return view('pages.dangky');
    }

    public function postDangKy(Request  $request){
    	$this->validate($request,[
    			'name'          	=> 'required|min:3|max:50',
                'email'          	=> 'required|email|max:50',
                'password'      	=> 'required|min:3|max:50',
                'passwordAgain'     => 'required|same:password',
            ], [
            	'name.required'        	=> 'Name không được để trống',
                'name.min'           	=> 'Name quá Ngắn',
                'name.max'             	=> 'Name quá dài',
                'email.required'        => 'Email không được để trống',
                'email.email'           => 'Email Không đúng định dạng',
                'email.max'             => 'Name quá ngắn',
                'password.min'          => 'Mật khẩu quá ngắn',
                'password.max'          => 'Mật khẩu quá dài',
                'password.required'     => 'Mật khẩu không được để trống',
                'passwordAgain.required'=> 'Mật khẩu Again không được để trống',
                'passwordAgain.same'    => 'Mật khẩu không trùng khớp',
            ]);
    	$user 				= new User;
    	$user->name 		= $request->name;
    	$user->quyen 		= 0;
    	$user->password 	= bcrypt($request->password);
    	$user->email 		= $request->email;
    	$user->save();

    	return redirect('dang-ky.html')->with('thongbao', 'Bạn Đã đăng ký Thành công');
    }

    public function postThongTin(Request  $request){
    	$this->validate($request,[
    			'name'          	=> 'required|min:3|max:50',
                'password'      	=> 'min:3|max:50',
            ], [
            	'name.required'        	=> 'Name không được để trống',
                'name.min'           	=> 'Name quá Ngắn',
                'name.max'             	=> 'Name quá dài',
                'password.min'          => 'Mật khẩu quá ngắn',
                'password.max'          => 'Mật khẩu quá dài',
            ]);
    	$user 		= User::find(Auth::user()->id);
    	$user->name = $request->name;
    	if($request->has('password')){
    		$user->password = bcrypt($request->password);
    	}else{
    		$user->password = $user->password;
    	}

    	$user->save();

    	return redirect('thong-tin-ca-nhan.html')->with('thongbao','Bạn đã thay đổi thông tin thành công');
    }

    public function postTimKiem(Request  $request){
    	$seach = 'a';
    	$seach = $request->seach;
    	$tin = TinTuc::where('TieuDe','like','%'.$seach.'%')->get();
    	return view('pages.timkiem',['tin' => $tin,'seach' => $request->seach]);
    }

    public function getTimKiem(){
    	return view('pages.seach');
    }

    public function postComment(Request  $request, $id){
        $this->validate($request,[
                'NoiDung'           => 'required|min:3',
            ],[
                'NoiDung.required'  => 'Chưa nhập nội dung',
                'NoiDung.min'       => 'Nội dung comment quá ngắn',
            ]);
        $cmt            = new Comment;
        $cmt->idUser    = Auth::user()->id;
        $cmt->idTinTuc  = $id;
        $cmt->NoiDung   = $request->NoiDung;
        $cmt->save();
        return redirect($request->url)->with('thongbao', 'Bạn Đã bình luận thành công');
    }
}

