<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;
use App\Models\Tablet;
use App\Models\Laptop;
use App\Models\Watch;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WatchController extends Controller
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
        $phones = Phone::all();
        $tablets = Tablet::all();
        $laptops = Laptop::all();
        return view('admin.watch', compact('phones','tablets','laptops'));
    }

    public function api()
    {
        $watches = Watch::all();
        foreach ($watches as $watch) {
            $watch->date = convert_date($watch->created_at);
        }

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
        // $this->validate($request, [
        //     'series' => ['required', Rule::unique('watches', 'series'), 'max:11'],
        //     'type' => ['required', 'max:64'],
        //     'year' => ['required', 'max:4'],
        //     'phone_id' => ['required'],
        //     'tablet_id' => ['required'],
        //     'laptop_id' => ['required'],
        //     'qty' => ['required', 'max:11'],
        //     'price' => ['required', 'max:11']

        // ]);

        $watch = new Watch;
        $watch->series = $request->series;
        $watch->type = $request->type;
        $watch->year = $request->year;
        $watch->phone_id = $request->phone_id;
        $watch->tablet_id = $request->tablet_id;
        $watch->laptop_id = $request->laptop_id;
        $watch->qty = $request->qty;
        $watch->price = $request->price;
        $watch->save();

        return redirect('watches');

        // $this->validate($request,[
        //     'series'  => ['required'],
        //     'type'  => ['required'],
        //     'year'  => ['required'],
        //     'phones_id'=>['required'],
        //     'tablet_id'=>['required'],
        //     'laptop_id'=>['required'],
        //     'qty'  => ['required'],
        //     'price'  => ['required'],
        // ]);
        
        // Watch::create($request->all());

        // return redirect('watches');
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
        // $this->validate($request, [
        //     'series' => ['required', Rule::unique('watches', 'series')->ignore($watch->id, 'id'), 'max:11'],
        //     'type' => ['required', 'max:64'],
        //     'year' => ['required', 'max:4'],
        //     'phone_id' => ['required'],
        //     'tablet_id' => ['required'],
        //     'laptop_id' => ['required'],
        //     'qty' => ['required', 'max:11'],
        //     'price' => ['required', 'max:11']

        // ]);

        $watch = Watch::find($watch->id);
        $watch->series = $request->series;
        $watch->type = $request->type;
        $watch->year = $request->year;
        $watch->phone_id = $request->phone_id;
        $watch->tablet_id = $request->tablet_id;
        $watch->laptop_id = $request->laptop_id;
        $watch->qty = $request->qty;
        $watch->price = $request->price;
        $watch->save();

        return redirect('watches');

        // $this->validate($request,[
        //     'series'  => ['required'],
        //     'type'  => ['required'],
        //     'year'  => ['required'],
        //     'phones_id'=>['required'],
        //     'tablet_id'=>['required'],
        //     'laptop_id'=>['required'],
        //     'qty'  => ['required'],
        //     'price'  => ['required'],
        // ]);
        
        // $watch->update($request->all());

        // return redirect('watches');
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
