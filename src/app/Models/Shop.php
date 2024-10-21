<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use DB;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'area_id',
        'genre_id',
        'description',
        'image_url',
    ];

    const RANDOM = '0';
    const ORDER_HIGHER = '1';
    const ORDER_LOWER = '2';
    const RANDOM_NAME = 'ランダム';
    const ORDER_HIGHER_NAME = '評価が高い順';
    const ORDER_LOWER_NAME = '評価が低い順';
    const SORT_LIST = [
        self::RANDOM => self::RANDOM_NAME,
        self::ORDER_HIGHER => self::ORDER_HIGHER_NAME,
        self::ORDER_LOWER => self::ORDER_LOWER_NAME
    ];

    public function scopeNameSearch($query, $name)
    {
        if (!empty($name)) {
            $query->where('name', 'like', '%' . $name . '%');
        }
    }

    public function scopeAreaSearch($query, $area)
    {
        if (!empty($area)) {
            $query->where('area', $area);
        }
    }

    public function scopeGenreSearch($query, $genre)
    {
        if (!empty($genre)) {
            $query->where('genre', $genre);
        }
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area');
    }

    public function genre()
    {
        return $this->belongsTo('App\Models\Genre');
    }

    public function scopeSortReview($query, $sort_option)
    {
        if ($sort_option === self::ORDER_HIGHER) {
            $query->leftjoin('reviews', 'reviews.shop_id', '=', 'shops.id')
            ->select('shops.*')
            ->selectRaw('avg(reviews.star) as avg_star')
            ->groupBy('shops.id')
            ->orderByDesc('avg_star');
        } elseif ($sort_option === self::ORDER_LOWER) {
            $query->leftjoin('reviews', 'reviews.shop_id', '=', 'shops.id')
            ->select('shops.*')
            ->selectRaw('avg(reviews.star) as avg_star')
            ->groupBy('shops.id')
            ->orderBy('avg_star');
        }
        return $query;
    }
}
