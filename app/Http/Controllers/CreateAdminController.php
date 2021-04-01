<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\UnitCoordinator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateAdminController extends Controller
{
    //
    public function view()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admins.view',[
            'admins' => $admins
        ]);
    }

    // show the form
    public function create()
    {
        
        return view('admins.create',[
        ]);

    }

    // process the form
    public function processCreate(Request $request) {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');

        $email_address = $request->input('email_address');
        $password = $request->input('password');
        
        $user = new User();

        $user->name = $first_name . " " . $last_name;
        $user->password =  Hash::make($password);
        $user->email = $email_address;
        $user->role = 'admin';
        $user->save();
     

        return redirect('/admins');

    }

    public function update(User $ad) {

        return view('admins.update',[
    
            'ad' => $ad
        ]);
    }

    public function processUpdate(User $ad, Request $request) {
        $name = $request->input('name');
        
        $email_address = $request->input('email');
        $password = $request->input('password');
           
        
        $ad->name = $name;
        if ($password) {
            $ad->password =  Hash::make($password);
        }        
        $ad->email = $email_address;
        $ad->role = 'admin';
        $ad->save();

        return redirect('/admins');

    }
    public function delete($id)
    {
        $ad = User::find($id);
        return view('admins.delete',[
            'ad'=> $ad
        ]);
    }
    public function processDelete($id) {
        $all_users = User::find($id);
        $all_users->delete();
        return redirect('/admins');
    }
}

