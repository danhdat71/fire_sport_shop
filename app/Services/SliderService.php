<?php

namespace App\Services;

use App\Models\Slider;
use App\Traits\HelpTraits;
use App\Constants\AppConstant;

class SliderService
{
    use HelpTraits;
    private $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * List slider
     * @param $requestData
     * @return $list
     * function get all sliders
     * **/
    public function list($requestData)
    {
        $keyword = (isset($requestData['keyword'])) ? $requestData['keyword'] : null;

        $list = $this->slider
            ->when(isset($keyword), function($q){
                $q->where('url', 'like', "'%".$keyword."%'");
            })
            ->orderBy('created_at', 'DESC')
            ->paginate(AppConstant::PAGINATE);

        return $list;
    }

    /**
     * @param $request data
     * @param $requestFile
     * @return boolean
     * Function store uploaded slider and file
     * **/
    public function store($requestData, $file)
    {
        //Storage image
        $thumbBigSize = [1024, 600, 500, 250];
        $path = $this->savePublicImage($file, "sliders", $thumbBigSize, 100);

        //Insert record
        $requestData['big_image'] = $path['big_image'];
        $requestData['thumb_image'] = $path['thumb_image'];
        $this->slider->create($requestData);

        return true;
    }

    /**
     * @param $id
     * @return $status
     * function delete specific slider
     * **/
    public function destroy($id)
    {
        $slider = $this->slider->whereId($id)->firstOrFail();
        #Delete image
        $thumb = "image/sliders/" . $slider->thumb_image;
        $big = "image/sliders/" . $slider->big_image;
        $this->deleteImage([$thumb, $big]);
        #Delete record
        $slider->delete();

        return true;
    }
}