<?php

namespace App\Services;

use App\Models\ProductCategory;
use App\Traits\HelpTraits;
use App\Constants\AppConstant;
use App\Constants\ImageConstant;

class ProductCategoryService
{
    use HelpTraits;

    /**
     * Model variable
     * **/
    private $productCategory;

    /**
     * Constructor
     * **/
    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * List product category
     * @param $requestData
     * @return $list
     * **/
    public function list($requestData)
    {
        $keyword = (isset($requestData['keyword'])) ? $requestData['keyword'] : null;
        $orderBy = (isset($requestData['order_by'])) ? explode("|", $requestData['order_by']) : [];

        $list = $this->productCategory
            ->when(isset($keyword), function($q) use($keyword){
                $q->where('url', 'like', "%".$keyword."%");
            })
            ->when(count($orderBy) > 0, function($q) use($orderBy){
                $q->orderBy($orderBy[0], $orderBy[1]);
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(AppConstant::PAGINATE);

        return [
            'list' => $list,
            'keyword' => $keyword,
            'orderBy' => $requestData['order_by'] ?? null
        ];
    }

    /**
     * Store product category
     * @param $data, $file
     * @return boolean
     * **/
    public function store($requestData, $file)
    {
        //Storage image
        $path = $this->savePublicImage($file, "productCategories", ImageConstant::PRODUCT_CATEGORY, 100);
        //Insert record
        $requestData['big_image'] = $path['big_image'];
        $requestData['thumb_image'] = $path['thumb_image'];
        $this->productCategory->create($requestData);

        return true;
    }

    /**
     * Show product category
     * @param $id
     * **/
    public function show($id)
    {
        return $this->productCategory->find($id);
    }

    /**
     * Update product category
     * @param $requestData, $file
     * **/
    public function update($file, $requestData)
    {
        $productCategory = $this->productCategory->find($requestData['id']);
        $updateData = [];
        $updateData['url'] = $requestData['url'] ?? null;
        $updateData['status'] = $requestData['status'] ?? null;
        if(isset($file)){
            #Remove old image
            $thumb = "image/productCategories/" . $productCategory->thumb_image;
            $big = "image/productCategories/" . $productCategory->big_image;
            $this->deleteImage([$thumb, $big]);
            #Upload new image
            $path = $this->savePublicImage($file, "productCategories", ImageConstant::SLIDER, 100);
            $updateData['big_image'] = $path['big_image'];
            $updateData['thumb_image'] = $path['thumb_image'];
        }
        $productCategory->update($updateData);

        return true;
    }

    /**
     * Update status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus($requestData)
    {
        $slider = $this->productCategory->find($requestData['id'])->update([
            'status' => $requestData['status']
        ]);

        return $requestData;
    }

    /**
     * @param $id
     * @return $status
     * function delete specific slider
     * **/
    public function destroy($id)
    {
        $productCategory = $this->productCategory->whereId($id)->firstOrFail();
        #Delete image
        $thumb = "image/productCategories/" . $productCategory->thumb_image;
        $big = "image/productCategories/" . $productCategory->big_image;
        $this->deleteImage([$thumb, $big]);
        #Delete record
        $productCategory->delete();

        return true;
    }
}