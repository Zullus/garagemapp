<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owner extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['id','name','address','sector','payday','value','obs', 'timetable'];

    public function cars(){

    	return $this->hasMany('App\Car');
    }

    public function phones(){

    	return $this->hasMany('App\Phone');
    }

    public function payments(){

    	return $this->hasMany('App\Payment');
    }
}
