<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gender;
use App\Service;
use App\Patient;
use Carbon\Carbon;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $patints = Patient::with(['gender', 'service'])->get();
        // dd($patints);

        return response()->json(['services' => Service::all(),
                                'genders' => Gender::all(),
                            'patients' => $patints], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        $patient = new Patient;
        $patient->name = $request->name;
        $patient->dob = Carbon::parse($request->dob)->format('Y-m-d');
        $patient->gender_id = $request->gender;
        $patient->service_id = $request->service;
        $patient->comments = $request->comments;
        $patient->save();

        $patients = Patient::with(['gender', 'service'])->get();

        return response()->json(['patients' => $patients], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
