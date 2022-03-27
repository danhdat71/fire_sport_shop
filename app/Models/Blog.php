<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * Table name
     * **/
    protected $table = 'blogs';

    /**
     * Columns name
     * **/
    protected $fillable = [
        'id',
        'name',
        'url',
        'big_image',
        'thumb_image',
        'short_desc',
        'long_desc',
        'status',
        'special',
        'user_id'
    ];

    /**
     * Get the user that owns the Blog
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
