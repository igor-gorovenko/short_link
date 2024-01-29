<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_key',
        'destination_url',
        'generated_shortlink',
        'updated_at',
        'created_at',
    ];
}
