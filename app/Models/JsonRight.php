<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JsonRight extends Model
{
    use HasFactory;

    protected $fillable = [
        'json_left_id',
        'code',
        'json_base64',
    ];

    public function jsonLeft()
    {
        return $this->belongsTo(JsonLeft::class);
    }
}
