<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Dorm;
use App\Submit;

class UploadController extends Controller
{
    //
    public function fileupload(Request $request)
    {
        
        $file=$request->file('picture');  
        $mission=$request->fname;
        $fileextention=$file->getClientOriginalExtension();
        if($file->isValid())
        {
            /* $filename=$file->getClientOriginalName();//测试代码
            $fileextention=$file->getClientOriginalExtension();

            $fileroute=$file->getRealPath();
            $filename = date('Y-m-d-H-i-s').'-'.uniqid().'-'.$fileextention;
            $judged=Storage::disk('upload'.'/'.$mission)->put($filename,file_get_contents($fileroute));
            $data['code']='0';
            $data['msg']='ok';
            $data['data']=$filename;
            echo json_encode($data); */
            $path   = $request->file('picture')->storeAs($request->fname,($request->dorm).'.'.$fileextention);
            $submit = new Submit;
       $submit->mid = $request->mid;
       $submit->file = $path;
            $submit->save();
            return view('upyes');
        }
        
        
    }
    public function upindex()
    {
        return view('upindex');
    }
    public function upyes()
    {
        return view('upyes');
    }
}
