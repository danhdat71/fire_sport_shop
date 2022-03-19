<?php

namespace App\Services;

use App\Models\Slider;
use App\Traits\HelpTraits;
use App\Constants\AppConstant;
use App\Constants\ImageConstant;

class SliderService
{
    use HelpTraits;

    /**
     * Slider model variable
     * **/
    private $slider;

    /**
     * Constructor
     * **/
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
        $orderBy = (isset($requestData['order_by'])) ? explode("|", $requestData['order_by']) : [];

        $list = $this->slider
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
     * @param $request data
     * @param $requestFile
     * @return boolean
     * Function store uploaded slider and file
     * **/
    public function store($requestData, $file)
    {
        //Storage image
        $path = $this->savePublicImage($file, "sliders", ImageConstant::SLIDER, 100);

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

    /**
     * Show slider
     * @param $id
     * @return object slider
     * function get one slider
     * **/
    public function show($id)
    {
        return $this->slider->find($id);
    }

    /**
     * @param $id
     * @param $requestData
     * @param $file
     * function update slider
     * @return boolean
     * **/
    public function update($file, $requestData)
    {
        $slider = $this->slider->find($requestData['id']);
        $updateData = [];
        $updateData['url'] = $requestData['url'] ?? null;
        $updateData['status'] = $requestData['status'] ?? null;
        if(isset($file)){
            #Remove old image
            $thumb = "image/sliders/" . $slider->thumb_image;
            $big = "image/sliders/" . $slider->big_image;
            $this->deleteImage([$thumb, $big]);
            #Upload new image
            $path = $this->savePublicImage($file, "sliders", ImageConstant::SLIDER, 100);
            $updateData['big_image'] = $path['big_image'];
            $updateData['thumb_image'] = $path['thumb_image'];
        }
        $slider->update($updateData);

        return true;
    }

    /**
     * Update slider status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus($requestData)
    {
        $slider = $this->slider->find($requestData['id'])->update([
            'status' => $requestData['status']
        ]);

        return $requestData;
    }
}