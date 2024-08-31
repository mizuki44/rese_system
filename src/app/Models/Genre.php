<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'genre',
    ];
    public function scopeGenreSearch($query, $genre)
    {
        if (!empty($genre)) {
            $query->where('genre', $genre);
        }
    }

   
}
