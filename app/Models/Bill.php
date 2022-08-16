<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'id',
        'code',
        'user_id',
        'note',
        'town_id',
        'address',
        'phone',
        'name'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'bill_product_pivot', 'bill_id', 'product_id')->withPivot(['amount', 'price_sale', 'color_code', 'size']);
    }

    public function town()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }
}
