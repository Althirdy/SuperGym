<?php

namespace App\Http\Controllers;

use App\Models\client_category;
use App\Models\coaches;
use App\Models\Goals;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class CoachController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        if ($search !== null && $search !== "") {
            $coach = coaches::select('coaches.name as col1', 'coaches.email as col3', 'coaches.contact_no as col2', 'g.goal as col4', DB::raw('DATE(coaches.created_at) as col5'))
                ->join('goals as g', 'g.id', '=', 'coaches.goal_id')
                ->where('coaches.name', 'LIKE', '%' . $search . '%') // Adjust this condition based on your search field
                ->orderBy('coaches.created_at', 'DESC')
                ->paginate(8);
        } else {
            $coach = coaches::select('coaches.name as col1', 'coaches.email as col3', 'coaches.contact_no as col2', 'g.goal as col4', DB::raw('DATE(coaches.created_at) as col5'))
                ->join('goals as g', 'g.id', '=', 'coaches.goal_id')
                ->orderBy('coaches.created_at', 'DESC')
                ->paginate(8);
        }

        $goal = Goals::all('id', 'goal');


        return view('Pages.coaches', [
            'table_data' => $coach,
            'goal_data' => $goal

        ]);
    }

    public function insertCoach(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', Rule::unique('coaches')],
            'contact_no' => ['required', 'numeric', 'digits:11'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $contact_no = $data['contact_no'];
        $sliced_contact_no = substr($contact_no, 0, 4) . '-' . substr($contact_no, 4, 3) . '-' . substr($contact_no, 7);

        $coach = new coaches();
        $coach->name = $data['name'];
        $coach->email = $data['email'];
        $coach->goal_id = $data['goal'];
        $coach->contact_no = $sliced_contact_no;
        $coach->created_at = Carbon::now();
        $coach->updated_at = Carbon::now();

        if ($coach->save()) {
            return response()->json(['isInserted' => true]);
        }

        return response()->json(['isInserted' => false]);
    }

    ///Settings

    public function ShowSettings()
    {
        $category = DB::select('SELECT id,category,price from client_category');
        $goal = Goals::all('goal');

        return view('Pages.settings', [
            'category' => $category,
            'goal' => $goal
        ]);
    }
}
