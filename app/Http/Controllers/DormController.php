<?php

namespace App\Http\Controllers;

use App\Dorm;
use Illuminate\Http\Request;

class DormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function dormlist(){
        return Dorm::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dorm = new Dorm();
        $dorm->dormname=$request->dormname;
        $dorm->save();
        return response()->isSuccessful();
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $dorm = new Dorm();
        $dorm->dormname=$request->dormname;
        $dorm->dormmember=1;
        $dorm->save();
        return response('succuess',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dorm  $dorm
     * @return \Illuminate\Http\Response
     */
    public function show(Dorm $dorm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dorm  $dorm
     * @return \Illuminate\Http\Response
     */
    public function edit(Dorm $dorm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dorm  $dorm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dorm $dorm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dorm  $dorm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dorm $dorm)
    {
        //
    }
}
