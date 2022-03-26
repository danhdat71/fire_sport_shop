<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * Database table name
     * **/
    protected $table = 'product_images';

    /**
     * Database table columns
     * **/
    protected $fillable = ['id', 'thumb_image', 'big_image', 'status', 'product_id'];

    /**
     * Get the user that owns the ProductImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
