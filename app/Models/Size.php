<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    /**
     * Table name variable
     * **/
    protected $table = 'sizes';

    /**
     * Table column array
     * **/
    protected $fillable = ['id', 'name'];

    /**
     * The roles that belong to the Size
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_size_pivot', 'size_id', 'product_id');
    }
}
