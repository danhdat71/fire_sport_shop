<?php

namespace App\Services;

use App\Models\Size;

class SizeService
{
    /**
     * Size model variable
     * **/
    private $size;

    /**
     * Constructor
     * **/
    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    /**
     * Get all sizes
     * @param null
     * @return $sizes
     * **/
    public function getAll()
    {
        return $this->size->all();
    }

    /**
     * Sync product and size into trivot
     * 
     * @param array $sizes
     * @param object $product
     * @return void
     * **/
    public function syncProductSize($sizes, $product)
    {
        $product->sizes()->sync($sizes);
    }
}