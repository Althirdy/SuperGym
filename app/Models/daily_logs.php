<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daily_logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_id',
        'updated_at'
    ];


    public function client_category()
    {
        return $this->belongsTo(client_category::class);
    }


    public function getPastDaysCount()
    {
        $logCounts = [];
        $totalCount = 0;

        // Get today's date
        $today = Carbon::now()->toDateString();

        // Iterate over the past 7 days in reverse order
        for ($i = 0; $i < 7; $i++) {
            // Calculate the date for the current day
            $date = Carbon::now()->subDays($i)->toDateString();

            // Query to get the count of daily_logs for the current day
            $count = DB::table('daily_logs')
                ->whereDate('created_at', $date)
                ->count();

            // Add the count to the logCounts array
            $logCounts["D" . (7 - $i)] = $count;

            // Increment total count
            $totalCount += $count;
        }

        // Add total count to the logCounts array
        $logCounts['Total'] = $totalCount;

        return [
            'days' => $logCounts,
            'total' => $totalCount
        ];
    }
}
