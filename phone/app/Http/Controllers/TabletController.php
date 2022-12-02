<?php

namespace App\Http\Controllers;

use App\Models\Tablet;
use Illuminate\Http\Request;

class TabletController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tablet');
    }

    public function api() 
    {
        $tablets = Tablet::all();
        $datatables = datatables()->of($tablets)->addIndexColumn();

        return $datatables->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $this->validate($request,[
            'brand' => ['required'],
            'type' => ['required'],
            'imei' => ['required'],
            'spec' => ['required'],
        ]);

         tablet::create($request->all());

        return redirect('tablets');

        //  return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function show(Tablet $tablet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tablet $tablet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tablet $tablet)
    {
        $this->validate($request,[
            'brand' => ['required'],
            'type' => ['required'],
            'imei' => ['required'],
            'spec' => ['required'],
        ]);

        $tablet->update($request->all());

        return redirect('tablets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tablet  $tablet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tablet $tablet)
    {
        $tablet->delete();
    }
}
