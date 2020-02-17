<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class Transit extends Model
{
    //
    protected $fillable = [
        'type_id', 'user_id', 'team_id', 'appointment_id'
    ];


    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type_id', $type);
    }



    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TeamScope);
        static::observe(new \App\Observers\TeamObserver);
        static::observe(new \App\Observers\UserObserver);
    }
}
