<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Table name
     * **/
    protected $table = 'products';

    /**
     * Table column
     * **/
    protected $fillable = [
        'id',
        'name',
        'url',
        'price_root',
        'price_sale',
        'short_desc',
        'long_desc',
        'image_1',
        'thumb_image_1',
        'image_2',
        'from',
        'category_id',
        'status'
    ];

    /**
     * Get the user that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class, 'colors_products_pivot', 'product_id', 'color_id');
    }

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size_pivot', 'product_id', 'size_id');
    }
}
