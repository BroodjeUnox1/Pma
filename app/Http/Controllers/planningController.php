<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cursussen;
use App\Models\progress;
use App\Models\feedback;
use Illuminate\Support\Facades\Auth;

class planningController extends Controller
{
    // laat alle planningen zien
    // is hij of zij student laat alleen zijn planningen zien    
    public function show_planning() {
        if(Auth::user()->hasRole("student")){
            $user = Auth::user();
            $klas = $user["klas"];
            $periode = 1;
            $leerjaar = $user["leerjaar"];
            $progress = progress::all();
            $feedback = feedback::where([['userid', '=', $user["id"]], ['periode', '=', $periode]])->first();
            $data = cursussen::where([["klas", '=', $klas], ["periode", '=', $periode], ["leerjaar", '=', $leerjaar]])->get();
        }else {
            $klas = 1;
            $periode = 1;
            $leerjaar = 1;
            $progress = progress::all();
            $data = cursussen::where([["klas", '=', $klas], ["periode", '=', $periode], ["leerjaar", '=', $leerjaar]])->get();
        }

    	// checkt meteen welke data hij mee krijgt en per rol
        if (Auth::user()->hasRole("root")) {           
            return view('planningen', ['data' => $data, 'klas' => $klas, 'periode' => $periode, 'leerjaar' => $leerjaar, 'progress' => $progress]);
        }elseif (Auth::user()->hasRole("admin")) {          
            return view('planningen', ['data' => $data, 'klas' => $klas, 'periode' => $periode, 'leerjaar' => $leerjaar, 'progress' => $progress]);
        }elseif (Auth::user()->hasRole("docent")) {     
            return view('planningen', ['data' => $data, 'klas' => $klas, 'periode' => $periode, 'leerjaar' => $leerjaar, 'progress' => $progress]);
        }elseif (Auth::user()->hasRole("student")) {    
            return view('planningen', ['data' => $data, 'klas' => $klas, 'periode' => $periode, 'leerjaar' => $leerjaar, 'progress' => $progress, 'feedback' => $feedback]);
        }
    }

    // search function voor docent en student
    // student kan allen van eigen leerjaar enzo veranderen.
    public function search(Request $request) {
            if(Auth::user()->hasRole("student")){
                $user = auth::user();
                $klas = $user['klas'];
                $periode = $request->input("periode");
                $leerjaar = $user['leerjaar'];
                $feedback = feedback::where([['userid', '=', $user["id"]], ['periode', '=', $periode]])->first();
                $progress = progress::all();
            }else {
                $user = auth::user();
                $klas = $request->input("klas");
                $periode = $request->input("periode");
                $leerjaar = $request->input("leerjaar");
                $feedback = feedback::where([['userid', '=', $user["id"]], ['periode', '=', $periode]])->first();
                $progress = progress::all();
            }
       
           $data = cursussen::where([["klas", '=', $klas], ["periode", '=', $periode], ["leerjaar", '=', $leerjaar]])->get();
           return view('planningen', ['data' => $data, 'klas' => $klas, 'periode' => $periode, 'leerjaar' => $leerjaar, 'progress' => $progress, 'feedback' => $feedback]);
    }

    public function oneitem($id) {
        $showCursus = cursussen::find($id);
        if($showCursus['klas'] == auth::user()['klas'] && Auth::user()->hasRole("student")){
            $data = progress::where([["crusus_id", '=', $id], ["name", '=', auth::user()['name']]])->get();
            return view('oneitem', ['cursus' => $showCursus, 'progress' => $data]);
        }else if(!Auth::user()->hasRole("student")) {
            $data = progress::where([["crusus_id", '=', $id], ["name", '=', auth::user()['name']]])->get();
            return view('oneitem', ['cursus' => $showCursus, 'progress' => $data]);
        }else {
            return redirect('dashboard');
        }
        
    }  


    // progress editor voor de studenten
    public function progress(Request $request, $id) {
        $check = progress::where([["crusus_id", '=', $id], ["name", '=', auth::user()['name']], ['vak_id', '=', $request->input("vak_id")]])->get();
        // checkt eerst of er al niet een bestaat voor dat vak dit voorkomt duplicates met andere values
        // is die leeg maag nieuwe record aan
        if($check->isEmpty()){
            $progress = new progress;
            $progress->crusus_id = $id;
            $progress->beoordeling = $request->input("progressie");
            $progress->vak_id = $request->input("vak_id");
            $progress->name = auth::user()['name'];
            $progress->save();

            $showCursus = cursussen::find($id);
            $data = progress::where([["crusus_id", '=', $id], ["name", '=', auth::user()['name']]])->get();
            return view('oneitem', ['cursus' => $showCursus, 'progress' => $data]);
        }else {
            $check = progress::where([["crusus_id", '=', $id], ["name", '=', auth::user()['name']], ['vak_id', '=', $request->input("vak_id")]])->first();
            $check->crusus_id = $id;
            $check->beoordeling = $request->input("progressie");
            $check->vak_id = $request->input("vak_id");
            $check->name = auth::user()['name'];
            $check->save(); 
            $showCursus = cursussen::find($id);
            $data = progress::where([["crusus_id", '=', $id], ["name", '=', auth::user()['name']]])->get();
            return view('oneitem', ['cursus' => $showCursus, 'progress' => $data]);  
        }
    } 
}
