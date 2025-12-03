<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $fillable = ['name', 'ticket_price', 'date', 'description', 'rating_fk', 'cover', 'cover_description'];


    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'events_have_categories',
            'event_fk',
            'category_fk',
            'event_id',
            'category_id',
        );

    }

}
