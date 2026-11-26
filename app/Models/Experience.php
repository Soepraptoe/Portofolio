<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['period', 'title', 'org', 'description', 'tags', 'sort_order'];

    // kolom tags disimpan sebagai JSON, otomatis jadi array di PHP
    protected $casts = [
        'tags' => 'array',
    ];
}