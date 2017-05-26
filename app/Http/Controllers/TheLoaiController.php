<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai' => $theloai]);
    }

    public function getThem(){
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request){
    	$this->validate($request,[
    			'Ten' => 'required|min:3|max:50|unique:TheLoai'
    		],[
    			'Ten.required' 	=> 'Giá Trị không được để trống',
    			'Ten.min' 		=> 'Độ dài phải lớn hơn 3 ký tự',
    			'Ten.max' 		=> 'Độ dài phải nhỏ hơn 50 ký tự',
                'Ten.unique'    => 'Tên Đã Bị Trùng',
    		]);

    	$theloai 				= new TheLoai;
    	$theloai->Ten 			= $request->Ten;
    	$theloai->TenKhongDau 	= changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/them')->with('thongbao', 'Đã thêm dữ liệu thành công');
    }

    public function getSua($id){
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua', ['theloai' => $theloai]);
    }

    public function postSua(Request $request, $id){
    	$theloai = TheLoai::find($id);
    	$this->validate($request,[
    			'Ten' => 'required|unique:TheLoai|min:3|max:50'
    		],[
    			'Ten.required' 	=> 'Giá Trị không được để trống',
    			'Ten.unique' 	=> 'Giá trị Đã Tồn Tại',
    			'Ten.min' 		=> 'Độ dài phải lớn hơn 3 ký tự',
    			'Ten.max' 		=> 'Độ dài phải nhỏ hơn 50 ký tự',
    		]);
    	$theloai->Ten 			= $request->Ten;
    	$theloai->TenKhongDau 	= changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Đã sữa thành công');

    }

    public function getXoa($id){
    	$theloai = TheLoai::find($id);
    	$theloai->delete();

    	return redirect('admin/theloai/danhsach')->with('thongbao', 'Bạn đã xoá Thành công');
    }
}
