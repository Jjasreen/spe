<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Student;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    public function view(Module $module)
    {
        $teams = Team::where('module_id', $module->id)->get();
        return view('teams.view',[
            'teams' => $teams,
            'module' => $module,
        ]);
    }

    public function details(Team $team) {        
        return view('teams.details',[
            'team' => $team
        ]);
    }

    public function create()
    {
        $all_modules = Module::pluck('module_name','id');
        $mods = Module::pluck('unit_code', 'unit_code');
        $studs = Student::pluck('teaching_period', 'teaching_period') -> unique('teaching_period');
        //$teamss = Team::pluck('id');
    
            return view('teams.create',[
            'modules' => $all_modules,
            'mods' => $mods,
            'studs' => $studs,
            //'teamss' => $teamss,
            

        ]);
    }
    public function processCreate(Request $request)
    {
        $unit_code = $request ->input('unit_code');
        $teaching_period = $request ->input('teaching_period');
        $module_id = $request -> input('module_id');
        $team_name = $request->team_name;

        $teamss = new Team();
        $teamss->unit_code = $unit_code;
        $teamss->teaching_period = $teaching_period;
        $teamss->module_id = $module_id;
        $teamss->team_name=$team_name;
        //$teamss->students()->sync($request -> input('teaching_period'));
        $teamss->save();

        

        return redirect('/teams');
    }

    public function update(Team $team)
    {
        $all_students = Student::pluck('s_givenname', 'id');
        $all_modules = Module::pluck('module_name', 'id');
        $current_students_in_team = $team->students;
        return view('teams.update',[
            'team' => $team,
            'modules' => $all_modules,
            'students' => $all_students,
            'current_students' => $current_students_in_team
        ]);
    }

    public function processUpdate(Team $team, Request $request) 
    {
        $team->unit_code = $request->input('unit_code');
        $team->teaching_period = $request->input('teaching_period');
        $team->module_id = $request->input('module_id');

        $syncData = [];        
        foreach((array)($request->input('students')) as $s) {            
            $syncData[ $s] = ['role_type' => 'member'];
        }

        $team->students()->sync($syncData);

        return redirect('/teams');
    }
    public function delete($id)
    {
        $team = Team::find($id);
        return view('teams.delete',['team' => $team]);
    }
    public function processDelete($id)
    {
        $team = Team::find($id);
        $team->delete();
        return redirect('/teams');
    }
}
