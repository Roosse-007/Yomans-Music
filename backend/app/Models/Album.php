<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'title',
        'artist_id',
        'release_year',
        'cover'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function getCoverUrlAttribute()
    {
        return $this->cover
            ? asset('storage/'.$this->cover)
            : null;
    }
}

