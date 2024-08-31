<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
    { //追記
        return $this->belongsTo('App\Models\Area');
    }

    public function genre()
    { //追記
        return $this->belongsTo('App\Models\Genre');
    }
    // public function admins(): BelongsToMany
    // {
    //     return $this->belongsToMany(Admin::class);
    // }

    // public function reviews()
    // {
    //     return $this->hasMany(Review::class);
    // }
}
