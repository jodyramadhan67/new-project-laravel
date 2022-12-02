<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Phone;
use App\Models\Tablet;
use App\Models\Laptop;
use App\Models\Watch;
use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $total_member = Member::count();
        $total_watch = Watch::count();
        $total_transaction = Transaction::count();
        $total_laptop = Laptop::count();

        // DataDonut
        $data_donut = Watch::selectRaw('count(laptop_id) as total')->groupBy('laptop_id')->orderBy('laptop_id')->pluck('total');
        $label_donut = Laptop::join('watches as b', 'b.laptop_id', '=', 'laptops.id')->groupBy('laptops.id')->orderBy('laptops.id')->pluck('laptops.brand');

        // Data Bar
        $labelBar = ['Pembelian', 'Pengembalian'];
        $dataBar = [];

        foreach ($labelBar as $key => $value) {
            $dataBar[$key]['label'] = $labelBar[$key];
            $dataBar[$key]['backgroundColor'] = $key == 0 ? 'blue' : 'red';
            $dataMonth = [];

            foreach (range(1, 12) as $month) {
                if ($key == 0) {
                    $dataMonth[] = Transaction::selectRaw('count(*) as total')->whereMonth('date_start', $month)->first()->total;
                } else {
                    $dataMonth[] = Transaction::selectRaw('count(*) as total')->whereMonth('date_end', $month)->first()->total;
                }
            }

            $dataBar[$key]['data'] = $dataMonth;
        }

        // Data Pie
        $dataPie = Watch::selectRaw('count(tablet_id) as total')->groupBy('tablet_id')->orderBy('tablet_id')->pluck('total');
        $labelPie = Tablet::join('watches', 'watches.tablet_id', '=', 'tablets.id')->groupBy('tablets.id')->orderBy('tablets.id')->pluck('tablets.brand');

        return view('admin.dashboard', compact('total_member', 'total_watch', 'total_transaction', 'total_laptop', 'data_donut', 'label_donut', 'dataBar', 'labelPie', 'dataPie'));
     }

    // public function catalog()
    // {
    //     $catalogs = Catalog::with('books')->get();

    //     return view('admin.catalog.index', compact('catalogs')); // and also can use ['catalogs' => $catalogs]
    // }

    // public function member()
    // {
    //     return view('admin.member');
    // }

    // public function publisher()
    // {
    //     return view('admin.publisher');
    // }

    // public function author()
    // {
    //     $authors = Author::all();
    //     return view('admin.author', compact('authors'));
    // }

    // public function book()
    // {
    //     $publishers = Publisher::all();
    //     $authors = Author::all();
    //     $catalogs = Catalog::all();

    //     return view('admin.book', compact('publishers', 'authors', 'catalogs'));
    // }

    // public function transaction()
    // {
    //     // if (auth()->user()->role('petugas')) {
    //     //     $transactions = Transaction::with('members')->get();
    //     //     return view('admin.transaction.index', compact('transactions'));
    //     // } else {
    //     //     return abort(403);
    //     // }
    // }

}