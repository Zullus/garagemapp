<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['id' , 'owner', 'payment_date', 'amount'];

    public function owner(){

    	return $this->belongsTo('App\Owner');
    }
}
