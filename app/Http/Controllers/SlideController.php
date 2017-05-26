<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Slide;

class SlideController extends Controller
{
    //
	public function getDanhSach(){
		$slide = Slide::all();
		return view('admin.slide.danhsach', ['slide' => $slide]);
	}

	public function getThem(){
		return view('admin.slide.them');
	}

	public function postThem(Request $request){
		$this->validate($request,[
				'Ten' 		=> 'required|min:3|max:50',
				'Hinh' 		=> 'required',
				'NoiDung' 	=> 'required|min:3|max:50',
				'Link' 		=> 'required|min:3|max:50',
			],[
				'Ten.required' 		=> 'Tên Không được rỗng',
				'Ten.min' 			=> 'Tên quá ngắn',
				'Ten.max' 			=> 'Tên quá dài',
				'Hinh.required' 	=> 'Hình Không được rỗng',
				'NoiDung.required' 	=> 'Nội Dung Không được rỗng',
				'NoiDung.min' 		=> 'Nội Dung quá ngắn',
				'NoiDung.max' 		=> 'Nội Dung quá dài',
				'Link.required' 	=> 'Link Không được rỗng',
				'Link.min' 			=> 'Link quá ngắn',
				'Link.max' 			=> 'Link quá dài',
			]);

		$slide 				= new SLide;
		$slide->Ten 		= $request->Ten;
		$slide->NoiDung 	= $request->NoiDung;
		$slide->Link 		= $request->Link;

		$file = $request->file('Hinh');
		$size = $file->getClientSize();
		if($size > 1024*2*1024){
			return redirect('admin/slide/them')->with('loi', 'Size ảnh quá Lớn');
		}else{
			$duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){ 
                return redirect('admin/slide/them')->with('loi','Ảnh Không Đúng Định dạng');
            }else{
                $file = $request->file('Hinh');
                $hinh = time().'_'.str_random(4).'_'.$duoi;
            
                $file->move('upload/slide', $hinh);
                $slide->Hinh             = $hinh;
            }
		}

		$slide->save();
		return redirect('admin/slide/them')->with('thongbao', 'Đã Thêm Thành Công');

	}

	public function getSua($id){
		$slide = slide::find($id);
		return view('admin.slide.sua', ['slide' => $slide]);
	}

	public function postSua(Request $request, $id){
		$this->validate($request,[
				'Ten' 		=> 'required|min:3|max:50',
				'NoiDung' 	=> 'required|min:3|max:50',
				'Link' 		=> 'required|min:3|max:50',
			],[
				'Ten.required' 		=> 'Tên Không được rỗng',
				'Ten.min' 			=> 'Tên quá ngắn',
				'Ten.max' 			=> 'Tên quá dài',
				'NoiDung.required' 	=> 'Nội Dung Không được rỗng',
				'NoiDung.min' 		=> 'Nội Dung quá ngắn',
				'NoiDung.max' 		=> 'Nội Dung quá dài',
				'Link.required' 	=> 'Link Không được rỗng',
				'Link.min' 			=> 'Link quá ngắn',
				'Link.max' 			=> 'Link quá dài',
			]);

		$slide 				= Slide::find($id);
		$slide->Ten 		= $request->Ten;
		$slide->NoiDung 	= $request->NoiDung;
		$slide->Link 		= $request->Link;

		if($request->hasFile('Hinh')){

			$file = $request->file('Hinh');
			$size = $file->getClientSize();
			if($size > 1024*2*1024){
				return redirect('admin/slide/them')->with('loi', 'Size ảnh quá Lớn');
			}else{
				$duoi = $file->getClientOriginalExtension();
	            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpge'){ 
	                return redirect('admin/slide/them')->with('loi','Ảnh Không Đúng Định dạng');
	            }else{
	                $file = $request->file('Hinh');
	                $hinh = time().'_'.str_random(4).'_.'.$duoi;
	            
	                $file->move('upload/slide', $hinh);
	                unlink('upload/slide/'.$slide->Hinh);
	                $slide->Hinh             = $hinh;
	            }
			}
		}else{
			$slide->Hinh = $slide->Hinh;
		}

		$slide->save();
		return redirect('admin/slide/sua/'.$id)->with('thongbao', 'Đã Thêm Thành Công');
	}

	public function getXoa($id){
		$slide = Slide::find($id);
		unlink('upload/slide/'.$slide->Hinh);
		$slide->delete();
		return redirect('admin/slide/danhsach')->with('thongbao', 'Đã Xoá Thành Công');
	}

}
