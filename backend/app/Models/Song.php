<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['album_id','genre_id','title','duration','audio_path'];

    // Relation
    public function album() { return $this->belongsTo(Album::class); }
    public function genre() { return $this->belongsTo(Genre::class); }

    // Auto-accessor untuk frontend
    protected $appends = ['audio_url'];

    public function getAudioUrlAttribute()
    {
        return asset('storage/' . $this->audio_path);
    }
}