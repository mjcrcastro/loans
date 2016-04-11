<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //which table to attach to
    protected $table = 'contacts';
    
    //which field are used for mass assigment
    protected $fillable = [
        'name', 'first_lastname', 'second_lastname','birthdate','identification'
    ];
}
