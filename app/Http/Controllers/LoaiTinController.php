<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    //

    public function getDanhSach(){
        $loaitin = LoaiTin::all();
    	return view('admin.loaitin.danhsach',['loaitin' => $loaitin]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
    	return view('admin.loaitin.them', ['theloai' => $theloai]);
    }

    public function getSua($id){
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
    	return view('admin.loaitin.sua', ['loaitin' => $loaitin, 'theloai' => $theloai]);
    }

    public function postSua(Request $resquest, $id){
        $loaitin = LoaiTin::find($id);
        $this->validate($resquest,[
                'Ten' => 'required||min:3|max:50'
            ],[
                'Ten.required'      => 'Giá trị không được rổng',
                'Ten.min'           => 'Giá trị quá ngắn',
                'Ten.max'           => 'Giá Trị quá dài',
            ]);

        $loaitin->Ten           = $resquest->Ten;
        $loaitin->TenKhongDau   = changeTitle($resquest->Ten);
        $loaitin->idTheLoai     = $resquest->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/sua/'.$id)->with('thongbao', 'Bạn đã sửa Thành Công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();
        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Bạn đã Xoá Thành Công');
    }

    public function postThem(Request $resquest){
        // echo $resquest->TheLoai;
        // echo $resquest->Ten; required

        $this->validate($resquest,[
                'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:50'
            ],[
                'Ten.required'      => 'Giá trị không được rổng',
                'Ten.unique'        => 'Giá không được trùng thể loại hoặc giá trị củ',
                'Ten.min'           => 'Giá trị quá ngắn',
                'Ten.max'           => 'Giá Trị quá dài',
            ]);

        $loaitin                = new LoaiTin;
        $loaitin->Ten           = $resquest->Ten;
        $loaitin->TenKhongDau   = changeTitle($resquest->Ten);
        $loaitin->idTheLoai     = $resquest->TheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/them')->with('thongbao','Bạn đã thêm thành công');

    }

}
