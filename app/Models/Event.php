<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'description',
        'date',
        'host_id',
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }
}
