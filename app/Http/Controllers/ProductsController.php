<?php

namespace App\Http\Controllers;

use App\Constants\AppConstant;
use Illuminate\Http\Request;
use App\Services\SizeService;
use App\Services\ProductService;
use App\Services\ProductCategoryService;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

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
        $tab = "product";

        return view('admin/product', compact(
            'list',
            'keyword',
            'orderBy',
            'productCategories',
            'category',
            'sizes',
            'tab'
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

    public function getProducts(Request $request)
    {
        $products = Product::
        leftJoin('product_categories', 'product_categories.id', '=', 'products.category_id')
        ->when(isset($request['order_by']), function($q) use($request){
            $orderBy = explode("|", $request['order_by']);
            $q->orderBy("products.".$orderBy[0], $orderBy[1]);
        })
        ->when(!empty($request['category_url']), function($q) use($request){
            $categoryUrl = explode(",", $request['category_url']);
            $q->whereIn('product_categories.url', $categoryUrl);
        })
        ->when(!empty($request['color_id']), function($q) use($request){
            $colorId = explode(",", $request['color_id']);
            $q->whereHas('colors', function($q) use($colorId){
                $q->whereIn('colors.id', $colorId);
            });
        })
        ->when(!empty($request['size_id']), function($q) use($request){
            $sizeId = explode(",", $request['size_id']);
            $q->whereHas('sizes', function($q) use($sizeId){
                $q->whereIn('sizes.id', $sizeId);
            });
        })
        ->when(!empty($request['price_range']), function($q) use($request){
            $priceRange = explode(",", $request['price_range']);
            $q->whereBetween('price_sale', $priceRange);
        })
        ->when(!empty($request['other_current_url']), function($q) use($request){
            $q->where('products.url', "<>", $request['other_current_url']);
        })
        ->when(!empty($request['keyword']), function($q) use($request){
            $q->where('products.name', 'LIKE', "%". $request['keyword']. "%");
        })
        ->where('products.status', true)
        ->select(
            'products.name',
            'products.price_sale',
            'products.price_root',
            'products.image_1',
            'products.image_2',
            'products.url',
        )
        ->paginate($request['limit'] ?? AppConstant::PAGINATE);

        return $this->success($products);
    }

    public function getDetailProduct($url)
    {
        $product = Product::where('url', $url)
            ->with(['productImages', 'sizes', 'colors', 'category'])
            ->first();
        return $this->success($product);
    }
}
