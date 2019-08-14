<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleSession extends Model
{
    //relations
    public function address(){
        return $this->hasOne(Address::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function subject(){
        return $this->hasOne(Subject::class);
    }

    public function module(){
        return $this->hasOne(Module::class);
    }
}
