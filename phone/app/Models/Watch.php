<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;

    protected $fillable = ['series','type','year','puhones_id','tablet_id','laptop_id','qty','price'];

    public function Phone()
    {
        return $this->belongsTo('App\Models\Phone', 'id');

    }

    public function Tablet()
    {
        return $this->belongsTo('App\Models\Tablet', 'id');

    }
    
    public function Laptop()
    {
        return $this->belongsTo('App\Models\Laptop', 'id');

    }
    public function Transaction()
    {
        return $this->belongsToMany('App\Models\Transaction', 'transaction_details');
    }
}
