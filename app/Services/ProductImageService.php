<?php

namespace App\Services;

use App\Traits\HelpTraits;
use App\Models\ProductImage;
use App\Constants\ImageConstant;

class ProductImageService
{
    use HelpTraits;

    /**
     * Product model variable
     * 
     * @param $product
     * **/
    protected $productImage = null;

    /**
     * Constructor function
     * **/
    public function __construct(ProductImage $productImage)
    {
        $this->productImage = $productImage;
    }

    /**
     * List product images
     * 
     * @param $productID
     * **/
    public function list($productID)
    {
        return $this->productImage->where('product_id', $productID)->get();
    }

    /**
     * Store image
     * @param $productID, $file
     * @return boolean
     * **/
    public function store($productID, $images)
    {
        foreach($images as $image){
            # Storage image
            $path = $this->savePublicImage(
                $image,
                "productImages",
                ImageConstant::PRODUCT_IMAGE,
                100,
                true, # is genegrate thumb image
                false # is genegrate blur thumb image
            );
            # Storage link
            $this->productImage->create([
                'thumb_image' => $path['thumb_image'],
                'big_image' => $path['big_image'],
                'status' => true,
                'product_id' => $productID
            ]);
        }
        
        return true;
    }

    public function destroy($id)
    {
        $productImage = $this->productImage->find($id);
        #Delete image
        $thumb = "image/productImages/" . $productImage->thumb_image;
        $big = "image/productImages/" . $productImage->big_image;
        $this->deleteImage([$thumb, $big]);
        #Delete record
        $productImage->delete();

        return true;
    }
}