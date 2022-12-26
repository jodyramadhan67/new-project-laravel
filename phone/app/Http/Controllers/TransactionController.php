<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use App\Models\Member;
use DB;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::select('transactions.id', 'date_start', 'date_end', 'name', DB::raw("DATEDIFF(date_end, date_start) as lama_pinjam"), 'status')
        ->join('members', 'members.id', '=', 'transactions.member_id')
        ->get();

        foreach ($transactions as $key => $transaction) {
            $transaction->details - DB::table('transaction_details')
                                        ->select('price', 'transaction_details.qty', DB::raw("price'transaction_details.qty as total_bayar"))
                                        ->where('transaction_id', $transaction->id)
                                        ->join('watches', 'watches.id', '=', 'transaction_details.watch_id')
                                        ->get();
            $transaction->total_watch = $transaction->details->count();
        }
        // return $transactions;
    }
    public function api(Request $request)
    {

        // // filter only one
        // if ($request->status) {
        //     $transactions = Transaction::with('books', 'members')->where('status', '=', $request->status - 1)->get();
        // } else if ($request->date) {
        //     $transactions = Transaction::with('books', 'members')->whereDate('date_start', '=', $request->date)->get();
        // } else {
        //     $transactions = Transaction::with('books', 'members')->get();
        // }

        // filter in the same time
        if ($request->status && $request->date) {
            $transactions = Transaction::with('watches', 'members')->where('status', '=', $request->status - 1)->whereDate('date_start', '=', $request->date)->get();
        } else if ($request->status) {
            $transactions = Transaction::with('watches', 'members')->where('status', '=', $request->status - 1)->get();
        } else if ($request->date) {
            $transactions = Transaction::with('watches', 'members')->whereDate('date_start', '=', $request->date)->get();
        } else {
            $transactions = Transaction::with('watches', 'members')->get();
        }

        $total = [];

        foreach ($transactions as $keyTx => $transaction) {
            $start = Carbon::parse($transaction->date_start);
            $end = Carbon::parse($transaction->date_end);
            $transaction->loanPeriod = $start->diffInDays($end);
            $transaction->totalWatch = count($transaction->watches);
            $transaction->dateStartFormat = dateFormatDays($transaction->date_start);
            $transaction->dateEndFormat = dateFormatDays($transaction->date_end);

            foreach ($transaction->watches as $keyWatch => $watch) {
                $total[$keyWatch] = $watch->price * $watch->pivot->qty;
            }
            $transaction->totalPayment = array_sum($total);
            $total = [];

            $transaction->urlButton = '<a href="' . route('transactions.show', $transaction->id) . '" class="btn btn-info btn-sm">Details</a>
            <form action="' . route('transactions.destroy', $transaction->id) . '" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" value="Delete" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure for delete this one?`)">
            ' . csrf_field() . '
            </form>';
        }

        $datatables = datatables()->of($transactions)->addIndexColumn();

        return $datatables->rawColumns(['urlButton'])->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = Member::all();
        $watches = Watch::where('qty', '!=', '0')->get();
        return view('admin.transaction.create', compact('members', 'watches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'member_id' => ['required'],
            'date_start' => ['required', 'before:date_end'],
            'date_end' => ['required'],
            'watches' => ['required', 'array', 'min: 1'],
            'status' => ['required', 'boolean']

        ]);

        $data = $request->all();
        $data['status'] = intval($data['status']);

        $transaction = Transaction::create($data);
        $transaction->watches()->attach($request->watches, ['qty' => 1]);

        foreach ($request->watches as $watchArray) {
            lessWatchQty($watchArray);
        }

        return redirect()->back()->with('success', 'Data has been saved');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $transaction = Transaction::with('watches', 'members')->findOrFail($transaction->id);
        return view('admin.transaction.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
         // Redirect ketika status sudah dikembalikan
         if ($transaction->status) {
            return redirect('transactions/' . $transaction->id . '');
        }

        $members = Member::all();
        $watches = Watch::where('qty', '!=', '0')->get();
        $transaction = Transaction::with('watches', 'members')->findOrFail($transaction->id);

        $watchId = [];
        foreach ($transaction->watches as $key => $watch) {
            $watchId[$key] = $watch->id;
        }
        return view('admin.transaction.edit', compact('transaction', 'members', 'watches', 'watchId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $this->validate($request, [
            'member_id' => ['required'],
            'date_start' => ['required', 'before:date_end'],
            'date_end' => ['required'],
            'watches' => ['required', 'array', 'min: 1'],
            'status' => ['required', 'boolean']

        ]);
        $arrayOfWatches = [];

        $data = $request->all();
        $data['status'] = intval($data['status']);

        $transactions = Transaction::with('watches')->findOrFail($transaction->id);

        // Get ID of Array in Books Transaction
        foreach ($transactions->watches as $key => $watchArray) {
            $arrayOfWatches[$key] = $watcheArray->id;
        }


        // When Request Status 0 / Belum dikembalikan
        if (!$request->status) {
            // Update Data to DB
            $transaction->watches()->detach($arrayOfWatches);
            $transaction->watches()->attach($request->watches, ['qty' => 1]);
            $transaction->update($data);


            // Update Transaksi buku yang akan diEdit
            // Transaksi Buku Awal
            foreach ($arrayOfWatches as $watchArray) {
                addWatchQty($watchArray);
            }

            // Transaksi Buku Setelah di Edit
            foreach ($data['watches'] as $watchArray) {
                lessWatchQty($watchArray);
            }

            return redirect()->back()->with('success', 'Data has been Updated');
        }

        // When Status 1 / Sudah dikembalikan

        // When Update, but old data book not same with new update data will be error
        if (!($arrayOfWatches == $request->watches)) {
            return redirect()->back()->with('error', 'Data watch tidak boleh diubah kalau status sudah dikembalikan');
        }

        $transaction->update($data);

        // Success update, Add Qty Books
        foreach ($data['watches'] as $watchArray) {
            addWatchQty($watchArray);
        }

        return redirect('transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
         // Only delete data  when status sudah dikembalikan
         if ($transaction->status) {

            // Delete Data Transaction
            $transaction->delete();

            return redirect()->back();
        }

        $arrayOfWatches = [];

        $transactions = Transaction::with('watches')->findOrFail($transaction->id);

        // Get ID Array of Books
        foreach ($transactions->watches as $key => $watchArray) {
            $arrayOfWatches[$key] = $watchArray->id;
        }

        // Delete Data in Table Transaction Details
        $transaction->watches()->detach($arrayOfWatches);

        // Delete Data Transaction
        $transaction->delete();

        // Get update the quantity of book
        foreach ($arrayOfWatches as $watchArray) {
            addWatchQty($watchArray);
        }

        return redirect()->back();
    
    }
}
