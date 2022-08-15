<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'devvn_quanhuyen';

    protected $primaryKey = 'maqh';

    public function towns()
    {
        return $this->hasMany(Town::class, 'maqh', 'maqh');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'matp');
    }
}
