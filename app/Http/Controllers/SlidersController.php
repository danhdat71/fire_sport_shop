<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SliderService;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;

class SlidersController extends Controller
{

    public $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $respondData = $this->sliderService->list($request->only('keyword', 'order_by'));
        $sliders = $respondData['list'];
        $keyword = $respondData['keyword'];
        $orderBy = $respondData['orderBy'];

        return view('admin.slider', compact(['sliders', 'keyword', 'orderBy']));
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
    public function store(CreateSliderRequest $request)
    {
        $requestData = $request->all();
        $requestFile = $request->file('image');
        
        return $this->sliderService->store($requestData, $requestFile);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->sliderService->show($id);
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
    public function update(UpdateSliderRequest $request)
    {
        $file = $request->file('image');
        $requestData = $request->only('url', 'status', 'id');
        
        return $this->sliderService->update($file, $requestData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->sliderService->destroy($id);
    }

    /**
     * Update slider status
     * @param $request
     * @return boolean
     * **/
    public function updateStatus(Request $request)
    {
        $requestData = $request->only('id', 'status');
        return $this->sliderService->updateStatus($requestData);
    }
}
