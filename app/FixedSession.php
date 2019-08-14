<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedSession extends Model
{
    //relations
    public function documents(){
        return $this->hasMany(Document::class);
    }
}
