<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function getAllColor()
    {
        $colors = Color::all();
        return $this->success($colors);
    }
}
