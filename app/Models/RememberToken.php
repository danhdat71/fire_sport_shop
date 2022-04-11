<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RememberToken extends Model
{
    use HasFactory;

    /**
     * Table name
     * **/
    protected $table = 'remember_tokens';

    /**
     * Column name
     * **/
    protected $fillable = ['id', 'token', 'email', 'email_at'];
}
