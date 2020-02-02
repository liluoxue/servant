<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dorm;
class ServantController extends Controller
{
    public function home()
    {
        return '主页';
    }
    public function update(Dorm $dorm)
    {
        //dd(compact('dorm'));
        //$dorm=DB::table('dorms')->where('dormname','3A406')->get();
        //dd($dormname[0]dormname);
        //dd($dorm);
        //dd($dorm[0]);

        
        $mission=DB::table('missions')->get();
        //dd($mission);
        
        $data['mission']=$mission[0];
        $data['dorm']=compact('dorm');
        //dd($data);
        //dd(compact('data'));
       
        return view('upload',[
            'dorm'=>$dorm,
            'mission'=>$mission[0]
        ]);
    }
}
