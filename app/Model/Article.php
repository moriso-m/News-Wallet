<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //mass assignable fields
    public $fillable =['title', 'image', 'website', 'author', 'meta-description', 'category_id','user_id'];

    // establish one to many relation
    public function category(){

        return $this->belongsTo('App\Model\Category');
    }

    // relationship between user and article : one to many
    public function user(){

        return $this->belongsTo('App\User');
    }
}
