<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $table = 'movies';

    public $fillable = [
        'id', 'user_id', 'title',  'overview', 'poster_path', 'backdrop_path', 'release_date'
    ];
}
