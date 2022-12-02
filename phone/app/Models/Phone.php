<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['brand','type','imei', 'spec'];
    
    public function watches()
    {
    	return $this->hasMany('App\Models\Watch', 'phone_id');
    }
}
