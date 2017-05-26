<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    //
    public function getDanhSach(){
        $user = User::all();
    	return view('admin.user.danhsach', ['user' => $user]);
    }

    public function getThem(){
    	return view('admin.user.them');
    }

    public function postThem(Request $request){
        $this->validate($request,[
                'name'          => 'required|min:3|max:50',
                'email'         => 'required|max:50|email|unique:users,email',
                'password'      => 'required|min:3|max:50',
                'passwordLai'   => 'required|same:password',
            ], [
                'name.required'         => 'Name không được để trống',
                'name.min'              => 'Name quá ngắn',
                'name.max'              => 'Name quá dài',
                'email.required'        => 'Email không được để trống',
                'email.unique'          => 'Email đã tồn tại',
                'email.email'           => 'Email Không đúng định dạng',
                'email.max'             => 'Email quá dài',
                'password.required'     => 'Mật khẩu không được để trống',
                'password.min'          => 'Mật khẩu quá ngắn',
                'password.max'          => 'Mật khẩu quá dài',
                'passwordLai.same'      => 'Nhập Mật khẩu không khớp',
                'passwordLai.required'  => 'Chưa Nhập lại PassWord',
            ]);

        $user               = new User;
        $user->name         = $request->name;
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        $user->quyen        = $request->quyen;
        $user->save();

        return redirect('admin/user/them')->with('thongbao','Thêm User Thành Công');
    }

    public function getSua($id){
        $user = User::find($id);
    	return view('admin.user.sua', ['user' => $user]);
    }

    public function postSua(Request $request, $id){
        $user = User::find($id);
        $this->validate($request,[
                'name'          => 'required|min:3|max:50',
                'password'      => 'min:3|max:50',
            ], [
                'name.required'         => 'Name không được để trống',
                'name.min'              => 'Name quá ngắn',
                'password.min'          => 'Mật khẩu quá ngắn',
                'password.max'          => 'Mật khẩu quá dài',
            ]);
        $user->name = $request->name;
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }else{
            $user->password = $user->password;
        }

        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Đã sửa User Thành Công');
    }

    public function getXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach/')->with('thongbao','Đã xoá User thành công');
    }

    public function getLoginAd(){
        return view('admin.login');
    }

    public function postLoginAd(Request $request){
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
        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
            return redirect('admin/user/danhsach');
        }else{
            return redirect('admin/login')->with('loi','Đăng Nhập Thất Bại');
        }
    }

    public function getLogoutAd(){
        Auth::logout();

        return redirect('admin/login');
    }
}
