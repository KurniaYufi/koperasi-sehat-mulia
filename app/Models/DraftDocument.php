<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DraftDocument extends Model
{
    protected $fillable = [
        'name',
        'date',
        'file_url',
        'file_public_id',
        'file_original_name',
        'mime_type',
        'size',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
