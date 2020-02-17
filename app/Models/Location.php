<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'user_id', 'team_id', 'status'
    ];

    public function scopeIsActive($query) 
    {
        return $query->where('status', '>', 0);
    }
    

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TeamScope);
        static::observe(new \App\Observers\TeamObserver);
        static::observe(new \App\Observers\UserObserver);
    }
}
