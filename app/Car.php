<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'brand', 'model', 'color', 'owner_id', 'plate', 'image'];

    public function owner(){

    	return $this->belongsTo('App\Owner');
    }
}
