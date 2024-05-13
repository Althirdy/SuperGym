<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clients extends Model
{
    use HasFactory;
    protected $fillable = [
        'unique_id',
        'email',
        'name',
        'coach_id',
        'goal_id',
        'subscription_id',
        'weight',
        'status',
        'expired_at',
        'added_at',
    ];
    public $timestamps = false;


    public function coach()
    {
        return $this->belongsTo(coaches::class);
    }

    public function goal()
    {
        return $this->belongsTo(Goals::class);
    }

    public function subscription()
    {
        return $this->belongsTo(subscriptions::class);
    }
}
