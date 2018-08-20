<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table name
    protected $table = 'posts';

    //Primary key
    public $primaryKey = 'id';

    // Timestamps
    public $timestamps = true; 

    // This piece of code forms a relationship between the User Model.
    // This Post BELONGS TO one User, whereas a User HAS MANY Posts.
    public function user(){ 
        return $this->belongsTo('App\User');
    }
}
