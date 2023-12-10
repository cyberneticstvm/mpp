@extends("backend.base")
@section("content")
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Consultation / Medical Record create</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Create Consultation / Medical Record Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-12 xl-100">
                <div class="card">
                    {{ html()->form('POST', route('consultation.save'))->class('theme-form frmConsultation')->open() }}
                    @csrf
                    <input type="hidden" name="pid" value="{{ encrypt($patient->id) }}" />
                    <div class="card-body">
                        <ul class="nav nav-tabs border-tab" id="top-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="pills-clrhome-tab" data-bs-toggle="pill" href="#pills-clrhome" role="tab" aria-controls="pills-clrhome" aria-selected="true"><i class="icofont icofont-user"></i>Patient Details</a></li>
                            <li class="nav-item"><a class="nav-link" id="pills-clrprofile-tab" data-bs-toggle="pill" href="#pills-clrprofile" role="tab" aria-controls="pills-clrprofile" aria-selected="false"><i class="icofont icofont-stethoscope"></i>Clinical Details</a></li>
                            <li class="nav-item"><a class="nav-link" id="pills-clrcontact-tab" data-bs-toggle="pill" href="#pills-clrcontact" role="tab" aria-controls="pills-clrcontact" aria-selected="false"><i class="icofont icofont-pills"></i>Drugs / Medicines</a></li>
                            <li class="nav-item"><a class="nav-link" id="pills-clrcontact-tab" data-bs-toggle="pill" href="#pills-clrlab" role="tab" aria-controls="pills-clrlab" aria-selected="false"><i class="icofont icofont-blood-drop"></i>Lab Tests</a></li>
                        </ul>
                        <div class="tab-content" id="top-tabContent">
                            <div class="tab-pane fade active show" id="pills-clrhome" role="tabpanel" aria-labelledby="pills-clrhome-tab">
                                <div class="row m-t-30">
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Patient Name</label>
                                        {{ html()->text('patient_name', $patient->patient_name)->class('form-control')->attribute('readonly', 'true') }}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Patient Id</label>
                                        {{ html()->text('patient_id', $patient->patient_id)->class('form-control')->attribute('readonly', 'true') }}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Date of Birth</label>
                                        {{ html()->text('dob', $patient->dob?->format('d, F Y'))->class('form-control')->attribute('readonly', 'true') }}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Mobile</label>
                                        {{ html()->text('mobile', $patient->mobile)->class('form-control')->attribute('readonly', 'true') }}
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label class="control-label">Address</label>
                                        {{ html()->text('address', $patient->address)->class('form-control')->attribute('readonly', 'true') }}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-clrprofile" role="tabpanel" aria-labelledby="pills-clrprofile-tab">
                                <div class="row m-t-30">
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Medical History if any</label>
                                        {{ html()->textarea('medical_history', old('medical_history'))->class('form-control')->rows('5')->placeholder('Medical History if any') }}
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Examination</label>
                                        {{ html()->textarea('examination', old('examination'))->class('form-control')->rows('5')->placeholder('Examination') }}
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Symptoms &nbsp;&nbsp;<a class="btn btn-link addSymptom" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to add new Symptom">Add New Symptom</a></label>
                                        {{ html()->select('symptoms[]', $symptoms, old('symptoms'))->class('form-control select2')->attribute('id', 'selSymptom')->multiple() }}
                                        <small>Multiple selection enabled</small>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Diagnosis&nbsp;&nbsp;<a class="btn btn-link addDiagnosis" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to add new Diagnosis">Add New Diagnosis</a></label>
                                        {{ html()->select('diagnosis[]', $diagnoses, old('diagnosis'))->class('form-control select2')->attribute('id', 'selDiagnosis')->multiple() }}
                                        <small>Multiple selection enabled</small>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Investigation</label>
                                        {{ html()->textarea('investigation', old('investigation'))->class('form-control')->rows('5')->placeholder('Investigation') }}
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Advice / Referrals</label>
                                        {{ html()->textarea('advice', old('advice'))->class('form-control')->rows('5')->placeholder('Advice / Referrals') }}
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Is allergic to any drugs?</label>
                                        {{ html()->textarea('allergic_drugs', old('allergic_drugs'))->class('form-control')->rows('5')->placeholder('Specify Details of Allergic Drugs if any') }}
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label class="control-label">Notes / Remarks</label>
                                        {{ html()->textarea('remarks', old('remarks'))->class('form-control')->rows('5')->placeholder('Notes / Remarks') }}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Surgery Advised?</label>
                                        {{ html()->select('surgery_advised', array('no' => 'No', 'yes' => 'Yes'), old('surgery_advised') ?? 'no')->class('form-control')->placeholder('Select') }}
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label class="control-label">Next Review Date</label>
                                        {{ html()->text('review_date', old('review_date'))->class('datepicker-here form-control digits')->attribute('data-language', 'en')->attribute('data-position', 'top left')->attribute('readonly', 'true')->placeholder('day, month year') }}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-clrcontact" role="tabpanel" aria-labelledby="pills-clrcontact-tab">
                                <div class="row m-t-30">
                                    <div class="card border-0">
                                        <div class="table-responsive">
                                            <table class="table border-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Medicine Name <a class="btn btn-link addMedicine" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to add new medicine">Add New Medicine</a></th>
                                                        <th scope="col">Qty</th>
                                                        <th scope="col">Dosage</th>
                                                        <th scope="col">Duration</th>
                                                        <th scope="col">Notes</th>
                                                        <th><a href="javascript:void(0)" class="medRow"><i class="icofont icofont-ui-add" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to add new Row"></i></a></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="medTable">
                                                    <tr>
                                                        <td>
                                                            {{ html()->select('medicines[]', array('' => 'Select') + $medicines, old('medicines'))->class('form-control select2 selMedicine')->attribute('id', 'selMedicine') }}
                                                        </td>
                                                        <td>
                                                            {{ html()->number('qty[]', old('qty')[0] ?? '', '', '', '1')->class('form-control')->placeholder('Qty') }}
                                                        </td>
                                                        <td>
                                                            {{ html()->text('dosage[]', old('dosage')[0] ?? '')->class('form-control')->placeholder('Dosage') }}
                                                        </td>
                                                        <td>
                                                            {{ html()->text('duration[]', old('duration')[0] ?? '')->class('form-control')->placeholder('Duration') }}
                                                        </td>
                                                        <td>
                                                            {{ html()->text('notes[]', old('notes')[0] ?? '')->class('form-control')->placeholder('Notes') }}
                                                        </td>
                                                        <td><a href="javascript:void(0)" onClick="$(this).parent().parent().remove();"><i class="icofont icofont-ui-delete text-danger"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-clrlab" role="tabpanel" aria-labelledby="pills-clrlab-tab">
                                <div class="m-t-30">
                                    <div class="row m-t-30">
                                        <div class="col-md-12 form-group">
                                            <label class="control-label">Tests Advised &nbsp;<a class="btn btn-link addTest" data-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Click here to add new Test">Add New Test</a></label>
                                            {{ html()->select('tests[]', $tests, old('tests'))->class('form-control select2')->attribute('id', 'selTest')->multiple() }}
                                            <small>Multiple selection enabled</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <a class="btn btn-danger" onclick="window.history.back();">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-submit" href="">Save</button>
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include("backend.drawer.symptom");
@include("backend.drawer.diagnosis");
@include("backend.drawer.medicine");
@include("backend.drawer.test");
@endsection