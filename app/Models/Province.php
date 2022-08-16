<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'devvn_tinhthanhpho';

    protected $primaryKey = 'matp';

    public function districts()
    {
        return $this->hasMany(District::class, 'matp', 'matp');
    }
}
