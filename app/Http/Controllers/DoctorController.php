<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;


use function Laravel\Prompts\table;

class DoctorController extends Controller
{
    //index
    public function index(Request $request)
    {
        $doctors = DB::table('doctors')
        ->when($request->input('name'), function ($query, $doctor_name){
            return $query->where('doctor_name', 'Like', '%'.$doctor_name.'%');
        })
        ->orderBy('id', 'desc')
        ->paginate(5);


        return view('pages.doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('pages.doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_name' => 'required',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_email' => 'required',
            'address'=> 'required',
            'photo' => 'required',
            'sip' => 'required',
            'id_ihs' => 'required',
            'nik' => 'required',

        ]);

        $doctor = DB::table('doctors')->insert([
            'doctor_name' => $request->doctor_name,
            'doctor_specialist' => $request->doctor_specialist,
            'doctor_phone' => $request->doctor_phone,
            'doctor_email' => $request->doctor_email,
            'sip' => $request->sip,
            'address' => $request->address,
            'id_ihs' => $request->id_ihs,
            'nik' => $request->nik,
        ]);


        // $doctor= new Doctor;
        // $doctor->doctor_name = $request->doctor_name;
        // $doctor->doctor_specialist = $request->doctor_specialist;
        // $doctor->doctor_phone = $request->doctor_phone;
        // $doctor->doctor_email = $request->doctor_email;
        // $doctor->address = $request->address;
        // $doctor->sip = $request->sip;
        // $doctor->id_ihs = $request->id_ihs;
        // $doctor->nik = $request->nik;
        // $doctor->save();

        // if image exist
        if ($request->file('photo')) {
            $photo = $request->file('photo');
            $photo_name = time().'.'.$photo->extension();
            $photo->move(public_path('images'), $photo_name);
            DB::table('doctors')->where('id',DB::getPdo()->lastInsertId())->update([
                'photo' => $photo_name
            ]);
        }

        // if ($request->hasFile('photo')) {
        //     $image = $request->file('photo');
        //     $image->storeAs('public/doctors', $doctor->id .'.'. $image->getClientOriginalExtension());
        //     $doctor->photo = 'storage/doctors/'. $doctor->id .'.'. $image->getClientOriginalExtension();
        //     $doctor->save();
        // }

        return redirect()->route('doctors.index')->with('success', 'Doctor created Successfully');
    }

    // show
    public function show($id)
    {
        $doctor = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctors.show', compact('doctor'));
    }

    // edit
    public function edit($id)
    {
        $doctor = DB::table('doctors')->where('id', $id)->first();
        return view('pages.doctors.edit', compact('doctor'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_name' => 'required',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_email' => 'required|email',
            'sip' => 'required',
            ]);

            DB::table('doctors')->where('id', $id)->update([
            'doctor_name' => $request->doctor_name,
            'doctor_specialist' => $request->doctor_specialist,
            'doctor_phone' => $request->doctor_phone,
            'doctor_email' => $request->doctor_email,
            'sip' => $request->sip,
            ]);

            return redirect()->route('doctors.index')->with('success', 'Doctor updated Successfully');
    }

    public function destroy($id)
    {
        DB::table('doctors')->where('id', $id)->delete();
        return redirect()->route('doctors.index')->with('success', 'Doctor Deleted Successfully');
    }
}
