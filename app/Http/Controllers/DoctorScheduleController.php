<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;

class DoctorScheduleController extends Controller
{
    //index
    public function index(Request $request)
    {
        $doctorSchedules = DoctorSchedule::with('doctor')
        ->when($request->input('doctor_id'), function ($query, $doctor_id){
            return $query->where('doctor_id', $doctor_id);
    })
    ->orderBy('doctor_id','asc')
    ->paginate(10);
    return view('pages.doctors_schedules.index', compact('doctorSchedules'));
    }

    public function create()
    {
        $doctor = Doctor::all();
        return view('pages.doctors_schedules.index', compact('doctors'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id'=> 'required',
            'day'=> 'required',
            'time'=> 'required',
        ]);

        $doctorSchedules = new Doctor;
        $doctorSchedules->doctor_id = $request->doctor_id;
        $doctorSchedules->day = $request->day;
        $doctorSchedules->time = $request->time;
        $doctorSchedules->status = $request->status;
        $doctorSchedules->note = $request->note;
        $doctorSchedules->save();

        return redirect()->route('doctors_schedules.index')->with('success','Berhasil');
    }

    // edit
    public function edit($id)
    {
        $doctorSchedules = DoctorSchedule::find($id);
        $doctor = Doctor::all();
        return view('pages.doctors_schedules.edit', compact('doctorSchedule','doctors'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id'=> 'required',
            'day'=> 'required',
            'time'=> 'required',
        ]);

        $doctorSchedules = DoctorSchedule::find($id);
        $doctorSchedules->doctor_id = $request->doctor_id;
        $doctorSchedules->day = $request->day;
        $doctorSchedules->time = $request->time;
        $doctorSchedules->status = $request->status;
        $doctorSchedules->note = $request->note;
        $doctorSchedules->save();
        return redirect()->route('doctors_schedules.index')->with('success','Berhasil Mengedit');
    }

    public function destroy($id)
    {
        DoctorSchedule::find($id)->delete();
        return redirect()->route('doctors_schedules.index')->with('success','Berhasil menghapus data');
    }




}
