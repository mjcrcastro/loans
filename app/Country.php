<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //which table to attach to
    protected $table = 'countries';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description'
    ];
}
