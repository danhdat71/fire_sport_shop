<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductImageService;
use App\Http\Requests\CreateProductImageRequest;

class ProductImagesController extends Controller
{
    /**
     * Service variable
     * **/
    protected $productImageService = null;

    /**
     * Constructor function
     * **/
    public function __construct(ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $this->productImageService->list($request->product_id);
        $productID = $request->product_id;
        return view('admin/product_image', compact('list', 'productID'));
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
    public function store(CreateProductImageRequest $request)
    {
        $images = $request->file('images');
        $productID = $request->product_id;
        return $this->productImageService->store($productID, $images);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productImageService->destroy($id);
    }
}
