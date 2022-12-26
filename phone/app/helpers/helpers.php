<?php

use App\Models\Member;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

	function convert_date($value) {
		return date('d M Y - H:i:s', strtotime($value));
	}

	function convert_date2($value) {
		return date('d M Y', strtotime($value));
	}

	function keterlambatan() {
		$transactions = Transaction::select('*', DB::raw("DATEDIFF(date_format(now(), '%Y-%m-%d'), date_end) as selisih"))
		->with('members')
		->whereRaw("date_end < date_format(now(), '%Y-%m-%d')")
		->where('status', '=', 2)
		->orderBy('date_end', 'desc')
		->get();

		return $transactions;
	}

	function totalKeterlambatan() {
	    return count(keterlambatan());
	}

?>