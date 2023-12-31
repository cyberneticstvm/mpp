<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Document;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::whereDate('created_at', Carbon::today())->latest()->get();
        return view('backend.document.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'document' => 'required|mimes:jpg,jpeg,png,docx,xlsx,pdf,csv|max:1024',
            'mrn' => 'required',
        ]);
        $input = $request->all();
        try {
            $consultation = Consultation::where('medical_record_number', $request->mrn)->firstOrFail();
            if ($consultation) :
                if ($request->file('document')) :
                    //$url = uploadFile($request->file('document'), $path = 'uploads/document/' . $consultation->id);
                    $url = uploadFile($request->file('document'), $path = 'documents/' . Auth::id() . '/' . profile()->id);
                    $input['document'] = $url;
                endif;
                $input['user_id'] = Auth::id();
                $input['profile_id'] = Session::get('profile');
                $input['patient_id'] = $consultation->patient_id;
                $input['consultation_id'] = $consultation->id;
                $input['mrn'] = $consultation->medical_record_number;
                Document::create($input);
            endif;
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Document uploaded successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            'query_string' => 'required',
        ]);
        $documents = Document::where('user_id', Auth::id())->where('mrn', 'like', '%' . $request->query_string . '%')->get();
        return view('backend.document.show', compact('documents'));
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
        Document::findOrFail(decrypt($id))->delete();
        return redirect()->route('document')->with("success", "Document deleted successfully");
    }
}
