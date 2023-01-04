<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'transaction_id', 'watch_id', 'qty'];

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction','transaction_id');
    }

    public function watch()
    {
        return $this->belongsTo('App\Models\Watch','watch_id');
    }
}
