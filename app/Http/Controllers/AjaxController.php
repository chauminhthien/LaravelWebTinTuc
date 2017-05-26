<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;

class AjaxController extends Controller
{
    //
    public function getLoaiTin($id){
        $loaitin = LoaiTin::where('idTheLoai', $id)->get();
        foreach ($loaitin as  $value) {
            echo '<option value="'. $value->id .'">'. $value->Ten .'</option>';
        }
    }
    
}
