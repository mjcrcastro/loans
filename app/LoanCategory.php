<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanCategory extends Model
{
      //which table to attach to
    protected $table = 'loan_categories';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description'
    ];
}
