<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = DB::table('doctors')
        ->when($request->input(''), function ($query, $doctor_name){
            $query->where('doctor_name', 'like','%' . $doctor_name . '%');
        })
        ->orderBy('id','desc')
        ->get();
        // return json 200
        return response([
            'data' => $doctors,
            'message' => 'Success',
            'status' => 'OK'
        ], 200);
    }
}
