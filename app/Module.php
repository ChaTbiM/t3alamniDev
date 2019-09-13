<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Group;

class Module extends Model
{
    //
    public function groups()
    {
        return $this->belongsToMany('App\Group', 'module_groups');
    }
}
