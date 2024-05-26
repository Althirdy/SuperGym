<?php

namespace App\Http\Controllers;

use App\Models\client_category;
use App\Models\clients;
use App\Models\coaches;
use App\Models\daily_logs;
use App\Models\Goals;
use App\Models\member_log;
use App\Models\subscriptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Mail\client_registration_mail;
use Illuminate\Support\Facades\Mail;
use App\Mail\LogEmail;

class Dashboard extends Controller
{

    public function __construct()
    {
        // Set timezone to Manila (Asia/Manila)
        Config::set('app.timezone', 'Asia/Manila');
    }
    public function index()
    {
        //FOR CHARTS
        $count = new daily_logs();
        $count_member = new member_log();
        $count_member_log = $count_member->getPastDaysCount();
        $count_daily_log =  $count->getPastDaysCount();
        //=============================//
        // print_r($count_daily_log);
        session(['count_member_log' => $count_member_log]);
        session(['count_daily_log' => $count_daily_log]);
        //=======================//
        DB::update("
        UPDATE clients AS c
        SET c.status = 1
        WHERE c.expired_at < CURDATE()");

        $client_data = clients::select('clients.name as col1', 'subscriptions.description as col2', 'subscriptions.price as col3', DB::raw('DATE(clients.added_at) as col4'), 'coaches.name as col5')
            ->join('subscriptions', 'clients.subscription_id', '=', 'subscriptions.id')
            ->leftjoin('coaches', 'clients.coach_id', '=', 'coaches.id')
            ->where('clients.status', '=', 0)
            ->orderBy('clients.added_at', 'DESC')
            ->limit(5)
            ->get();
        $client_count = clients::count();
        $coaches_count = coaches::count();
        $currentDate = now()->toDateString();

        // print_r($client_category);
        $logData = DB::table('daily_logs')
            ->select(DB::raw('SUM(categories.price) as total_price'))
            ->whereDate('daily_logs.created_at', $currentDate)
            ->join('client_category as categories', 'daily_logs.category_id', '=', 'categories.id')
            ->first();
        $today_logs = daily_logs::whereDate('created_at', '=', date('Y-m-d'))->count();


        if(session()->has('gymbilog_user')){
            return view('Pages.Dashboard', [
                'dash_data' => $client_data,
                'client_count' => $client_count,
                'coaches_count' => $coaches_count,
                'today_revenue' => $logData->total_price,
                'today_logs' => $today_logs,
                'total_traffic' => $count_member_log['total'] + $count_daily_log['total'],
                'member' => $count_member_log['total'],
                'not_member' => $count_daily_log['total'],
            ]);

        }else{
            return redirect('/');
        }
      
    }

    public function Daily_logs(Request $request)
    {
        $count = new daily_logs();
        $count_daily_log =  $count->getPastDaysCount();
        session(['count_daily_log' => $count_daily_log]);
        $date = $request->query('date');
        if ($date === null || $date === "") {
            // Handle the case when $date is not provided
            // For example, display logs for today's date
            $date = now()->format('Y-m-d');
        }
        $logData = DB::table('daily_logs')
            ->select(DB::raw('SUM(categories.price) as total_price'))
            ->whereDate('daily_logs.created_at', $date)
            ->join('client_category as categories', 'daily_logs.category_id', '=', 'categories.id')
            ->first();
        $client_category  = DB::select('SELECT id, category from client_category');
        $regular = DB::table('daily_logs')
            ->where('category_id', 2)
            ->whereDate('created_at', $date)
            ->count();
        $student = DB::table('daily_logs')
            ->where('category_id', 1)
            ->whereDate('created_at', $date)
            ->count();
        $daily_data = daily_logs::select('daily_logs.name as col1', 'cc.category as col2', 'cc.price as col3', DB::raw('TIME(daily_logs.created_at) as col4'), DB::raw('DATE(daily_logs.created_at) as col5'))
            ->join('client_category as cc', 'daily_logs.category_id', '=', 'cc.id')
            ->orderBy('daily_logs.created_at', 'DESC')
            ->whereDate('daily_logs.created_at',  $date) // Filter records where created_at date is equal to current date
            ->paginate(8);

        // dump($daily_data->links()) ;

    
        if(session()->has('gymbilog_user')){
            return view('Pages.Daily', [
                'table_data' => $daily_data,
                'client_category' => $client_category,
                'daily_revenue' => $logData->total_price,
                'regular' => $regular,
                'student' => $student
            ]);

        }else{
            return redirect('/');
        }
    }

    public function Members_logs(Request $request)
    {
        $search = $request->query('search');
        $date = $request->query('date');
        if ($date === null || $date === "") {
            // Handle the case when $date is not provided
            // For example, display logs for today's date
            $date = now()->format('Y-m-d');
        }
        if ($search !== null && $search !== "") {
            $member_log = member_log::select('c.name as col1', 's.description as col2', 's.price as col3', DB::raw('COALESCE(co.name, "No coach") as col4'), DB::raw('DATE(member_log.created_at) AS col5'))
                ->join('clients as c', 'c.id', '=', 'member_log.client_id')
                ->join('subscriptions as s', 'c.subscription_id', '=', 's.id')
                ->leftJoin('coaches as co', 'co.id', '=', 'c.coach_id')
                ->where('c.name', 'LIKE', '%' . $search . '%') // Adjust this condition based on your search field
                ->paginate(8);
        } else {
            $member_log = member_log::select('c.name as col1', 's.description as col2', 's.price as col3', DB::raw('COALESCE(co.name, "No coach") as col4'), DB::raw('DATE(member_log.created_at) AS col5'))
                ->join('clients as c', 'c.id', '=', 'member_log.client_id')
                ->join('subscriptions as s', 'c.subscription_id', '=', 's.id')
                ->leftJoin('coaches as co', 'co.id', '=', 'c.coach_id')
                ->whereDate('member_log.created_at', $date)
                ->paginate(8);
        }



        // Print the array
        // return view('Pages.Members', [
        //     'table_data' => $member_log
        // ]);

        if(session()->has('gymbilog_user')){
            return view('Pages.Members', [
                'table_data' => $member_log
            ]);
        }else{
            return redirect('/');
        }
    }


    public function DailyPost(Request $request)
    {
        $data = $request->all();
        $daily = new daily_logs();
        $daily->name = $data['name'];
        $daily->category_id = $data['category_id'];
        if ($daily->save()) {
            $response = [
                "status" => "Success",
                "isSave" => true
            ];
        } else {
            $response = [
                "status" => "Failed",
                "isSave" => false
            ];
        }

        return response()->json($response);
    }

    public function client_page(Request $request)
    {

        $search = $request->query('search');

        $table_data = clients::select('clients.name as col1', 's.description as col2', 'g.goal as col3', DB::raw('COALESCE(c.name, "No coach") as col4'), DB::raw('DATE(clients.added_at) as col5'))
            ->join('subscriptions as s', 'clients.subscription_id', '=', 's.id')
            ->join('goals as g', 'clients.goal_id', '=', 'g.id')
            ->leftJoin('coaches as c', 'clients.coach_id', '=', 'c.id')
            ->where('clients.status', '=', 0);

        // Add search conditions if $search is not null and not an empty string
        if ($search !== null && $search !== "") {
            $table_data->where(function ($query) use ($search) {
                $query->where('clients.unique_id', 'like', "%$search%")
                    ->orWhere('clients.name', 'like', "%$search%")
                    ->orWhere('clients.email', 'like', "%$search%");
            });
        }

        $table_data->orderBy('clients.added_at', 'DESC');
        $table_data = $table_data->paginate(10);
        $subs = subscriptions::all('description', 'id', 'price');
        $goal = Goals::all('id', 'goal');
        $coaches = coaches::where('goal_id', 1)
            ->select('name', 'contact_no', 'id')
            ->get();
        // print_r(json_decode($goal));
        // return view('Pages.client', [
        //     'table_data' => $table_data,
        //     'subscription' => $subs,
        //     'goal_data' => $goal,
        //     'coach' => $coaches
        // ]);

        if(session()->has('gymbilog_user')){
            return view('Pages.client', [
                'table_data' => $table_data,
                'subscription' => $subs,
                'goal_data' => $goal,
                'coach' => $coaches
            ]);
        }else{
            return redirect('/');
        }
    }

    public function getCoachesByCategory($category_id = 1)
    {
        $coaches = coaches::where('goal_id', $category_id)
            ->select('name', 'contact_no', 'id')
            ->get();

        return response()->json($coaches);
    }

    public function insertNewClient(Request $request)
    {

        $rules = [
            'email' => 'required|email|unique:clients,email',
            'weight' => 'required|numeric|min:1|max:600',

        ];
        $messages = [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'weight.max' => 'The weight must be less than 600.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $data = $request->all();
        $numericId = mt_rand(100, 999);
        $randomString = Str::random(mt_rand(3, 5));
        $client = new clients();
        $client->unique_id = $numericId . '-' . $randomString;
        $client->email = $data['email'];
        $client->name = $data["name"];
        if ($data['coach_id'] > 0) {
            $client->coach_id = $data['coach_id'];
        } else {
            $client->coach_id = null;
        }
        $client->goal_id = $data['goal_id'];
        $client->subscription_id = $data['subs_id'];
        $client->weight = $data['weight'];
        $client->added_at = Carbon::now();
        if ($data['subs_id'] == 1) {
            $client->expired_at = Carbon::now()->addYear();
        } elseif ($data['subs_id'] == 2) {
            $client->expired_at = Carbon::now()->addMonth();
        }

        if ($client->save()) {
            Mail::to($data['email'])->send(new client_registration_mail(['name' => $data["name"], 'unique_id' => $numericId . '-' . $randomString]));
            $data_response = [
                'isInserted' => true,
                'status' => 200
            ];
        } else {
            $data_response = [
                'isInserted' => false,
                'status' => 404
            ];
        }

        return response()->json($data_response);
    }

    public function client_log(Request $request)
    {
        $data = $request->all();
        $member_log = new member_log();
        $isClient = $member_log->checking_qr($data['client_id'], date('Y/m/d'));
        if (!$isClient['status']) {
            return response()->json($isClient);
        }
        $member_log->client_id  = $isClient['id'];
        $member_log->created_at = Carbon::now();
        $member_log->updated_at = Carbon::now();

        if (!$member_log->save()) {
            return response()->json(['status' => false, 'message' => 'Error Saving in Database']);
        }

        $loginDate = Carbon::now()->toDateString();
        $loginTime = Carbon::now()->toTimeString();
        $carbonTime = Carbon::createFromFormat('H:i:s', $loginTime);
        $formattedTime = $carbonTime->format('h:i A');

        Mail::to($isClient['email'])->send(new LogEmail($isClient['client_name'], $loginDate,  $formattedTime));
        return response()->json(['status' => true, 'message' => 'Data saved Successfully']);
    }


    public function Update_Price(Request $request)
    {

        $categoryIds = $request->input('category_id');
        $prices = $request->input('price');

        // Iterate over the category IDs and corresponding prices
        foreach ($categoryIds as $index => $categoryId) {
            // Find the client_category record by its ID
            $category = client_category::find($categoryId);
            if ($category) {
                // Update the price of the category
                $category->price = $prices[$index];
                $category->save();
            }
        }

        // Return a success response
        return response()->json(['message' => 'Prices updated successfully','status'=>true]);
    }
}
