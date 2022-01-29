<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';
    protected $fillable = [
        'id',
        'thumb_image',
        'big_image',
        'url',
        'status',
    ];
}
