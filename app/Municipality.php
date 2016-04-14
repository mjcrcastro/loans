<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //which table to attach to
    protected $table = 'municipalities';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description','department_id'
    ];
    
    public function department() {
        return $this->belongsTo('App\Department');
    }
    
    public function getCountryDepartmentMunicipalityAttribute() { 
        //for the naming conventio see: https://laravel.com/docs/5.2/eloquent-mutators#accessors-and-mutators
        return $this->description .'/'.
                $this->department->description.'/'.
                $this->department->country->description;
    }
    
}
