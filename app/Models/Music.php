<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "artist",
        "image_path",
        "music_path",
        "album_id"
    ];

    public function album():BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
