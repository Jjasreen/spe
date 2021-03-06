<?php

namespace App\Http\Controllers;

use App\Models\UnitCoordinator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UnitCoordinatorController extends Controller
{
    //
    public function view()
    {
        $unit_coordinators = UnitCoordinator::all();
        return view('unit_coordinators.view',[
            'unit_coordinators' => $unit_coordinators
        ]);
    }

    // show the form
    public function create()
    {
        
        return view('unit_coordinators.create',[
        ]);

    }

    // process the form
    public function processCreate(Request $request) {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $unit_code = $request->input('unit_code');
        $teaching_period = $request->input('teaching_period');
        $email_address = $request->input('email_address');
        $password = $request->input('password');
        
        $user = new User();

        $user->name = $first_name . " " . $last_name;
        $user->password =  Hash::make($password);
        $user->email = $email_address;
        $user->role = 'UC';
        $user->save();
        $unit_coordinator = new UnitCoordinator();
        $unit_coordinator->first_name = $first_name;
        $unit_coordinator->last_name = $last_name;
        $unit_coordinator->unit_code = $unit_code;
        $unit_coordinator->teaching_period = $teaching_period;
        $unit_coordinator->user_id = $user->id;
        $unit_coordinator->save();

        return redirect('/unit_coordinators');

    }

    public function update(UnitCoordinator $uc) {
        $all_users = User::pluck('name', 'id');
        return view('unit_coordinators.update',[
            'all_users' => $all_users,
            'uc' => $uc
        ]);
    }

    public function processUpdate(UnitCoordinator $uc, Request $request) {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $unit_code = $request->input('unit_code');
        $teaching_period = $request->input('teaching_period');
        $user_id = $request->input('user_id');        
        
        $uc->first_name = $first_name;
        $uc->last_name = $last_name;
        $uc->unit_code = $unit_code;
        $uc->teaching_period = $teaching_period;
        $uc->user_id = $user_id;
        $uc->save();

        return redirect('/unit_coordinators');

    }
    public function delete($id)
    {
        $uc = UnitCoordinator::find($id);
        return view('unit_coordinators.delete',[
            'uc'=> $uc
        ]);
    }
    public function processDelete($id) {
        $all_users = UnitCoordinator::find($id);
        $user = $all_users->user;
        $all_users->delete();


        $user->delete();

        
        return redirect('/unit_coordinators');
    }
}
