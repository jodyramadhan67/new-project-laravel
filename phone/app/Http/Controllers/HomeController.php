<?php

namespace App\Http\Controllers;

use App\Models\Laptop;
use App\Models\Tablet;
use App\Models\Phone;
use App\Models\Member;
use App\Models\Watch;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $members = Member::with('user')->get();
        // $watches = Watch::with('phone')->get();
        // $phones = Phone::with('watches')->get();
        // $tablets = Tablet::with('watches')->get();
        // $laptops = Laptop::with('watches')->get();

        // return $laptops;
        return view('home');
    }
}
