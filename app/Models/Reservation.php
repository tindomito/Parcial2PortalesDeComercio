<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $primaryKey = 'reservation_id';

    protected $fillable = ['event_fk', 'user_fk', 'quantity', 'total_price', 'status'];


    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_fk', 'event_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_fk', 'id');
    }
}
