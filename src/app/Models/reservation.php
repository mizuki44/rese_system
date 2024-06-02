<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'time',
        'number',
    ];



    public function user()
    { //追記
        return $this->belongsTo('App\Models\User');
    }

    public function shop()
    { //追記
        return $this->belongsTo('App\Models\Shop');
    }
}
