<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\UnitCoordinator;
use Carbon\Exceptions\UnitException;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class ModuleController extends Controller
{
    //
    public function view()
    {
        // $modules = Module::with('unit_coordinator')->get();     <-- eager loading
        $modules = Module::all();
        return view('modules.view', [
            'modules' => $modules
        ]);
    }

    //show the form
    public function create()
    {
        $all_uc = UnitCoordinator::pluck('first_name', 'id');
        return view('modules.create', [
            'all_uc' => $all_uc
        ]);
    }

    public function processCreate(Request $request)
    {
        $unit_code = $request->input('unit_code');
        $module_name = $request->input('module_name');
        $unit_coordinator_id = $request->input('unit_coordinator_id');

        $modules = new Module();
        $modules->unit_code = $unit_code;
        $modules->module_name = $module_name;
        $modules->unit_code = $unit_code;
        $modules->unit_coordinator_id = $unit_coordinator_id;
        $modules->save();

        return redirect('/modules');
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
        $unit_coordinator_id = $request->input('unit_coordinator_id');

        $m->unit_code = $unit_code;
        $m->module_name = $module_name;
        $m->unit_code = $unit_code;
        $m->unit_coordinator_id = $unit_coordinator_id;
        $m->save();

        return redirect('/modules');

    }
    public function delete($id)
    {
        $m = Module::find($id);
        return view ('modules.delete',['m'=> $m]);
    }
    public function processDelete($id)
    {
        $all_uc = Module::find($id);
        $all_uc->delete();
        return redirect('/modules');
    }
}
