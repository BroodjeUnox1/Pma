<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\progress;
use App\Models\cursussen;
use App\Models\feedback;

class VoortgangController extends Controller
{
    // laat alle studenten zien 
    public function show() {
        // selecteer alleen studenten
        $data = user::whereRoleIs("student")->get();

        if (Auth::user()->hasRole("root")) {
            return view("voortgang", ['data' => $data]);
        }elseif (Auth::user()->hasRole("admin")) {
            return view("voortgang", ['data' => $data]);
        }elseif (Auth::user()->hasRole("docent")) {
            return view("voortgang", ['data' => $data]);
        }elseif (Auth::user()->hasRole("student")) {
            return redirect('dashboard');
        }
    }


    public function search(Request $request){

        if(!empty($request->input('student'))){
            $data = user::where([['name', '=', $request->input('student')]])->get();
            return view("voortgang", ['data' => $data]);
        }else{
            $data = user::where([['leerjaar', '=', $request->input('leerjaar')], ['klas', '=', $request->input('klas')]])->get();
            return view("voortgang", ['data' => $data]);
        }
        // if(!empty($request->input('student'))){
        //     $data = user::where([['name', '=', $request->input('student')]])->get();
        //     return view("voortgang", ['data' => $data]);
        // }else {
        //     $data = user::where([['leerjaar', '=', $request->input('leerjaar')], ['klas', '=', $request->input('klas')]])->get();
        //     return view("voortgang", ['data' => $data]);
        // }
        
    }

    public function show_one($id){
        $user = user::find($id);
        if(empty($user)){
            $data = user::whereRoleIs("student")->get();
            return redirect("voortgang")->with(['data' => $data]);
        } 
        $check = feedback::where([['userid', '=', $id], ['periode', '=', '1']])->first();  
        $showCursus = cursussen::where([['periode', '=', 1], ['leerjaar', '=', $user['leerjaar']], ['klas', '=', $user['klas']]])->get();
        $data = progress::where([["name", '=', $user['name']]])->get();

        return view("voortgangStudent", ['cursus' => $showCursus, 'progress' => $data, 'id' => $id, 'feedback' => $check]);
    }


    public function show_one_search(Request $request, $id){
        // Checked welke post request we pakken
        if($request->input('option') == 1){
            $user = user::find($id);
            $check = feedback::where([['userid', '=', $request->input('user')], ['periode', '=', $request->input('periode')]])->first();
            $showCursus = cursussen::where([['periode', '=', $request->input('periode')], ['leerjaar', '=', $user['leerjaar']], ['klas', '=', $user['klas']]])->get();
            $data = progress::where([["name", '=', $user['name']]])->get();
            //return $showCursus;
            return view("voortgangStudent", ['cursus' => $showCursus, 'progress' => $data, 'id' => $id, 'selected' => $request->input('periode'), 'feedback' => $feedback]);
        }else {
            // checkt of er al 1 bestaat zo ja pas hem aan zo nee maak nieuw
            $check = feedback::where([['userid', '=', $request->input('user')], ['periode', '=', $request->input('periode')]])->first();
            if(empty($check)){
                $db = new feedback;
                $db->userid = $request->input('user');
                $db->feedback = $request->input('feedback');
                $db->periode = $request->input('periode');
                $db->save();
                $user = user::find($id);
                $showCursus = cursussen::where([['periode', '=', $request->input('periode')], ['leerjaar', '=', $user['leerjaar']], ['klas', '=', $user['klas']]])->get();
                $data = progress::where([["name", '=', $user['name']]])->get();
                return view("voortgangStudent", ['cursus' => $showCursus, 'progress' => $data, 'id' => $id, 'selected' => $request->input('periode'), 'feedback' => $check]);
            }else {
                $check->feedback = $request->input('feedback');
                $check->save();
                $user = user::find($id);
                $check = feedback::where([['userid', '=', $request->input('user')], ['periode', '=', $request->input('periode')]])->first();
                $showCursus = cursussen::where([['periode', '=', $request->input('periode')], ['leerjaar', '=', $user['leerjaar']], ['klas', '=', $user['klas']]])->get();
                $data = progress::where([["name", '=', $user['name']]])->get();
                return view("voortgangStudent", ['cursus' => $showCursus, 'progress' => $data, 'id' => $id, 'selected' => $request->input('periode'), 'feedback' => $check]);
            } 
        }   
    }    
}
