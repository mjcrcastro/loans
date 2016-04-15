<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //which table to attach to
    protected $table = 'contacts';
    
    //which field are used for mass assigment
    protected $fillable = [
        'name', 'first_lastname', 'second_lastname','birthdate',
        'identification','municipality_id','address','phones',
        'occupation_id','picture','email','taxid', 'employer_id',
        'notes'
    ];
    
    //relationship with munitipalities
    public function municipality() {
        return $this->belongsTo('App\Municipality');
    }
    
    public function getFullNameAttribute() { 
        //for the naming convention see: https://laravel.com/docs/5.2/eloquent-mutators#accessors-and-mutators
        return $this->name .' '.
               $this->first_lastname.' '.
               $this->second_lastname.'/'.
               $this->identification;
    }
}
