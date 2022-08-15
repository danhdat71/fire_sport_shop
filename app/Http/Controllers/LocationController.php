<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Town;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getProvinces()
    {
        $provinces = Province::all();
        return $this->success($provinces);
    }

    public function getDistricts(Request $request)
    {
        $district = District::when(!empty($request['matp']), function($q) use($request){
            $q->where('matp', $request['matp']);
        })
        ->get();

        return $this->success($district);
    }

    public function getTowns(Request $request)
    {
        $town = Town::when(!empty($request['maqh']), function($q) use($request){
            $q->where('maqh', $request['maqh']);
        })
        ->get();

        return $this->success($town);
    }
}
