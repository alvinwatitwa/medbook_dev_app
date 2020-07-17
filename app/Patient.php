<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'name', 'dob' ,'gender_id', 'service_id'
    ];


    public function gender(){
       return $this->belongsTo('App\Gender');
    }

    public function service()
    {
      return $this->belongsTo('App\Service');
    }
}
