<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'title', 'description', 'author'
    ];

    protected $dates = [];

    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'author' => 'required',
    ];
}
