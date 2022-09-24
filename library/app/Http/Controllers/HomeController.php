<?php

namespace App\Http\Controllers;

use App\models\transaction;
use App\models\author;
use App\models\catalog;
use App\models\publisher;
use App\models\Book;
use App\models\member;
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
        // $books = Book::with('Publisher')->get();
        // $publisher = Publisher::with('books')->get();
        // $catalog = catalog::with('books')->get();
        // $books = Book::with('catalog')->get();
        // $author = Author::with('books')->get();
        // $books = book::with('author')->get();
        // $books = book::with('author','catalog','publisher')->get();

        // no. 1
        // $data = Member::select('*')
        // ->join('users','users.member_id','=','members.id')
        // ->get();
       
        // no. 2
        // $data2 = Member::select('*')
        // ->leftjoin('users','users.member_id','=','members.id')
        // ->where ('users.id', NULL)
        // ->get();

        // no. 3
        // $data3 = transaction::select('members.id','members.name')
        // ->rightjoin('members','members.id','=','transactions.member_id')
        // ->where ('transactions.member_id', NULL)
        // ->get();

        // no. 4
        // $data4 = Member::select('members.id','members.name','phone_number')
        // ->join ('transactions','transactions.member_id','=','members.id')
        // ->orderby('members.id', 'asc')
        // ->get();

         // no. 5
        //  $data5 = member::select('members.id','members.name','phone_number')
        //  ->join ('transactions','transactions.member_id','=','members.id')
        //  ->groupBy('members.id','asc')
        //  ->having('count(members.name) >', [1] )
        //  ->get();

        //  $data5 = member::table('members')
        //         ->groupBy('members.id','members.name','phone_number')
        //         ->join('transactions','transactions.member_id','=','members.id')
        //         ->having(member::raw('count(members.name)'),'>', 1)
        //         ->get() ;

        // no.5

        // $data5 = Member::select('members.id', 'members.name', 'members.phone_number')
        //     ->join('transactions as t', 'members.id', '=', 't.member_id')
        //     ->groupBy('members.name','members.id','members.phone_number')
        //     ->havingRaw('count(members.id) > 1')
        //     ->get();

        // no.6

        // $data6 = Member::select('members.name','members.address','transactions.date_end','transactions.date_start')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->get();

        // no. 7

        // $data7 = Member::select('members.name','members.phone_number','members.address','transactions.date_end','transactions.date_start')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->whereMonth('transactions.date_end','=', 06)
        // ->get();

         // no. 8
         
        // $data8 = Member::select('members.name','members.address','members.phone_number','transactions.date_start','transactions.date_end')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->whereMonth('transactions.date_start','=', 05)
        // ->get();

        // no. 9

        // $data9 = Member::select('members.name','members.address','members.phone_number','transactions.date_start','transactions.date_end')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->whereMonth('transactions.date_end','=', 06)
        // ->whereMonth('transactions.date_start','=', 06)
        // ->get();

        // no. 10

        // $data10 = Member::select('members.name','members.address','members.phone_number','transactions.date_start','transactions.date_end')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->where('members.address', 'like', '%bandung%')
        // ->get();

        // no. 11

        // $data11 = Member::select('members.name','members.address','members.phone_number','transactions.date_start','transactions.date_end')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->where('members.address', 'like', '%bandung%')
        // ->where('members.gender', 'like', '%F%')
        // ->get();

        // no. 12

        // $data12 = Member::select('members.name','members.address','members.phone_number','transactions.date_start','transactions.date_end','books.isbn','transaction_details.qty')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
        // ->join('books','books.id','=','transaction_details.book_id')
        // ->where('transaction_details.qty','>', 1)
        // ->get();

          // no. 13

        //   $data13 = Member::selectRaw('members.name,members.address,members.phone_number,transactions.date_start,transactions.date_end,books.isbn,(transaction_details.qty * books.price )as total_harga')
        //   ->join('transactions','members.id','=','transactions.member_id')
        //   ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
        //   ->join('books','books.id','=','transaction_details.book_id')
        //   ->get();

          // no. 14

        //   $data14 = Member::select('members.name','members.address','members.phone_number','transactions.date_start','transactions.date_end','books.isbn','transaction_details.qty','books.title','publishers.name','authors.name','catalogs.name')
        // ->join('transactions','members.id','=','transactions.member_id')
        // ->join('transaction_details','transactions.id','=','transaction_details.transaction_id')
        // ->join('books','books.id','=','transaction_details.book_id')
        // ->join('publishers','publishers.id','=','books.publisher_id')
        // ->join('authors','authors.id','=','books.author_id')
        // ->join('catalogs','catalogs.id','=','books.catalog_id')
        // ->get();
        
          // no. 15

        //   $data15 = catalog::select('catalogs.id','catalogs.created_at','catalogs.updated_at','books.title')
        // ->Join('books','catalogs.id','=','books.catalog_id')
        // ->get();
        
        // no. 16

        //   $data16 = book::select('*')
        // ->rightJoin('publishers','books.publisher_id','=','publishers.id')
        // ->get();
       
        // no. 17

        // $data17 = book::selectRaw('books.author_id, count(books.author_id) as jumlah_author')
        // ->groupBy('author_id')
        // ->where('books.author_id','=',5)
        // ->get();
        
        // no. 18

        // $data18 = book::select('*')
        // ->where('price','>',10000)
        // ->get();

        // no. 19

        // $data19 = book::select('*')
        // ->where('publisher_id','=',2)
        // ->where('qty','>',10)
        // ->get();

        // no. 20

        // $data20 = member::select('*')
        // ->whereMonth('created_at','=',06)
        // ->get();

        // return $data20;
        return view('home');
    }
}