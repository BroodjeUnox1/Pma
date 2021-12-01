<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\role;
use App\Models\klas;
use App\Models\user;



class KlassenController extends Controller
{
    // check zodat studenten niet op deze pagina kunnen komen
    public function show() {
    	$klassen = klas::all();
    	$user = user::whereRoleIs("student")->get();
        if (Auth::user()->hasRole("root")) {
            return view('klassen', ["klassen" => $klassen, "users" => $user]);
        }elseif (Auth::user()->hasRole("admin")) {
            return view('klassen', ["klassen" => $klassen, "users" => $user]);
        }elseif (Auth::user()->hasRole("docent")) {
            return view('klassen', ["klassen" => $klassen, "users" => $user]);
        }elseif (Auth::user()->hasRole("student")) {
            return redirect("dashboard");
        }
    }

    public function show_create() {
    	$klassen = klas::all();
    	$user = user::whereRoleIs("student")->get();
        if (Auth::user()->hasRole("root")) {
            return view('create-klassen', ["klassen" => $klassen, "users" => $user]);
        }elseif (Auth::user()->hasRole("admin")) {
            return view('create-klassen', ["klassen" => $klassen, "users" => $user]);
        }elseif (Auth::user()->hasRole("docent")) {
        	return redirect("dashboard");
        }elseif (Auth::user()->hasRole("student")) {
            return redirect("dashboard");
        }
    }

    public function insertklas(Request $request){
        $klas = new klas;
        $klas->leerling1 = $request->input("leerling1");
        $klas->leerling2 = $request->input("leerling2");
        $klas->leerling3 = $request->input("leerling3");
        $klas->leerling4 = $request->input("leerling4");
        $klas->leerling5 = $request->input("leerling5");
        $klas->klascode = $request->input("klas");
        $klas->leerjaar = $request->input("leerjaar");
        $klas->save();
        $klassen = klas::all();
        $user = user::whereRoleIs("student")->get();
        return redirect('klassen')->with(['klassen' => $klassen, "users" =>  $user]);

    }
}
