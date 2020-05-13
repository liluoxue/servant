<?php

namespace App\Http\Controllers;

use App\Submit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UploadController extends Controller
{
    //
    public function fileupload(Request $request)
    {

        //$file=$request->file('picture');

        $file = $request->file('file');

        $mid    = $request->mid;
        $dormid = $request->dormid;
        //dd($dormid);
        $first  = DB::table('dorms')->where('id', $dormid)->first();
        $mission= DB::table('missions')->where('id',$mid)->first();
        //dd($first);
        $dormname = $first->dormname;
        if (DB::table('submits')->where('mid', $mid)->count() == 0) {
            $submit = new Submit;
            $submit->mid = $mid;
            $submit->did = $dormid;
            //$submit->file = $path;

            //$fileextention=$file->getClientOriginalExtension();

            if ($file->isValid()) {
                $filename = $file->getClientOriginalName(); //测试代码
                $fileextention = $file->getClientOriginalExtension();

                $fileroute = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '-' . $fileextention;
                //$judged=Storage::disk('upload'.'/'.$mid)->put($filename,file_get_contents($fileroute));
                $data['code'] = '0';
                $data['msg'] = 'ok';
                $data['data'] = $filename;
                //echo json_encode($data);
                $path = $request->file('file')->storeAs($request->mid . '/' . ($dormname), $request->fname . '.' . $fileextention);
                $submit->file = $path;
            }

            $submit->save();

            return response()->json(['msg' => '哈哈哈']);
        } else {
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName(); //测试代码
                $fileextention = $file->getClientOriginalExtension();

                $fileroute = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '-' . $fileextention;
                //$judged=Storage::disk('upload'.'/'.$mid)->put($filename,file_get_contents($fileroute));
                $data['code'] = '0';
                $data['msg'] = 'ok';
                $data['data'] = $filename;
                //echo json_encode($data);
                $path = $request->file('file')->storeAs($request->mid . '/' . ($dormname), $request->fname . '.' . $fileextention);
            }
            $count = DB::update('update submits set file =  ?,did = ? where mid = ?', [$path, $dormid, $mid]);

            return ['msg' => '接收成功'];
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
    public function dormname(Request $request)
    {
        $dormid = $request->dormid;
        $first = DB::table('dorms')->where('id', $dormid)->first();
        return ['dormname' => $first->dormname];
    }
    public function uplist(Request $request)
    {
        $mid = $request->missionid;
        $tabledata = DB::table('submits')->where('mid', $mid)->get();

        $dormcollection = DB::table('dorms')->pluck('id');
        $dorm = $dormcollection->toArray();
        $dormname = DB::table('dorms')->pluck('dormname');
        $dormname = $dormname->toArray();
        //dd($dormname);
        //dd($dorm);
        //dd($tabledata->toArray());
        //$tabledata=$tabledata->toArray();
        //dd($tabledata);
        $uplist = array();
        for ($i = 0; $i < count($dorm); $i++) {
            if ($tabledata->where('did', $dorm[$i])->count() == 0) {
                $uplist[$i] = collect(['dormname', 'upif', 'id']);
                $uplist[$i] = $uplist[$i]->combine([$dormname[$i], 0, '']);
                $uplist[$i] = $uplist[$i]->toArray();
            } else {
                $uplist[$i] = collect(['dormname', 'upif', 'id']);
                $uplist[$i] = $uplist[$i]->combine([$dormname[$i], 1, DB::table('submits')->where('mid', $mid)->where('did', $dorm[$i])->first()->id]);
                $uplist[$i] = $uplist[$i]->toArray();
            }
        }

        /*
        foreach($tabledata as $key => $value) //之前写法的测试代码
        {
        $judge=false;
        for($i=0;$i<count($dorm);$i++)
        {

        if(strcmp($value->did,$dorm[$i])==0)
        {

        $judge=true;
        }
        }

        if($judge==true)
        {
        $value->id="1";
        }
        else
        {
        $value->id="1";
        }

        }
        dd($tabledata);
         */
        return $uplist;
    }
    public function download(Request $request)
    {
        $id = $request->id;
        $path = DB::table('submits')->where('id', $id)->first()->file;
        $name = basename($path);
        //return response()->download(storage_path('app/' . $path), $name . '.cpp');
        $data=[
            'url'=>storage_path('app/' . $path),
            'name'=>$name
        ];
        return $data;
    }
    public function missionlist(Request $request)
    {
        $did=$request->did;
       
        $missionlist = DB::table('missions')->get();
        if($did!='-1')
        {
            $dorm = DB::table('dorms')->where('id',$did)->first();
            if($dorm!=null)
                $dormname=$dorm->dormname;
            else
                $dormname='';
        }
        else
        $dormname='';
        $data=[
            'dormname'=>$dormname,
            'missionlist'=>$missionlist
        ];
        return response()->json($data);
    }
    public function oath()
    {

        $data['status']=200;
        return $data;
    }
}
