<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // scanned op role welke dashboard je krijgt te zien
    public function index() {
    	if (Auth::user()->hasRole("root")) {
    		return view("root.root-page");
    	}elseif (Auth::user()->hasRole("admin")) {
    		return view("admin.admin-page");
    	}elseif (Auth::user()->hasRole("docent")) {
    		return view("docent.docent-page");
    	}elseif (Auth::user()->hasRole("student")) {
    		return view("student.student-page");
    	}
    }
}
