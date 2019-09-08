<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    //
    protected $fillable = [
        'title',
        'url',
        'simple_session_id',
        'fixed_session_id'
    ];
}
