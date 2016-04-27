<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
     //which table to attach to
    protected $table = 'loans';
    
    //which field are used for mass assigment
    protected $fillable = [
        'contact_id','approval_date','fund_id','loan_category_id',
        'guarantor_id','loan_status_id','principal','term','loan_rate',
        'late_fee','contract_URL'
    ];
    
    //relationship with munitipalities
    public function municipality() {
        return $this->belongsTo('App\Contact');
    }
    
    public function getFullNameAttribute() { 
        //for the naming convention see: https://laravel.com/docs/5.2/eloquent-mutators#accessors-and-mutators
        return $this->name .' '.
               $this->first_lastname.' '.
               $this->second_lastname.'/'.
               $this->identification;
    }
}
