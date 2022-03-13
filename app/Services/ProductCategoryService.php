<?php

namespace App\Services;

use App\Models\Slider;
use App\Traits\HelpTraits;
use App\Constants\AppConstant;

class ProductCategoryService
{
    use HelpTraits;
    private $productCategory;

    public function __construct(Slider $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    /**
     * List product category
     * @param $requestData
     * @return $list
     * function get all product category
     * **/
    public function list($requestData)
    {
        $data = $this->productCategory->all();
        return $data;
    }
}