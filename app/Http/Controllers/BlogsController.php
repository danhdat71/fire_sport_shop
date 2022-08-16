<?php

namespace App\Http\Controllers;

use App\Constants\AppConstant;
use Illuminate\Http\Request;
use App\Services\BlogService;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogsController extends Controller
{
    /**
     * Blog service variable
     * **/
    protected $blogService = null;

    /**
     * Blo service function
     * **/
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $respondData = $this->blogService->list($request->all());
        $list    = $respondData['list'];
        $keyword = $respondData['keyword'];
        $orderBy = $respondData['orderBy'];
        $tab = 'blog';
        
        return view('admin/blog', compact('tab', 'list', 'keyword', 'orderBy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBlogRequest $request)
    {
        $file = $request->file('image');
        $requestData = $request->only('name', 'url', 'short_desc', 'long_desc');
        return $this->blogService->store($requestData, $file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->blogService->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request)
    {
        $file = $request->file('image');
        $requestData = $request->all();
        return $this->blogService->update($file, $requestData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->blogService->destroy($id);
    }

    /**
     * Update status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus(Request $request)
    {
        $requestData = $request->only('id', 'status');
        return $this->blogService->updateStatus($requestData);
    }

    /**
     * Update special
     * @param $request
     * @return boolean
     * **/
    public function updateSpecial(Request $request)
    {
        $requestData = $request->only('id', 'status');
        return $this->blogService->updateSpecial($requestData);
    }

    public function getBlogs(Request $request)
    {
        return Blog::where('blogs.status', true)
        ->when(isset($request['special']), function($q) use($request){
            $q->where('special', $request['special']);
        })
        ->orderBy('id', 'desc')
        ->select(
            'id',
            'user_id',
            'blogs.big_image',
            'blogs.name',
            'blogs.short_desc',
            'blogs.created_at',
            'blogs.url',
            DB::raw("DATE_FORMAT(blogs.created_at, '%Y-%m-%d') as create_date")
        )
        ->with(['user'=> function($q){
            $q->select('id', 'name');
        }])
        ->paginate($request['limit'] ?? AppConstant::PAGINATE);
    }

    public function showBlog($url)
    {
        $blog = Blog::where('url', $url)
            ->with(['user'])
            ->select(
                '*',
                DB::raw('DATE_FORMAT(created_at, "%d-%m-%Y %H:%i") as create_at')
            )
            ->first();

        return $this->success($blog);
    }
}
