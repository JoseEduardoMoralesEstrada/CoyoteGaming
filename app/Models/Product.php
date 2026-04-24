<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
        'platform',
        'genre',
        'sales_count',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%$term%")
                     ->orWhere('description', 'like', "%$term%");
    }

    public function scopeBestSellers($query, $limit = 10)
    {
        return $query->orderBy('sales_count', 'desc')->limit($limit);
    }
}