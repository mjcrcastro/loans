<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    protected $table = 'occupations';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description'
    ];
}
