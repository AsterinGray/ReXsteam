<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_preview',
        'trailer_video',
        'description',
        'long_description',
        'genre_id',
        'release_date',
        'developer',
        'publisher',
        'for_adult',
        'price'
    ];

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function transactions() {
        return $this->belongsTo(TransactionDetail::class);
    }
}
