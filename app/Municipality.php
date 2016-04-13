<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    //which table to attach to
    protected $table = 'municipalities';
    
    //which field are used for mass assigment
    protected $fillable = [
        'description','department_id'
    ];
    
    public function department() {
        return $this->belongsTo('App\Department');
    }
}
