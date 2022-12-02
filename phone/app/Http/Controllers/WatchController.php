<?php

namespace App\Http\Controllers;
use App\Models\Phone;
use App\Models\Tablet;
use App\Models\Laptop;
use App\Models\Watch;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phones = Phone::all();
        $tablets = Tablet::all();
        $laptops = Laptop::all();
        return view('admin.watch', compact('phones','tablets','laptops') );
    }

    public function api()
    {
        $watches = Watch::all();
       
        return json_encode($watches);
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
            'series'  => ['required','max:65'],
            'type'  => ['required','string'],
            'year'  => ['required'],
            'phones_id'=>['required'],
            'tablet_id'=>['required'],
            'laptop_id'=>['required'],
            'qty'  => ['required'],
            'price'  => ['required'],
        ]);
        
        Watch::create($request->all());

        return redirect('watches');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function show(Watch $watch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function edit(Watch $watch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Watch $watch)
    {
        $this->validate($request,[
            'series'  => ['required','max:65'],
            'type'  => ['required','string'],
            'year'  => ['required'],
            'phones_id'=>['required'],
            'tablet_id'=>['required'],
            'laptop_id'=>['required'],
            'qty'  => ['required'],
            'price'  => ['required'],
        ]);
        
        $watch-> update($request->all());

        return redirect('watches');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Watch  $watch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Watch $watch)
    {
        $watch->delete();
    }
}
