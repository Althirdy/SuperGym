<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class client_category extends Model
{
    use HasFactory;
    protected $table = 'client_category';
    protected $fillable = [
        'category',
        'price',
        'updated_at'
    ];
}
