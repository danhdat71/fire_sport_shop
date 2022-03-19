<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductCategoryService;
use App\Http\Requests\CreateProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;

class ProductCategoriesController extends Controller
{
    /**
     * Product category service variable
     * **/
    public $productCategoryService;

    /**
     * Constructor
     * **/
    public function __construct(ProductCategoryService $productCategoryService)
    {
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $respondData = $this->productCategoryService->list($request->only('keyword', 'order_by'));

        $list = $respondData['list'];
        $keyword = $respondData['keyword'];
        $orderBy = $respondData['orderBy'];

        return view('admin.product_category', compact(['list', 'keyword', 'orderBy']));
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
    public function store(CreateProductCategoryRequest $request)
    {
        $requestData = $request->all();
        $file = $request->file('image');
        return $this->productCategoryService->store($requestData, $file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->productCategoryService->show($id);
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
    public function update(UpdateProductCategoryRequest $request)
    {
        $file = $request->file('image');
        $requestData = $request->only('url', 'status', 'id');
        
        return $this->productCategoryService->update($file, $requestData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productCategoryService->destroy($id);
    }

    /**
     * Update slider status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus(Request $request)
    {
        $requestData = $request->only('id', 'status');
        return $this->productCategoryService->updateStatus($requestData);
    }
    
}
