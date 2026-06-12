<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sankalp extends Model
{
    protected $fillable = ['user_id', 'title', 'duration_days', 'start_date', 'is_active'];

    protected $casts = [
        'start_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkins()
    {
        return $this->hasMany(SankalpCheckin::class);
    }
}
