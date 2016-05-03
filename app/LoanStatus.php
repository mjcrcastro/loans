<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
      //which table to attach to
    protected $table = 'loan_statuses';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description'
    ];
}
