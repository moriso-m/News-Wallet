<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //mass assignable fields
    public $fillable = ['type', 'description','user_id'];

    // create relation between category and article
    public function articles(){

        return $this->hasMany('App\Model\Article');
    }

    // categories belong to a certain user
    public function user(){

        return $this->belongsTo('App\User');
    }
}
