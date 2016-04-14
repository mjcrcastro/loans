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
    
    public function getCountryDepartmentAttribute() { 
        //for the naming conventio see: https://laravel.com/docs/5.2/eloquent-mutators#accessors-and-mutators
        return $this->description .'/'.$this->country->description;
    }
}
