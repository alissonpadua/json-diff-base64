<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JsonLeft extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'json_base64'
    ];
}
