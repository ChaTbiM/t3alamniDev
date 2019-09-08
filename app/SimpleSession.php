<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpleSession extends Model
{
    protected $fillable = [
        'type',
        'state',
        'subject',
        'cycle',
        'specialty',
        'year',
        'description',
        'date',
        'time',
        'duration',
        'nb_places',
        'price',
        'mark',
        'end_registration',
        'teacher_id'
    ];
    //relations
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function subject()
    {
        return $this->hasOne(Subject::class);
    }

    public function module()
    {
        return $this->hasOne(Module::class);
    }
}
