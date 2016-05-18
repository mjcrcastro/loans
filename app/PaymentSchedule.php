<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSchedule extends Model
{
    //
    protected $fillable = [
        'loan_id', 'scheduled_date', 'p_value', 'i_value'
    ];
}
