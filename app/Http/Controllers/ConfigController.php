<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Mail;

class ConfigController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nconfig = Setting::all();
    
        return view('/admin/config', compact('nconfig'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Setting::where('name', 'name')->update(['value' => request('name')]);
        Setting::where('name', 'sub-title')->update(['value' => request('sub-title')]);
        Setting::where('name', 'debut')->update(['value' => request('debug')]);
        Setting::where('name','appToken')->update(['value' => request('appToken')]);
        Setting::where('name','clientId')->update(['value' => request('clientId')]);
        Setting::where('name','clientSecret')->update(['value' => request('clientSecret')]);


        $nconfig = Setting::all();


        return redirect('/admin/config/create')->with(compact('nconfig'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
