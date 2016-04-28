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
    
    
    public function loanBorrower() {
        return $this->belongsTo('App\Contact','borrower_id');
    }
    
    public function loanGurarantor() {
        return $this->belongsTo('App\Contact','guarantor_id');
    }
    
    public function loanAgent() {
        return $this->belongsTo('App\Contact','agent_id');
    }
    
    public function getCountryDepartmentAttribute() { 
        //for the naming conventio see: https://laravel.com/docs/5.2/eloquent-mutators#accessors-and-mutators
        return $this->description .'/'.$this->country->description;
    }
    
}
