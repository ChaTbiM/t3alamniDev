<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //relations
    public function address(){
        return $this->hasOne(Address::class);
    }

    public function module(){
        return $this->hasOne(Module::class);
    }



    public function fixedSessions(){
        return $this->hasMany(FixedSession::class);
    }
}
