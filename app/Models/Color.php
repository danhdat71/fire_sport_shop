<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    /**
     * Table name variable
     * **/
    protected $table = 'colors';

    /**
     * Table properties fillable
     * **/
    protected $fillable = ['id', 'color_code', 'product_id'];

    /**
     * The roles that belong to the Color
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Role::class, 'colors_products_pivot', 'color_id', 'product_id');
    }
}
