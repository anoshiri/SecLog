<?php

namespace App\Models;

use App\Models\Location;
use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    public function location () 
    {
        return $this->belongsTo(Location::class);
    }

    

    public function scopeIsActive($query) 
    {
        return $query->where('status', '>', 0);
    }



    public function getFullNameAttribute() 
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    //
    protected $fillable = [
        'first_name', 'last_name', 'department', 'email', 'phone', 'status', 'location_id', 'team_id'
    ];

    protected $appends = [
        'full_name'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TeamScope);
        static::observe(new \App\Observers\TeamObserver);
        static::observe(new \App\Observers\UserObserver);
    }
}
