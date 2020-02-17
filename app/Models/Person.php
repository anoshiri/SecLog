<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    //
    protected $fillable = [
        'transit_id', 'name', 'address', 'host', 'phone', 'vehicle_number', 'tag', 'items', 'exit_items', 'exit_vehicle', 'exited_at'
    ];

    protected $casts = [
        'exited_at' => 'timestamp'
    ];

    /**
     * Scope a query to only include visitors whos have not exited.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeExited($query)
    {
        return $query->where('status', 1);
    }


    /**
     * Scope a query to only include visitors whos have not exited.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotExited($query)
    {
        return $query->where('status', 0);
    }
}

