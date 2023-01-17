<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Author;
use App\Models\Book;
use App\Models\Catalog;
use App\Models\Member;
use App\Models\Publisher;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $total_member = Member::count();
        $total_book = Book::count();
        $total_transaction = Transaction::count();
        $total_publisher = Publisher::count();

        // DataDonut
        $data_donut = Book::selectRaw('count(publisher_id) as total')->groupBy('publisher_id')->orderBy('publisher_id')->pluck('total');
        $label_donut = Publisher::join('books as b', 'b.publisher_id', '=', 'publishers.id')->groupBy('publishers.id')->orderBy('publishers.id')->pluck('publishers.name');

        // Data Bar
        $labelBar = ['Peminjaman', 'Pengembalian'];
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
        $dataPie = Book::selectRaw('count(author_id) as total')->groupBy('author_id')->orderBy('author_id')->pluck('total');
        $labelPie = Author::join('books', 'books.author_id', '=', 'authors.id')->groupBy('authors.id')->orderBy('authors.id')->pluck('authors.name');

        return view('admin.dashboard', compact('total_member', 'total_book', 'total_transaction', 'total_publisher', 'data_donut', 'label_donut', 'dataBar', 'labelPie', 'dataPie'));
    }

    public function catalog()
    {
        $catalogs = Catalog::with('books')->get();

        return view('admin.catalog.index', compact('catalogs')); // and also can use ['catalogs' => $catalogs]
    }

    public function member()
    {
        return view('admin.member');
    }

    public function publisher()
    {
        return view('admin.publisher');
    }

    public function author()
    {
        $authors = Author::all();
        return view('admin.author', compact('authors'));
    }

    public function book()
    {
        $publishers = Publisher::all();
        $authors = Author::all();
        $catalogs = Catalog::all();

        return view('admin.book', compact('publishers', 'authors', 'catalogs'));
    }

    public function transaction()
    {
        if (auth()->user()->role('petugas')) {
            $transactions = Transaction::with('members')->get();
            return view('admin.transaction.index', compact('transactions'));
        } else {
            return abort(403);
        }
    }

    public function test_spatie()
    {
        // $role = Role::create(['name' => 'petugas']);
        // $permission = Permission::create(['name' => 'index peminjaman']);

        // $role->givePermissionTo($permission);
        // $permission->assignRole($role);

        // $user = auth()->user();
        // $user->assignRole('petugas');
        // return $user;

        // $user = User::with('roles')->get();
        // return $user;

        // $user = User::where('id', 2)->first();
        // $user->removeRole('petugas');
    }
}