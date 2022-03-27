<?php
namespace App\Services;

use App\Models\Blog;
use App\Traits\HelpTraits;
use App\Constants\ImageConstant;
use App\Constants\AppConstant;

class BlogService
{
    use HelpTraits;

    /**
     * Model variable
     * **/
    protected $blog = null;

    /**
     * Constructor function
     * **/
    public function __construct(Blog $blog)
    {
        $this->blog = $blog;
    }

    /**
     * Store blog
     * **/
    public function store($requestData, $file)
    {
        # Store image and get link
        $path = $this->savePublicImage(
            $file, "blogs",
            ImageConstant::BLOG,
            90,
            true, # is genegrate thumb image
            false # is genegrate blur thumb image
        );
        $requestData['big_image'] = $path['big_image'];
        $requestData['thumb_image'] = $path['thumb_image'];
        # Store data
        $this->blog->create($requestData);

        return true;
    }

    /**
     * List blog
     * 
     * @param $requestData
     * @return $blogList
     * **/
    public function list($requestData)
    {
        $keyword = (isset($requestData['keyword'])) ? $requestData['keyword'] : null;
        $orderBy = (isset($requestData['order_by'])) ? explode("|", $requestData['order_by']) : [];

        $list = $this->blog->when(isset($keyword), function($q) use($keyword){
                $q->where('name', 'like', '%' . $keyword . '%');
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
     * Show blog by id
     * **/
    public function show($id)
    {
        return $this->blog->find($id);
    }

    /**
     * Update blog
     * @param $requestData, $file
     * **/
    public function update($file, $requestData)
    {
        $blog = $this->blog->find($requestData['id']);
        $updateData = [];
        $updateData['url'] = $requestData['url'] ?? null;
        $updateData['status'] = $requestData['status'] ?? null;
        if(isset($file)){
            #Remove old image
            $thumb = "image/blogs/" . $blog->thumb_image;
            $big = "image/blogs/" . $blog->big_image;
            $this->deleteImage([$thumb, $big]);
            #Upload new image
            $path = $this->savePublicImage(
                $file,
                "blogs",
                ImageConstant::BLOG,
                100,
                true,
                false
            );
            $updateData['big_image'] = $path['big_image'];
            $updateData['thumb_image'] = $path['thumb_image'];
        }
        $blog->update($updateData);

        return true;
    }

    /**
     * Update status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus($requestData)
    {
        $product = $this->blog->find($requestData['id'])->update([
            'status' => $requestData['status']
        ]);

        return $requestData;
    }

    /**
     * Update special
     * @param $request
     * @return boolean
     * **/
    public function updateSpecial($requestData)
    {
        $product = $this->blog->find($requestData['id'])->update([
            'special' => $requestData['status']
        ]);

        return $requestData;
    }

    /**
     * @param $id
     * @return $status
     * Delete blog
     * **/
    public function destroy($id)
    {
        $blog = $this->blog->find($id);
        #Delete image
        $thumb = "image/blogs/" . $blog->thumb_image;
        $big = "image/blogs/" . $blog->big_image;
        $this->deleteImage([$thumb, $big]);
        #Delete record
        $blog->delete();

        return true;
    }
}