<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SizeService;
use App\Services\ProductService;
use App\Services\ProductCategoryService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    /**
     * Service variable
     * **/
    protected $productService;
    protected $productCategoryService;
    protected $sizeService;
    
    /**
     * Constructor
     * **/
    public function __construct(
        SizeService $sizeService,
        ProductService $productService,
        ProductCategoryService $productCategoryService
    ){
        $this->sizeService = $sizeService;
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $respondData = $this->productService->list($request->only('keyword', 'order_by', 'category'));
        $list = $respondData['list'];
        $keyword = $respondData['keyword'];
        $orderBy = $respondData['orderBy'];
        $category = $respondData['category'];
        $productCategories = $this->productCategoryService->getAll();
        $sizes = $this->sizeService->getAll();

        return view('admin/product', compact(
            'list',
            'keyword',
            'orderBy',
            'productCategories',
            'category',
            'sizes'
        ));
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
    public function store(CreateProductRequest $request)
    {
        $requestData = $request->all();
        $imageOne = $request->file('image_1');
        $imageTwo = $request->file('image_2');
        
        return $this->productService->store($requestData, $imageOne, $imageTwo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->productService->show($id);
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request)
    {
        $requestData = $request->all();
        $imageOne = $request->file('image_1');
        $imageTwo = $request->file('image_2');
        
        return $this->productService->update($requestData, $imageOne, $imageTwo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productService->destroy($id);
    }

    /**
     * Update product status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus(Request $request)
    {
        $requestData = $request->only('id', 'status');
        return $this->productService->updateStatus($requestData);
    }
}
