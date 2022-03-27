<?php
namespace App\Services;

use App\Models\Blog;
use App\Traits\HelpTraits;
use App\Constants\ImageConstant;

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
}