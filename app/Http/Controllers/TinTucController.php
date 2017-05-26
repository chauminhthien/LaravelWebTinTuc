<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;

class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc = TinTuc::orderBy('id', 'ASC')->get();
    	return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
    	return view('admin.tintuc.them', ['theloai' => $theloai]);
    }

    public function postThem(Request $request){
        $this->validate($request,[
                'LoaiTin'   => 'required',
                'TieuDe'    => 'required|min:3|max:100|unique:TinTuc,TieuDe',
                'TomTat'    => 'required|min:3|max:200',
                'NoiDung'   => 'required|min:3',
            ],[
                'LoaiTin.required'  => 'Loại Tin không được rỗng',
                'TieuDe.required'   => 'Tiêu đề không được rỗng',
                'TieuDe.min'        => 'Tiêu Đề quá ngắn',
                'TieuDe.max'        => 'Tiêu Đề quá dài',
                'TieuDe.unique'     => 'Tiêu Đề không được trùng',
                'TomTat.required'   => 'Tốm Tắt không được rỗng',
                'TomTat.min'        => 'Tốm Tắt quá ngắn',
                'TomTat.max'        => 'Tốm Tắt quá dài',
                'NoiDung.required'  => 'Nội Dung không được rỗng',
                'NoiDung.min'       => 'Nội Dung quá ngắn',
            ]);

        $tintuc                     = new TinTuc;
        $tintuc->TieuDe             = $request->TieuDe;
        $tintuc->TieuDeKhongDau     = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin          = $request->LoaiTin;
        $tintuc->TomTat             = $request->TomTat;
        $tintuc->TieuDe             = $request->TieuDe;
        $tintuc->NoiDung            = $request->NoiDung;
        $tintuc->NoiBat             = $request->NoiBat;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){ 
                return redirect('admin/tintuc/them')->with('loi','Ảnh Không Đúng Định dạng');
            }else{
                $file = $request->file('Hinh');
                $hinh = time().'_'.str_random(4).'_'.$duoi;
            
                $file->move('upload/tintuc', $hinh);
                $tintuc->Hinh             = $hinh;
            }
        
            
        }else{
            $tintuc->Hinh             = "";
        }

         $tintuc->save();

         return redirect('admin/tintuc/them')->with('thongbao','Tin tức đã được thêm');
    }

    public function getSua($id){
        $theloai    = TheLoai::all();
        $tintuc     = TinTuc::find($id);
        $loaitin    =  LoaiTin::all();
    	return view('admin.tintuc.sua', ['theloai' => $theloai, 'tintuc' => $tintuc, 'loaitin' => $loaitin]);
    }
    public function postSua(Request $request, $id){
         $this->validate($request,[
                'LoaiTin'   => 'required',
                'TieuDe'    => 'required|min:3|max:100',
                'TomTat'    => 'required|min:3|max:200',
                'NoiDung'   => 'required|min:3',
            ],[
                'LoaiTin.required'  => 'Loại Tin không được rỗng',
                'TieuDe.required'   => 'Tiêu đề không được rỗng',
                'TieuDe.min'        => 'Tiêu Đề quá ngắn',
                'TieuDe.max'        => 'Tiêu Đề quá dài',
                'TomTat.required'   => 'Tốm Tắt không được rỗng',
                'TomTat.min'        => 'Tốm Tắt quá ngắn',
                'TomTat.max'        => 'Tốm Tắt quá dài',
                'NoiDung.required'  => 'Nội Dung không được rỗng',
                'NoiDung.min'       => 'Nội Dung quá ngắn',
            ]);
        $tintuc                     = TinTuc::find($id);
        $tintuc->TieuDe             = $request->TieuDe;
        $tintuc->TieuDeKhongDau     = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin          = $request->LoaiTin;
        $tintuc->TomTat             = $request->TomTat;
        $tintuc->TieuDe             = $request->TieuDe;
        $tintuc->NoiDung            = $request->NoiDung;
        $tintuc->NoiBat             = $request->NoiBat;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){ 
                return redirect('admin/tintuc/sua/'.$id)->with('loi','Ảnh Không Đúng Định dạng');
            }else{
               
                $hinh = time().'_'.str_random(4).'_'.$duoi;
                $file->move('upload/tintuc', $hinh);
                @unlink('upload/tintuc/'.$tintuc->Anh);
                $tintuc->Hinh             = $hinh;
            }
            
        
            
        }else{
            $tintuc->Hinh             = $tintuc->Hinh;
        }
         $tintuc->save();
         return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Đã sửa thành công');
         
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao', 'Bạn đã Xoá thành công');
    }
}
