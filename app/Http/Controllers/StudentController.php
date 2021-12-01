<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\role;
use Illuminate\Support\Facades\Auth;


class StudentController extends Controller
{
    // laat alle studenten zien
    public function show() {
    	
    	if (Auth::user()->hasRole("root")) {
    		$data = user::all();
    		return view('root.studenten', ["data" => $data]);
        }elseif (Auth::user()->hasRole("admin")) {
            return view("dashboard");
        }elseif (Auth::user()->hasRole("docent")) {
            return view("dashboard");
        }elseif (Auth::user()->hasRole("student")) {
            return redirect('dashboard');
        }
    }

    // update role
	public function update(Request $request) {
        if($request->input("option") == 1){
            $user = user::find($request->input("id"));
            $user->klas = $request->input('klas');
            $user->name = $request->input('name');
            $user->leerjaar = $request->input('leerjaar');
            $user->syncRoles([$request->input("role")]);
            $user->save();
            $data = user::all();
            return redirect('studenten')->with(['data' => $data]);
        } else {
            $user = user::find($request->input("id"));
            $user->delete();
            $data = user::all();
            return redirect('studenten')->with(['data' => $data]);
        }
        
    }
}
