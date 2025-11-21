<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $table = 'movies';

    protected $primaryKey = 'movie_id';

    protected $fillable = ['title', 'price', 'release_date', 'synopsis', 'rating_fk', 'cover', 'cover_description'];


    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class, 'rating_fk', 'rating_id');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(
            Genre::class,
            'movies_have_genres',
            'movie_fk',
            'genre_fk',
            'movie_id',
            'genre_id',
        );

    }

}
