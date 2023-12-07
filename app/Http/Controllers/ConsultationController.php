<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Diagnosis;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Symptom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultation::withTrashed()->where('user_id', Auth::id())->where('profile_id', Session::get('profile'))->whereDate('created_at', Carbon::today())->latest()->get();
        return view('backend.consultation.index', compact('consultations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $symptoms = Symptom::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name')->toArray();
        $diagnoses = Diagnosis::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name')->toArray();
        $patient = Patient::findOrFail(decrypt($id));
        $medicines = Medicine::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'id')->toArray();
        return view('backend.consultation.create', compact('patient', 'symptoms', 'diagnoses', 'medicines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $patient = "";
        $fee = profile()->fee;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
