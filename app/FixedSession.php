<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixedSession extends Model
{
    protected $fillable = [
        'type',
        'state',
        'time',
        'date',
        'duration',
        'group_id',
        'teacher_id',
        'id',
        'mark'
    ];
    //relations
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
