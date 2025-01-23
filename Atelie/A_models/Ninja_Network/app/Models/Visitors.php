<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\ActiveScope;

class Visitors extends Model
{
            //1-GLOBAL SCOPE

    // protected static function booted()
    // {
    //     static::addGlobalScope(new ActiveScope());
    // }

            //2-QUERY SCOPES

            //2.1-local scope

    // public function scopeStatus($query)
    // {
    //     return $query->where('active', 1);
    // }

    // public function scopeAge($query) 
    // {
    //     return $query->where('age', '<', 18);
    // }

          //2.2-dynamic scope

    // public function scopeOfAge($query, $age) 
    // {
    //     return $query->where('age', $age);
    // }
}