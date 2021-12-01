<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cursussen;
use Illuminate\Support\Facades\Auth;


class CursusController extends Controller
{
    // showed create curus pagina
    public function show() {
    	
        if (Auth::user()->hasRole("root")) {
            return view('create-cursus');
        }elseif (Auth::user()->hasRole("admin")) {
            return view('create-cursus');
        }elseif (Auth::user()->hasRole("docent")) {
            return view('create-cursus');
        }elseif (Auth::user()->hasRole("student")) {
            return redirect("dashboard");
        }
    }

    // laat de cursus zien die je wilt updaten
    public function show_update($id) {
        $show_update = cursussen::find($id);
        //check voor of dat id wel bestaat in db
        if(empty($show_update)){
            return redirect('create-cursus');
        }
        //root mag alles zien
        if (Auth::user()->hasRole("root")) {
            return view('update-cursus', ["info" => $show_update]);
        }elseif (Auth::user()->hasRole("admin")) {                  // admin mag alles zien
            return view('update-cursus', ["info" => $show_update]);;
        }elseif (Auth::user()->hasRole("docent")) { // docent mag alleen zijn eigen zien
            $user = Auth::user();
            if ($show_update["madeby"] == $user['name']) {
                return view('update-cursus', ["info" => $show_update]);
            } else {
                $data = cursussen::all();
                $user = Auth::user("name");
                return redirect('cursussen')->with(['cursussen' => $data, "user" =>  $user["name"]]);
            }    
        }elseif (Auth::user()->hasRole("student")) {        // studenten worden meteen geredirect
            return redirect("dashboard");
        }
    }

    // update de cursus
    public function update(Request $request) {
        $opdrachten = array();
        $all = $request->all();
        $num= 0;
        // zorgt ervoor dat er een array in db komt zodat je niet static amount of opdrachten heb
        foreach($all as $row) {
            if($num >= 10){
                array_push($opdrachten, $row);
                $num += 1;
            }else {
                $num +=1;
            }    
        }
        $cursussen = cursussen::find($request->input("id"));
        $cursussen->vak = $request->input("vak");
        $cursussen->onderwerp = $request->input("onderwerp");
        $cursussen->klas = $request->input("klas");
        $cursussen->periode = $request->input("periode");
        $cursussen->leerjaar = $request->input("leerjaar");
        $cursussen->opdrachten = $request->input("opdrachten");
        $cursussen->info = $request->input("info");
        $cursussen->opdrachtlist = $opdrachten;
        $cursussen->save();
        $data = cursussen::all();
        $user = Auth::user("name");
        return redirect('cursussen')->with(['cursussen' => $data, "user" =>  $user["name"]]);
    }

    // laat een specifieke cursus zien
    public function specific($id) {
    	$showCursus = cursussen::find($id);
    	return view('student.singel-cursus', ['info' => $showCursus, "list" =>$list]);
    }

    // laat je alle cursusen zien
	public function show_cursus() {
		$data = cursussen::all();
        $user = Auth::user("name");
        return view('cursussen', ['cursussen' => $data, "user" =>  $user["name"]]);
    }

    // maakt nieuwe cursus in db
    public function create(Request $request) {

        $opdrachten = array();
        $all = $request->all();
        $num= 0;
        // zorgt ervoor dat er een array in db komt zodat je niet static amount of opdrachten heb
        foreach($all as $row) {
            if($num >= 9){
                array_push($opdrachten, $row);
                $num += 1;
            }else {
                $num +=1;
            }    
        }
        
    	$cursussen = new cursussen;
    	$cursussen->vak = $request->input("vak");
        $cursussen->onderwerp = $request->input("onderwerp");
        $cursussen->periode = $request->input("periode");
        $cursussen->leerjaar = $request->input("leerjaar");
        $cursussen->klas = $request->input("klas");
        $cursussen->opdrachten = $request->input("opdrachten");
        $cursussen->info = $request->input("info");
        $cursussen->opdrachtlist = json_encode($opdrachten);
        $user = Auth::user("name");
        $cursussen->madeby = $user["name"];
    	$cursussen->save();
    	$data = cursussen::all();
    	$user = Auth::user("name");

        return redirect('cursussen')->with(['cursussen' => $data, "user" => $user["name"]]);
    }

    public function search(Request $request){
        if($request->input('option') == 1){
            $data = cursussen::where([['klas', '=', $request->input('klas')], ['periode', '=', $request->input('periode')], ['leerjaar', '=', $request->input('leerjaar')]])->get();
            $user = Auth::user("name");
            return view('cursussen', ['cursussen' => $data, "user" =>  $user["name"]]);
        } else {
            $delete = cursussen::find($request->input('id'));
            $delete->delete();
            return redirect("cursussen"); 
        }    
    }
}
