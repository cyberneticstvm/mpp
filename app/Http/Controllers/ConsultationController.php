<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Diagnosis;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\PatientDiagnosis;
use App\Models\PatientMedicine;
use App\Models\PatientSymptom;
use App\Models\PatientTest;
use App\Models\Symptom;
use App\Models\Test;
use Carbon\Carbon;
use Exception;
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
        $symptoms = Symptom::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name');
        $diagnoses = Diagnosis::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name');
        $tests = Test::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name');
        $patient = Patient::findOrFail(decrypt($id));
        $medicines = Medicine::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'id')->toArray();
        return view('backend.consultation.create', compact('patient', 'symptoms', 'diagnoses', 'medicines', 'tests'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pid' => 'required',
        ]);
        $review_date = ($request->review_date) ? Carbon::createFromFormat('d, F Y', $request->review_date)->format('Y-m-d') : NULL;
        try {
            $cid = Consultation::insertGetId([
                'user_id' => Auth::id(),
                'profile_id' => Session::get('profile'),
                'patient_id' => decrypt($request->pid),
                'medical_record_number' => generateMedicalRecordNumber()->mrn,
                'medical_history' => $request->medical_history,
                'examination' => $request->examination,
                'investigation' => $request->investigation,
                'advice' => $request->advice,
                'notes' => $request->remarks,
                'allergic_drugs' => $request->allergic_drugs,
                'surgery_advised' => $request->surgery_advised,
                'review_date' => $review_date,
                'fee' => 0,
                'review' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $symptoms = $request->symptoms;
            if ($symptoms) :
                foreach ($symptoms as $key => $item) :
                    $sdata[] = [
                        'consultation_id' => $cid,
                        'name' => $item,
                    ];
                endforeach;
                PatientSymptom::insert($sdata);
            endif;
            $diagnoses = $request->diagnosis;
            if ($diagnoses) :
                foreach ($diagnoses as $key => $item) :
                    $ddata[] = [
                        'consultation_id' => $cid,
                        'name' => $item,
                    ];
                endforeach;
                PatientDiagnosis::insert($ddata);
            endif;
            $tests = $request->tests;
            if ($tests) :
                foreach ($tests as $key => $item) :
                    $tdata[] = [
                        'consultation_id' => $cid,
                        'name' => $item,
                    ];
                endforeach;
                PatientTest::insert($tdata);
            endif;
            $medicines = $request->medicines;
            if ($medicines) :
                foreach ($medicines as $key => $item) :
                    if ($item > 0) :
                        $mdata[] = [
                            'consultation_id' => $cid,
                            'medicine_id' => $item,
                            'qty' => $request->qty[$key],
                            'dosage' => $request->dosage[$key],
                            'duration' => $request->duration[$key],
                            'notes' => $request->notes[$key],
                        ];
                    endif;
                endforeach;
                if (!empty($mdata)) PatientMedicine::insert($mdata);
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('consultation')->with("success", "Consultation created successfully");
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
        $consultation = Consultation::findOrFail(decrypt($id));
        $symptoms = Symptom::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name');
        $diagnoses = Diagnosis::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name');
        $tests = Test::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'name');
        $medicines = Medicine::distinct('name')->where('user_id', Auth::id())->orderBy('name')->pluck('name', 'id')->toArray();
        return view('backend.consultation.edit', compact('consultation', 'symptoms', 'diagnoses', 'medicines', 'tests'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $review_date = ($request->review_date) ? Carbon::createFromFormat('d, F Y', $request->review_date)->format('Y-m-d') : NULL;
        try {
            Consultation::findOrFail($id)->update([
                'medical_history' => $request->medical_history,
                'examination' => $request->examination,
                'investigation' => $request->investigation,
                'advice' => $request->advice,
                'notes' => $request->remarks,
                'allergic_drugs' => $request->allergic_drugs,
                'surgery_advised' => $request->surgery_advised,
                'review_date' => $review_date,
                'updated_at' => Carbon::now(),
            ]);
            $symptoms = $request->symptoms;
            if ($symptoms) :
                foreach ($symptoms as $key => $item) :
                    $sdata[] = [
                        'consultation_id' => $id,
                        'name' => $item,
                    ];
                endforeach;
                PatientSymptom::where('consultation_id', $id)->delete();
                PatientSymptom::insert($sdata);
            endif;
            $diagnoses = $request->diagnosis;
            if ($diagnoses) :
                foreach ($diagnoses as $key => $item) :
                    $ddata[] = [
                        'consultation_id' => $id,
                        'name' => $item,
                    ];
                endforeach;
                PatientDiagnosis::where('consultation_id', $id)->delete();
                PatientDiagnosis::insert($ddata);
            endif;
            $tests = $request->tests;
            if ($tests) :
                foreach ($tests as $key => $item) :
                    $tdata[] = [
                        'consultation_id' => $id,
                        'name' => $item,
                    ];
                endforeach;
                PatientTest::where('consultation_id', $id)->delete();
                PatientTest::insert($tdata);
            endif;
            $medicines = $request->medicines;
            if ($medicines) :
                foreach ($medicines as $key => $item) :
                    if ($item > 0) :
                        $mdata[] = [
                            'consultation_id' => $id,
                            'medicine_id' => $item,
                            'qty' => $request->qty[$key],
                            'dosage' => $request->dosage[$key],
                            'duration' => $request->duration[$key],
                            'notes' => $request->notes[$key],
                        ];
                    endif;
                endforeach;
                if (!empty($mdata)) :
                    PatientMedicine::where('consultation_id', $id)->delete();
                    PatientMedicine::insert($mdata);
                endif;
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
        return redirect()->route('consultation')->with("success", "Consultation updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Consultation::findOrFail(decrypt($id))->delete();
        return redirect()->route('consultation')->with("success", "Consultation deleted successfully");
    }
}
