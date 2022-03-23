<?php
namespace App\Services;

use App\Models\Color;

class ColorService
{
    /**
     * Color model variable
     * **/
    protected $color = null;

    /**
     * Constructor
     * **/
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    /**
     * Create color and sycn - unique color
     * @param array $colors
     * @return boolean
     * **/
    public function syncColorProduct(array $colors, $product)
    {
        $colorIDs = [];
        foreach($colors as $item){
            $exist = $this->color->where('color_code', $item)->exists();
            if(!$exist){
                $color = $this->color->create(['color_code' => $item]);
                array_push($colorIDs, $color->id);
            }
        }
        $product->colors()->sync($colorIDs);
        return true;
    }

    /**
     * Update product color
     * @param $colors, $product
     * @return boolean
     * **/
    public function updateProductColor(array $colors, $product)
    {
        $colorIDs = [];
        $colorID  = null;
        foreach($colors as $item){
            $exist = $this->color->where('color_code', $item)->exists();
            (!$exist)
            ? $colorID = ($this->color->create(['color_code' => $item]))->id ?? null
            : $colorID = $this->color->where('color_code', $item)->first()->id ?? null;

            array_push($colorIDs, $colorID);
        }
        $product->colors()->sync($colorIDs);
    }
}