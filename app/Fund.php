<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
     //which table to attach to
    protected $table = 'funds';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description'
    ];

}