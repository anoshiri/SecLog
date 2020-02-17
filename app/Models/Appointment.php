<?php

namespace App\Models;

use App\Scopes\TeamScope;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    public function scopeHasVisited() {
        return $this->where('status', 1);
    }

    public function scopeIsPending() {
        return $this->where('status', 0);
    }
    
    protected $casts = [
        'date_time' => 'timestamp'
    ];


    public function getFullNameAttribute() 
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function employee ()
    {
        return $this->belongsTo(Employee::class);
    }

    //
    protected $fillable = ['first_name', 'last_name', 'address', 'employee_id', 'number_of_persons', 'date_time'];


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
