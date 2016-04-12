<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //which table to attach to
    protected $table = 'departments';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description','country_id'
    ];
    
    public function country() {
        return $this->belongsTo('App\Country');
    }
}
