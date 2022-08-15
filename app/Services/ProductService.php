<?php

namespace App\Services;

use App\Traits\HelpTraits;
use App\Models\Product;
use App\Models\Color;
use App\Constants\AppConstant;
use App\Constants\ImageConstant;
use App\Services\ColorService;
use App\Services\SizeService;

class ProductService
{
    use HelpTraits;

    /**
     * Product model variable
     * **/
    protected $product = null;
    protected $colorService = null;
    protected $sizeService = null;

    /**
     * Constructor function
     * **/
    public function __construct(
        Product $product,
        ColorService $colorService,
        SizeService $sizeService
    ){
        $this->product = $product;
        $this->colorService = $colorService;
        $this->sizeService = $sizeService;
    }

    /**
     * List product
     * **/
    public function list($requestData)
    {
        $keyword = (isset($requestData['keyword'])) ? $requestData['keyword'] : null;
        $orderBy = (isset($requestData['order_by'])) ? explode("|", $requestData['order_by']) : [];
        $category = (isset($requestData['category'])) ? $requestData['category'] : null;

        $list = $this->product
            ->when(isset($keyword), function($q) use($keyword){
                $q->where('name', 'like', "%".$keyword."%");
            })
            ->when(count($orderBy) > 0, function($q) use($orderBy){
                $q->orderBy($orderBy[0], $orderBy[1]);
            })
            ->when($category, function($q) use($category){
                $q->where('category_id', $category);
            })
            ->withCount('productImages')
            ->orderBy('created_at', 'DESC')
            ->paginate(AppConstant::PAGINATE);

        return [
            'list' => $list,
            'keyword' => $keyword,
            'category' => $category,
            'orderBy' => $requestData['order_by'] ?? null
        ];
    }

    /**
     * Store product
     * 
     * @param $requestData, $file
     * @return boolean
     * **/
    public function store($requestData, $imageOne, $imageTwo)
    {
        $colors = explode(",", $requestData['colors']) ?? [];
        # Storage image 1
        $path = $this->savePublicImage(
            $imageOne, "products",
            ImageConstant::PRODUCT,
            100,
            true, # is genegrate thumb image
            false # is genegrate blur thumb image
        );
        $requestData['big_image_1'] = $path['big_image'];
        $requestData['thumb_image_1'] = $path['thumb_image'];
        # Storage image 2
        if($imageTwo){
            $path = $this->savePublicImage(
                $imageTwo,
                "products",
                ImageConstant::PRODUCT,
                80,
                false, # is genegrate thumb image
                false # is genegrate blur thumb image
            );
            $requestData['big_image_2'] = $path['big_image'];
        }
        # Create product
        $product = $this->product->create([
            'name'          => $requestData['name'],
            'url'           => $requestData['url'],
            'price_sale'    => $requestData['price_sale'],
            'price_root'    => $requestData['price_root'] ?? null,
            'short_desc'    => $requestData['short_desc'] ?? null,
            'long_desc'     => $requestData['long_desc'] ?? null,
            'image_1'       => $requestData['big_image_1'],
            'thumb_image_1' => $requestData['thumb_image_1'],
            'image_2'       => $requestData['big_image_2'] ?? null,
            'from'          => $requestData['from'] ?? null,
            'category_id'   => $requestData['category_id'],
            'status'        => $requestData['status'] ?? 0,
        ]);
        # Store color
        $this->colorService->syncColorProduct($colors, $product);
        # Store size service
        $this->sizeService->syncProductSize($requestData['sizes'], $product);

        return true;
    }

    /**
     * Show product service
     * **/
    public function show($id)
    {
        $data = $this->product->where('id', $id)
            ->with('colors')
            ->with('sizes')
            ->first();

        return $data;
    }

    /**
     * Update product
     * 
     * @param $requestData, $file
     * @return boolean
     * **/
    public function update($requestData, $imageOne, $imageTwo)
    {
        $product = $this->product->find($requestData['id']);
        $colors = explode(",", $requestData['colors']) ?? [];
        # Update image 1
        if($imageOne)
        {
            # Remove image one
            $thumb = "image/products/" . $product->image_1;
            $big = "image/products/" . $product->thumb_image_1;
            $this->deleteImage([$thumb, $big]);
            # Store new image
            $path = $this->savePublicImage(
                $imageOne, "products",
                ImageConstant::PRODUCT,
                80,
                true, # is genegrate thumb image
                false # is genegrate blur thumb image
            );
            $product->image_1 = $path['big_image'];
            $product->thumb_image_1 = $path['thumb_image'];
        }
        # Storage image 2
        if($imageTwo){
            # Remove image one
            $this->deleteImage("image/products/" . $product->image_2);
            # Store new image
            $path = $this->savePublicImage(
                $imageTwo,
                "products",
                ImageConstant::PRODUCT,
                80,
                false, # is genegrate thumb image
                false # is genegrate blur thumb image
            );
            $product->image_2 = $path['big_image'];
        }
        # Update product
        $product->name = $requestData['name'];
        $product->url  = $requestData['url'];
        $product->price_sale = $requestData['price_sale'];
        $product->price_root = $requestData['price_root'];
        $product->short_desc = $requestData['short_desc'];
        $product->long_desc = $requestData['long_desc'];
        $product->from = $requestData['from'];
        $product->category_id = $requestData['category_id'];
        $product->status = $requestData['status'];
        # Store color
        $this->colorService->updateProductColor($colors, $product);
        # Store size service
        $this->sizeService->syncProductSize($requestData['sizes'], $product);
        # Save change
        $product->save();

        return true;
    }

    /**
     * Update product status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus($requestData)
    {
        $product = $this->product->find($requestData['id'])->update([
            'status' => $requestData['status']
        ]);

        return $requestData;
    }

    /**
     * Destroy product
     * 
     * @param $id
     * **/
    public function destroy($id)
    {
        $product = $this->product->find($id);
        #Delete image
        $imageOne = "image/products/" . $product->image_1;
        $imageTwo = "image/products/" . $product->image_2;
        $thumbImageOne = "image/products/" . $product->thumb_image_1;
        $this->deleteImage([$imageOne, $imageTwo, $thumbImageOne]);
        #Delete record
        $product->delete();

        return true;
    }
}