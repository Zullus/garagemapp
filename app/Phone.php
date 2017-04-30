<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'number', 'type', 'company', 'owner_id'];

    public function owner(){

    	return $this->belongsTo('App\Owner');
    }
}
