<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'home_id',
        'bill_type',
        'amount',
        'month',
        'generated_by',
        'status'
    ];

    // Define relationships if needed
    public function home()
    {
        return $this->belongsTo(Home::class, 'home_id');
    }

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}
