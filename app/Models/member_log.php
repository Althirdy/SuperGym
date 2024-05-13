<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class member_log extends Model
{
    use HasFactory;

    protected $table = 'member_log';

    protected $fillable = [
        'client_id',
        'created_at',

    ];

    public function checking_qr($client_id, $added_at)
    {
        //Checking if the client is a member
        $client = DB::select("select * from clients where unique_id = ?", [$client_id]);

        if (empty($client)) {
            return [
                "message" => "The Client is not a member",
                "status" => false
            ];
        }

        //Checking if the member subs is not yet expired
        $clientStatus = $client[0]->status;

        if ($clientStatus === 1) {
            return [
                "message" => "The Client subscription is expired",
                "status" => false
            ];
        }

        //checking if the client is log today
        $logs = DB::select("SELECT * FROM member_log WHERE client_id = ? AND DATE(created_at) = ?", [$client[0]->id, $added_at]);

        if (empty($logs)) {
            return [
                "message" => "The Client is not already logged",
                "status" => true,
                "email" => $client[0]->email,
                "client_name" => $client[0]->name,
                "id" => $client[0]->id
            ];
        }
        return [
            "message" => "The Client is already logged",
            "status" => false
        ];
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
            $count = DB::table('member_log')
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
