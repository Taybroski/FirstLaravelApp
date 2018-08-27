<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    // Table name
    protected $table = 'profiles';

    //Primary key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true; 


    public function user(){
        return $this->belongsTo('App\User');
    }
}
