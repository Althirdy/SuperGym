<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coaches extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'goal_id',
        'contact_no',
        'description',
        'created_at',
        'updated_at'
        
        
       
    ];
}
