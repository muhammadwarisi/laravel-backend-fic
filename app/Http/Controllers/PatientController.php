<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // get all paginatated
        // search patient by nik
        $patients = DB::table('patients')
        ->when($request->input('nik'), function ($query, $name){
            return $query->where('nik', 'Like', '%'.$name.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view("pages.patients.index", compact("patients"));
    }
}
