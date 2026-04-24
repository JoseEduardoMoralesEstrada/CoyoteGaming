<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function subtotal(): float
    {
        return $this->items->sum(fn($item) => $item->product->price * $item->quantity);
    }

    public function tax(): float
    {
        return round($this->subtotal() * 0.16, 2);
    }

    public function total(): float
    {
        return $this->subtotal() + $this->tax();
    }
}