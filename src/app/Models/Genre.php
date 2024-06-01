<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        // 'name',
        // 'area',
        'genre',
        // 'description',
        // 'image_url',
        // 'operation_pattern',
        // 'time_per_reservation'
    ];
    public function scopeGenreSearch($query, $genre)
    {
        if (!empty($genre)) {
            $query->where('genre', $genre);
        }
    }

   
}
