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
        'visited_flg'
    ];



    public function user()
    { //追記
        return $this->belongsTo('App\Models\User');
    }

    public function shop()
    { //追記
        return $this->belongsTo('App\Models\Shop');
    }





    public function scopeEndsAfterSearch($query, $time)
    {
        if (!empty($time)) {
            $query->where('date', '>=', $time);
        }
    }

    // public function scopeStartsBeforeSearch($query, $time)
    // {
    //     if (!empty($time)) {
    //         $query->where('date', '<', $time);
    //     }
    // }

    public function scopeUserIdSearch($query, $user_id)
    {
        if (!empty($user_id)) {
            $query->where('user_id', $user_id);
        }
    }
}
