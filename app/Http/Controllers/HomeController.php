<?php

namespace App\Http\Controllers;

use App\Models\DeliverableSubmission;
use App\Models\DisputeCase;
use App\Models\DisputeCaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        /*
        DB::table('page_views')
      ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
      ->groupBy('date')
      ->get();
      */
        $unit_coordinator_id = Auth::user()->unit_coordinators->id;
        $allSubmissions = DB::table('deliverable_submissions')
                        ->join('teams', 'deliverable_submissions.team_id', '=', 'teams.id')
                        ->select(DB::raw('team_id'), 'teams.team_name', DB::raw('count(*) as submissions'))
                        ->where('unit_coordinator_id', $unit_coordinator_id)
                        //->where('teams.module_id', '=', $module_id)
                        ->groupBy('teams.id', 'teams.team_name')
                        ->get();

        $disputeCases = DisputeCase::with('module', 'students', 'team')         
                        ->where('unit_coordinator_id', $unit_coordinator_id)               
                        ->orderByDesc('created_at')
                        ->get();

                
     
        return view('home', [
            'allSubmissions' => json_encode( $allSubmissions->toArray()),
            'disputeCases' => $disputeCases
        ]);
    }
}
