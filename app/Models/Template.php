<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    /**
     * Template table name
     * **/
    protected $table = 'templates';

    /**
     * Template column
     * **/
    protected $fillable = ['id', 'name', 'html'];
}
