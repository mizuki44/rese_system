<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'area',
    ];
    public function scopeAreaSearch($query, $area)
    {

        if (!empty($area)) {
            $query->where('area', $area);
        }
    }

   

}
