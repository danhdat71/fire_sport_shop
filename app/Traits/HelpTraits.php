<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Image;
use Str;

trait HelpTraits
{
    /**
     * @param $file
     * @param $folderName as $folder
     * @param $size array
     * @param $quality
     * @return array thumb_path, big_path
     * 
     * function storage image to public path
     * **/
    protected function savePublicImage($file, $folder, $size, $quality)
    {
        //Fix params
        $folder = $folder ?? "temp/";
        $type = $type ?? "jpg";
        $bigWidth = $size[0];
        $bigHeight = $size[1];
        $thumbWidth = $size[2];
        $thumbHeight = $size[3];    

        $fileName = $file->getClientOriginalName();
        $image = Image::make($file)->encode("jpg");
        //Upload image big
        $imageNameBig = Str::random(20) . "_big_" . $fileName;
        $bigPath = 'image/' . $folder . "/" . $imageNameBig;
        $imageBig = $image->fit($bigWidth, $bigHeight)->save($bigPath, $quality);
        //Upload image thumb
        $imageNameThumb = Str::random(20) . "_thumb_" . $fileName;
        $thumbPath = 'image/' . $folder . "/" . $imageNameThumb;
        $imageThumb = $image->fit($thumbWidth, $thumbHeight)->save($thumbPath, $quality);

        return [
            'big_image' => $imageNameBig,
            'thumb_image' => $imageNameThumb
        ];
    }

    /**
     * @param $imageList array
     * @return void
     * function delete image file
     * **/
    protected function deleteImage($imageList)
    {
        Storage::disk('public_upload')->delete($imageList);
    }
}