<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        // 'name',
        'area',
        // 'genre',
        // 'description',
        // 'image_url',
        // 'operation_pattern',
        // 'time_per_reservation'
    ];
    public function scopeAreaSearch($query, $area)
    {

        if (!empty($area)) {
            $query->where('area', $area);
        }
    }

   

}
