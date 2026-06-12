<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SankalpCheckin extends Model
{
    protected $fillable = ['sankalp_id', 'checkin_date', 'is_completed'];

    protected $casts = [
        'checkin_date' => 'date',
        'is_completed' => 'boolean',
    ];

    public function sankalp()
    {
        return $this->belongsTo(Sankalp::class);
    }
}
