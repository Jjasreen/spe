<?php

namespace App\Http\Controllers;

use App\Models\DisputeCase;
use App\Models\Module;
use App\Models\UnitCoordinator;
use Carbon\Exceptions\UnitException;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Auth;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    //
    public function adminview()
    {
        $all_mods = Module::all();
        return view('modules.admin', [
            'modules' => $all_mods
        ]);
    }

    public function view()
    {
        // $modules = Module::with('unit_coordinator')->get();     <-- eager loading
        $uc_ids = Auth::user()->unit_coordinators()->pluck('id')->toArray();
        $modules = Module::whereIn('unit_coordinator_id', $uc_ids)->get();
        return view('modules.view', [
            'modules' => $modules
        ]);
    }

    //show the form
    public function create()
    {
        if (Auth::user()->role == "admin") {
            //dd(UnitCoordinator::pluck('first_name', 'id'));
            $all_uc = UnitCoordinator::get();
            $all_uc = $all_uc->mapWithKeys(function ($each_uc) {
                return [$each_uc->id => $each_uc->first_name . ' ' . $each_uc->last_name . ' / ' . $each_uc->unit_code];
            });
        } else {
            $all_uc = [];
        }



        return view('modules.create', [
            'all_uc' => $all_uc
        ]);
    }

    public function processCreate(Request $request)
    {

        $unit_code = $request->input('unit_code');
        $module_name = $request->input('module_name');
        if (Auth::user()->role == "admin") {
            $unit_coordinator_id = $request->input('unit_coordinator_id');
        } else {
            $unit_coordinator_id = Auth::user()->unit_coordinators->id;
        }


        $modules = new Module();
        $modules->unit_code = $unit_code;
        $modules->module_name = $module_name;
        $modules->unit_code = $unit_code;
        $modules->unit_coordinator_id = $unit_coordinator_id;
        $modules->save();
        if (Auth::user()->role == "UC") {

            return redirect('/modules');
        } else {
            return redirect('/modulesadmin');
        }
    }
    public function update(Module $m)
    {
        $all_uc = UnitCoordinator::pluck('first_name', 'id');
        return view('modules.update', [
            'all_uc' => $all_uc,
            'm' => $m

        ]);
    }

    public function processUpdate(Module $m, Request $request)
    {
        $unit_code = $request->input('unit_code');
        $module_name = $request->input('module_name');
        if (Auth::user()->role == "admin") {
            $unit_coordinator_id = $request->input('unit_coordinator_id');
        } else {
            $unit_coordinator_id = Auth::user()->unit_coordinators->id;
        }

        $m->unit_code = $unit_code;
        $m->module_name = $module_name;
        $m->unit_code = $unit_code;
        $m->unit_coordinator_id = $unit_coordinator_id;
        $m->save();
        if (Auth::user()->role == "UC") {

            return redirect('/modules');
        } else {
            return redirect('/modulesadmin');
        }
    }
    public function delete($id)
    {
        $m = Module::find($id);
        return view('modules.delete', ['m' => $m]);
    }
    public function processDelete($id)
    {
        $all_uc = Module::find($id);
        $all_uc->delete();
        if (Auth::user()->role == "UC") {

            return redirect('/modules');
        } else {
            return redirect('/modulesadmin');
        }
    }

    public function dashboard(Module $module)
    {
        $unit_coordinator_id = Auth::user()->unit_coordinators->id;
        $allSubmissions = DB::table('deliverable_submissions')
                        ->join('teams', 'deliverable_submissions.team_id', '=', 'teams.id')
                        ->select(DB::raw('team_id'), 'teams.team_name', DB::raw('count(*) as submissions'))
                        ->where('unit_coordinator_id', $unit_coordinator_id)
                        ->where('teams.module_id', '=', $module->id)
                        ->groupBy('teams.id', 'teams.team_name')
                        ->get();

        $disputeCases = DisputeCase::with('module', 'students', 'team')         
                        ->where('unit_coordinator_id', $unit_coordinator_id)  
                        ->whereHas('team', function($q) use ($module){
                            $q->where('module_id', '=', $module->id);
                        })             
                        ->orderByDesc('created_at')
                        ->get();

                
     
        return view('modules.dashboard', [
            'allSubmissions' => json_encode( $allSubmissions->toArray()),
            'disputeCases' => $disputeCases,
            'module' => $module,
        ]);



    }
}
